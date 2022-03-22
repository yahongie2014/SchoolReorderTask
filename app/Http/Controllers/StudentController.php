<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentValidation;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function __construct(School $school, Student $student)
    {
        $this->school = $school;
        $this->student = $student;
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return StudentResource::collection($this->student->paginate(10));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StudentValidation $request)
    {
        $new = $this->student->create($request->all());
        return response()->json([
            "success" => true,
            "data" => StudentResource::collection($this->student->where('id', $new->id)->get())
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return StudentResource::collection($this->student->where('id', $id)->get());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function edit(Student $student)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function update(StudentValidation $request, $id)
    {
        $update = $this->student->find($id)->update($request->all());
        return response()->json([
            "success" => true,
            "data" => StudentResource::collection($this->student->where('id', $id)->get())
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Student $student
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->student->find($id)->delete();
        return response()->json([
            "success" => true,
        ]);

    }

}
