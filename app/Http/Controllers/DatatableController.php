<?php

namespace App\Http\Controllers;

use App\Letter;
use App\OilCollector;
use App\Post;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Storage;

use App\User;
use Carbon\Carbon;

class DatatableController extends Controller
{

    public function user(DataTables $datatables)
    {
        $user = User::with('groups')
        // ->where('id', '!=', auth()->id())
        ->get();
        return $datatables->of($user)
        ->editColumn('groups', function($data) {
            $group_text = '';
            if ($data->groups) {
                foreach ($data->groups as $group) {
                    $group_text .= '- '.$group->name.'<br>';
                }
            }
            return $group_text;
        })
        ->editColumn('status', function($data) {
            if ($data->status) {
                return '<label style="width:100%;" class="badge badge-pill badge-success">Aktif</label>';
            } else {
                return '<label style="width:100%;" class="badge badge-pill badge-danger">Tidak aktif</label>';
            }
        })
        ->addColumn('action', function($data) {
            $button = '
                <div class="btn-group" role="group">
                    <a href="'.url('user/form/edit/'.$data->id).'" class="btn btn-info edit-button"><i class="fa fa-edit"></i></a>
                    <button value="'.$data->id.'" data-content="'.url('user').'" class="btn btn-warning delete-button"><i class="fa fa-trash"></i></button>
            ';
            if ($data->status) {
                $button .= '<button id="disable" value="'.$data->id.'" data-content="'.url('user').'" class="btn btn-danger status-button"><i class="fa fa-ban"></i></button>';
            } else {
                $button .= '<button id="enable" value="'.$data->id.'" data-content="'.url('user').'" class="btn btn-success status-button"><i class="fa fa-check"></i></button>';
            }
            return $button.'</div>';
        })
        ->rawColumns(['groups', 'status', 'action'])
        ->make(true);
    }

    public function posts(DataTables $datatables)
    {
        $post = Post::withTrashed()->get();
        return $datatables->of($post)
        ->editColumn('description', function($data) {
            return substr($data->description, 0, rand(30,50)).".";
        })
        ->editColumn('created_by', function($data) {
            return $data->creator['name'];
        })
        ->editColumn('updated_by', function($data) {
            if ($data->updated_by != null) {
                return $data->editor['name'];
            } else {
                return null;
            }
        })
        ->addColumn('status', function($data) {
            if ($data->deleted_at != null) {
                return "Deleted - ".$data->destroyer['name'];
            } else {
                return "Uploaded";
            }
            
            return $data->editor;
        })
        ->addColumn('action', function($data) {
            $button = '
                <div class="btn-group" role="group">
                    <a href="'.url('posts/form/edit/'.$data->id).'" class="btn btn-info edit-button"><i class="fa fa-edit"></i></a>
                    <button value="'.$data->id.'" data-content="'.url('posts').'" class="btn btn-warning delete-button"><i class="fa fa-trash"></i></button>
            ';
            if ($data->deleted_at != null) {
                $button .= '<button id="disable" value="'.$data->id.'" data-content="'.url('posts').'" class="btn btn-danger status-button"><i class="fa fa-ban"></i></button>';
            } else {
                $button .= '<button id="enable" value="'.$data->id.'" data-content="'.url('posts').'" class="btn btn-success status-button"><i class="fa fa-check"></i></button>';
            }
            return $button.'</div>';

        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }

    public function oilCollector(DataTables $datatables)
    {
        $oil = OilCollector::with('user')->get();
        return $datatables->of($oil)
        ->editColumn('created_at', function($data) {
            return Carbon::parse($data->created_at)->diffForHumans()." - ".Carbon::parse($data->created_at)->toFormattedDateString();
        })
        ->editColumn('updated_at', function($data) {
            return Carbon::parse($data->updated_at)->diffForHumans()." - ".Carbon::parse($data->updated_at)->toFormattedDateString();
        })
        ->editColumn('amount', function($data) {
            return $data->amount." ".ucfirst($data->unit);
        })
        ->addColumn('action', function($data) {
            $button = '
                <div class="btn-group" role="group">
                    <a href="'.url('oil-collector/form/edit/'.$data->id).'" class="btn btn-info edit-button"><i class="fa fa-edit"></i></a>
                    <button value="'.$data->id.'" data-content="'.url('oil-collector').'" class="btn btn-warning delete-button"><i class="fa fa-trash"></i></button>
            ';
            return $button.'</div>';
        })
        ->rawColumns(['action'])
        ->make(true);
    }

    public function letter(DataTables $datatables)
    {
        $oil = Letter::with('user')->get();
        return $datatables->of($oil)
        ->editColumn('status', function($data) {
            switch ($data->status) {
                case 'under-review':
                    $status = '<span class="badge badge-warning">'.strtoupper($data->status).'</span>';
                    break;
                case 'not-approved':
                    $status = '<span class="badge badge-danger">'.strtoupper($data->status).'</span>';
                    break;
                default:
                    $status = '<span class="badge badge-success">'.strtoupper($data->status).'</span>';
                    break;
            }
            return $status;
        })
        ->editColumn('created_at', function($data) {
            return Carbon::parse($data->created_at)->diffForHumans()." - ".Carbon::parse($data->created_at)->toFormattedDateString();
        })
        ->editColumn('start_date', function($data) {
            return $data->start_date != null ? Carbon::parse($data->start_date)->diffForHumans()." - ".Carbon::parse($data->start_date)->toFormattedDateString() : "-";
        })
        ->editColumn('expired_date', function($data) {
            return $data->expired_date != null ? Carbon::parse($data->expired_date)->diffForHumans()." - ".Carbon::parse($data->expired_date)->toFormattedDateString() : "-";
        })
        ->addColumn('action', function($data) {
            $button = '
                <div class="btn-group" role="group">
                    <button value="'.$data->id.'" data-content="'.url('letter').'" class="btn btn-warning delete-button"><i class="fa fa-trash"></i></button>
            ';
            if ($data->status == 'under-review') {
                $button .= '<button value="'.$data->id.'" data-content="'.url('letter').'" class="btn btn-success approve-button"><i class="fa fa-check"></i></button>';
            } elseif ($data->status == 'approved') {
                $button .= '<a href="/letter/print/'.$data->signature.'" target="_blank" data-content="'.url('letter').'" class="btn btn-success"><i class="fa fa-print"></i></a>';
            }
            return $button.'</div>';
        })
        ->rawColumns(['status', 'action'])
        ->make(true);
    }
}