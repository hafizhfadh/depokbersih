<?php

namespace App\Http\Controllers;

use App\User;
use App\OilCollector;
use Illuminate\Http\Request;
use App\Services\OilService;

class OilCollectorController extends Controller
{
    private function validation($type, $request, $id = null) {
        $this->validate($request, [
            'user_id' => 'required',
            'amount' => 'required|numeric',
        ]);
    }

    public function index()
    {
        return view('oil-collector.index');
    }

    public function form($type, $id = null)
    {
        if ($type == 'create') {
            $data = null;
            return view('oil-collector.form', compact('type', 'data'));
        } elseif ($type == 'edit') {
            $data = OilCollector::where('id', $id)->with('user')->first();
            return view('oil-collector.form', compact('type', 'data', 'id'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validation('store', $request);
        $user = User::find($request->user_id);
        $point = OilService::pointCounter($request->type, $request->unit, $request->amount);
        $user->point = $user->point + $point;
        $user->save();
        OilCollector::create($request->all());

    }

    public function delete($id)
    {
        $oil = OilCollector::find($id);
        $user = User::find($oil->user_id);
        $point = OilService::pointCounter($oil->type, $oil->unit, $oil->amount);
        $user->point = $user->point - $point;
        $user->save();
        $oil->delete();
    }
}
