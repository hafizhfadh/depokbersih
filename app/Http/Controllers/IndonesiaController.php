<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class IndonesiaController extends Controller
{

    public function provinces(Request $request)
    {
        if ($request->q) {
            $data = DB::table('provinces')->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $data = DB::table('provinces')->get();
        }
        return response()->json(['data' => $data]);
    }

    public function province(Request $request)
    {
        try {
            $data = DB::table('provinces')->where('id', $request->province_id)->first();
            if ($data) {
                if ($request->text == true) {
                    $data = $data->name;
                }
                return response()->json(['data' => $data]);
            } else {
                throw new \Exception('Data tidak ditemukan', 404);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            return response()->json(['error' => $error], $th->getCode() == 0 ? 500 : $th->getCode());
        }
    }

    public function regencies(Request $request)
    {
        if ($request->q) {
            $data = DB::table('regencies')->where('province_id', $request->province_id)->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $data = DB::table('regencies')->where('province_id', $request->province_id)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function regency(Request $request)
    {
        try {
            $data = DB::table('regencies')->where('id', $request->regency_id)->first();
            if ($data) {
                if ($request->text == true) {
                    $data = $data->name;
                }
                return response()->json(['data' => $data]);
            } else {
                throw new \Exception('Data tidak ditemukan', 404);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            return response()->json(['error' => $error], $th->getCode() == 0 ? 500 : $th->getCode());
        }
    }

    public function districts(Request $request)
    {
        if ($request->q) {
            $data = DB::table('districts')->where('regency_id', $request->regency_id)->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $data = DB::table('districts')->where('regency_id', $request->regency_id)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function district(Request $request)
    {
        try {
            $data = DB::table('districts')->where('id', $request->district_id)->first();
            if ($data) {
                if ($request->text == true) {
                    $data = $data->name;
                }
                return response()->json(['data' => $data]);
            } else {
                throw new \Exception('Data tidak ditemukan', 404);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            return response()->json(['error' => $error], $th->getCode() == 0 ? 500 : $th->getCode());
        }
    }

    public function villages(Request $request)
    {
        if ($request->q) {
            $data = DB::table('villages')->where('district_id', $request->district_id)->where('name', 'like', '%' . $request->q . '%')->get();
        } else {
            $data = DB::table('villages')->where('district_id', $request->district_id)->get();
        }
        return response()->json(['data' => $data]);
    }

    public function village(Request $request)
    {
        try {
            $data = DB::table('villages')->where('id', $request->village_id)->first();
            if ($data) {
                if ($request->text == true) {
                    $data = $data->name;
                }
                return response()->json(['data' => $data]);
            } else {
                throw new \Exception('Data tidak ditemukan', 404);
            }
        } catch (\Throwable $th) {
            if (method_exists($th, 'errors')) {
                $error = $th->errors();
            } else {
                $error = $th->getMessage();
            }
            return response()->json(['error' => $error], $th->getCode() == 0 ? 500 : $th->getCode());
        }
    }
}
