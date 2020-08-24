<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if (auth()->user()->hasAnyGroup(['administrator','supervisor'])) {
            return view('home');
        } else if(auth()->user()->hasAnyGroup(['user','anthusias'])) {
            return redirect('letter/form/user');
        } else {
            return redirect('login');
        }
    }

    public function jobs(Request $request)
    {
        if ($request->q) {
            $jobs = DB::table('job_lists')->where('name', 'like', '%'.$request->q.'%')->get();
        } elseif ($request->job_id) {
            $jobs = DB::table('job_lists')->where('id', $request->job_id)->first();
        } else {
            $jobs = DB::table('job_lists')->get();
        }
        return response()->json(['data' => $jobs]);
    }

    public function birthplaces(Request $request)
    {
        if ($request->q) {
            $jobs = DB::table('birthplaces')->where('name', 'like', '%'.$request->q.'%')->get();
        } elseif ($request->birthplace_id) {
            $jobs = DB::table('birthplaces')->where('id', $request->birthplace_id)->first();
        } elseif ($request->last_id) {
            $jobs = DB::table('birthplaces')->orderBy('id', 'desc')->first();
        } else {
            $jobs = DB::table('birthplaces')->get();
        }
        return response()->json(['data' => $jobs]);
    }

    public function storeBirthplace(Request $request)
    {
        DB::table('birthplaces')->insert($request->all());
    }
}
