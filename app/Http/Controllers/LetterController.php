<?php

namespace App\Http\Controllers;

use PDF;
use App\Letter;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;

class LetterController extends Controller
{
    private function validation($type, $request, $id = null) {
        $this->validate($request, [
            'user_id' => 'required',
            'start_date' => 'required',
        ]);
    }

    public function index()
    {
        $group = auth()->user()->hasAnyGroup('user');
        if ($group) {
            return view('letter.user');
        } else {
            return view('letter.administrator');
        }
    }

    public function form()
    {
        if (auth()->user()->hasGroup(['administrator','supervisor'])) {
            return view('letter.form-administrator');
        } else if(auth()->user()->hasGroup(['user','anthusias'])) {
            return view('letter.form-user');
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validation('store', $request);
        
        $letter = [
            'user_id' => $request->user_id,
            'signature' => Str::orderedUuid(),
            'status' => 'under-review',
        ];

        Letter::create($letter);
    }

    public function print($id)
    {
        $data = Letter::where('signature', $id)->first();
        if ($data == null) {
            abort(404);
        } else {
            $data->with('user');
            $pdf = PDF::loadview('letter.print-letter',['data'=>$data]);
            return $pdf->stream();
        }
    }

    public function status(Request $request, $id)
    {
        Letter::where('id', $id)->update([
            'status' => $request->status,
            'start_date' => Carbon::parse($request->start_date),
            'expired_date' => Carbon::parse($request->start_date)->addDays(7),
        ]);
    }

    public function validationView()
    {
        return view('letter.validation');
    }

    public function letterValidation(Request $request)
    {
        return $request;
    }

    public function delete($id)
    {
        Letter::find($id)->delete();
    }
}
