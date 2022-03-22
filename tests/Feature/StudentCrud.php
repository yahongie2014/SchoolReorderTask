<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

define('TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NWUwNTNmNC0yMjBjLTQ0Y2MtODlhNC1mMGNmODE4MzViOWEiLCJqdGkiOiJkOTMzNzU5MmUyZDM0NmI4YWM0OTViNzE3N2UwYzAyYTMwOGNkYjY0MzEwYWQxMGZkZmNkMjQ3ZjM4ZmIxOWI2ODA0YjAyMTI2MWE5ODJhYyIsImlhdCI6MTY0NzkwNzIyMywibmJmIjoxNjQ3OTA3MjIzLCJleHAiOjE2Nzk0NDMyMjMsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.JklKO_Ufuk7JntcVlQEctnslqRgPClUteLXUuC9QxTgW7SL1ws1KQD88LyXaH_blFq8SHaI-3IpuWDAuLcJKXfc6TEOT5mJlGtNZ_lSZgOJbVCjtyNu0VuwZfaUXCIoDD6Rjy47osmgB3K-rVXaisjQNHXdROrm-Ajne1vGbSSE7QiY_szAmvnpWN-gIEYYkGxoPNrg8lFBzWgfJ3uvNuohseEGyulNkZ68ADG_ZzpV4UnkQ4o-zTIFMP_SMTr6Y3v-dbBQTQauWBfgND1XbV_gMeD1i4afy6-_S9NI3cErGdBirN31sGRDLQoJyE8Tg_KZIOt3PFAc-bzro66xARsT8oFR5sOJipPjxhn9axJ7BNOfWThZSRvS-7Ku1afnoxGUVb_fhoM8DUJbwlmXkdlWvj_N-iQnGz0p8hmC7Asy43k4LNA5hsQ7iNLCnHL531YHtO8_gjm_dxYGbmyoIFqFnWR5Is7L9AgpwWhnV7LS0PtuIcpaFdUep7msmAq_n9HolUKD8xG8TkpHhr1jdj2xORUl_e7w_Iu6coUaliHsZzvnJsE9bG59eT8aNKU3JG3SSuktVC7FXVmnphDHxk3u8g-edmy-wqNygnWzRMipudcpDpX_Ip7OaahRpbZSWpsbt_2uoDpvRV-s8wba1FxHlauJrb0F_4MyI9DGcxdw');

class StudentCrud extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testGetStudent()
    {
        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . TOKEN
        ])->get('/api/Student');

        $response->assertStatus(200);

    }

    public function testStudentSave()
    {
        $school = DB::table('schools')->where('deleted_at', '=', null)->latest()->first();

        $data = [
            "name" => "TestStudent",
            "school_id" => "$school->id",
            "order" => "$school->id",
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . TOKEN
        ])->post('/api/Student', $data);

        $response->assertStatus(200);
    }

    public function testGetStudentID()
    {
        $student = DB::table('students')->where('deleted_at', '=', null)->latest()->first();


        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . TOKEN
        ])->get('/api/Student/' . $student->id);

        $response->assertStatus(200);
    }

    public function testStudentEdit()
    {
        $student = DB::table('students')->where('deleted_at', '=', null)->latest()->first();
        $school = DB::table('schools')->where('deleted_at', '=', null)->latest()->first();

        $data = [
            "name" => "TestStudentEdit",
            "school_id" => "$school->id",
            "order" => "$school->id",
        ];

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . TOKEN
        ])->patch('/api/Student/' . $student->id, $data);

        $response->assertStatus(200);
    }

    public function testStudentDelete()
    {
        $student = DB::table('students')->where('deleted_at', '=', null)->latest()->first();

        $response = $this->withHeaders([
            'Accept' => 'application/json',
            'Authorization' => 'Bearer ' . TOKEN
        ])->delete('/api/Student/' . $student->id);

        $response->assertStatus(200);
    }


}
