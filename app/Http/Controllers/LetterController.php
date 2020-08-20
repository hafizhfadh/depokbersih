<?php

namespace App\Http\Controllers;

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

    public function form($type)
    {
        if ($type == 'create') {
            return view('letter.form-administrator');
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

    public function status(Request $request, $id)
    {
        Letter::where('id', $id)->update([
            'status' => $request->status,
            'start_date' => Carbon::parse($request->start_date),
            'expired_date' => Carbon::parse($request->start_date)->addDays(7),
        ]);
    }
}
