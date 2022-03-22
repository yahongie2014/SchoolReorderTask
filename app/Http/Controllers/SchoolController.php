<?php

namespace App\Http\Controllers;

use App\Http\Requests\SchoolValidation;
use App\Http\Resources\SchoolResource;
use App\Http\Resources\StudentResource;
use App\Models\School;
use App\Models\Student;
use Illuminate\Http\Request;

class SchoolController extends Controller
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
        return SchoolResource::collection($this->school->paginate(10));
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
    public function store(SchoolValidation $request)
    {
        $new = $this->school->create($request->all());
        return response()->json([
            "success" => true,
            "data" => SchoolResource::collection($this->school->where('id', $new->id)->get())
        ]);

    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return SchoolResource::collection($this->school->where('id', $id)->get());

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function edit(School $school)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function update(SchoolValidation $request, $id)
    {
        $update = $this->school->find($id)->update($request->all());
        return response()->json([
            "success" => true,
            "data" => SchoolResource::collection($this->school->where('id', $id)->get())
        ]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\School $school
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $delete = $this->school->find($id)->delete();
        return response()->json([
            "success" => true,
        ]);

    }
}
