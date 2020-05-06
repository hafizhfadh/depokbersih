<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class JobListSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $job_list = File::get('database/data/job_lists.json');
        $job_list_arr = [];
        foreach (json_decode($job_list) as $job_list_v) {
            $job_list_arr[] = [
                'name' => $job_list_v->name
            ];
        }
        DB::table('job_lists')->insert($job_list_arr);
    }
}
