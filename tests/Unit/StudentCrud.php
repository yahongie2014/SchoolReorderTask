<?php

namespace Tests\Unit;

use Illuminate\Support\Facades\DB;
use Tests\TestCase;

define('TOKEN', 'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzI1NiJ9.eyJhdWQiOiI5NWUwNjdiYi1jYTIxLTRmMzItYmI3MC03N2VlYWE2OTI2ZmMiLCJqdGkiOiJjZmMzZDNmMWY4M2IwN2I3NDZmMWE2NjlhOWU0ZTliOTE3NzFjNjhlMDEwMTNjODA4ZDAzNjI1MmRjOGVlMzA0YzBlYzBjY2QxZTg2YWVkNSIsImlhdCI6MTY0NzkxMDU0MSwibmJmIjoxNjQ3OTEwNTQxLCJleHAiOjE2Nzk0NDY1NDEsInN1YiI6IjEiLCJzY29wZXMiOltdfQ.pwpBxZdpBJqrG8txenBRe82j4oZBvMYjbCgeAQJkpwrwu2TjzASynmjzbYU6NX4YnrKpCbDzeXp7Z_zjvs5jm4bt7PQAWp82ik29y7YdEZTTMV2qdI6NQQCi_Auss0R74k-x7QnlnFG3vITDphYMd1bEgrlWvxkRxjg9cvBK4qZpGJr8PrXVOjVfKduzrc9L69G5lVSmUutR3uHLgyeDhZg5qiepwPbN25o26P29x1K6wraBnOYDu6fPiry_HBZ3FI5yy93WFmvc1dEU8Jt1jmYAiM1RrhySenzJqnsljNpoZ7ncs2TZIP_13MQyd1to4G3yG6rG8oFskR0DPMQY2p5lNiAIYqsOeMmCKHK5WFkBj9_FlpJS-GxT-_iJZlkxC40WZkOXjwxLdE5zh7ZZQBvIlbKBHgLoey_kpHDo2z8frizsy6ryIMj-6uCaCmcdq3qk1rIaPDEvh1MEJsVGsz25PZRXCI8Qki4ILBiQKUDnu89R3Dj7didqsxZImv9wlaOVSUCrClYbSw0IxKPOcqWUciHMFinglQdU-oFA7xw0qXXhxARgeRagmm6d_2-CFcVHKT5GdGMgGqO3DGSLrVJJWijMrHC-Ts5R2EaWp3aIE6Z8lnBrhSbvmxUaYB3_Xj23oG5hDYnOPfK1Uy9GUUlRdugXDPdiRLQIEHJPwfs');

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
