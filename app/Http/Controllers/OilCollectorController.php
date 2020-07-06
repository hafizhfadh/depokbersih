<?php

namespace App\Http\Controllers;

use App\OilCollector;
use Illuminate\Http\Request;

class OilCollectorController extends Controller
{
    private function validation($type, $request, $id = null) {
        $this->validate($request, [
            'user_id' => 'required',
            'liter' => 'required|numeric',
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
            $data = OilCollector::where('id', $id)->first();
            return view('oil-collector.form', compact('type', 'data', 'id'));
        } else {
            abort(404);
        }
    }

    public function store(Request $request)
    {
        $this->validation('store', $request);
        $post = OilCollector::create($request->all());
    }
}
