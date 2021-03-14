<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class IndonesiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->province();
        $this->regency();
        $this->district();
        $this->village();
    }

    public function province()
    {
        $province = File::get('database/data/provinces.json');
        $province_arr = [];
        foreach (json_decode($province) as $province_v) {
            $province_arr[] = [
                'id' => $province_v->id,
                'name' => $province_v->name
            ];
        }
        DB::table('provinces')->insert($province_arr);
    }

    public function regency()
    {
        $regency = File::get('database/data/regencies.json');
        $regency_arr = [];
        foreach (json_decode($regency) as $regency_v) {
            $regency_arr[] = [
                'id' => $regency_v->id,
                'province_id' => $regency_v->province_id,
                'name' => $regency_v->name
            ];
        }
        DB::table('regencies')->insert($regency_arr);
    }

    public function district()
    {
        $district = File::get('database/data/districts.json');
        $district_arr = [];
        foreach (json_decode($district) as $district_v) {
            $district_arr[] = [
                'id' => $district_v->id,
                'regency_id' => $district_v->regency_id,
                'name' => $district_v->name
            ];
        }
        DB::table('districts')->insert($district_arr);
    }

    public function village()
    {
        $village = File::get('database/data/villages.json');
        $village_arr = [];
        foreach (json_decode($village) as $village_v) {
            $village_arr[] = [
                'district_id' => $village_v->district_id,
                'name' => $village_v->name
            ];
        }

        foreach (array_chunk($village_arr, 1000) as $varr) {
            DB::table('villages')->insert($varr);
        }
    }
}
