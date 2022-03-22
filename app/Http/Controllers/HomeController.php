<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserValdation;
use App\Http\Resources\UserResource;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function CreateOrLogin(UserValdation $request)
    {
        $credentials = request(['email', 'password']);
        if (!Auth::attempt($credentials))
            return response()->json([
                'message' => 'Unauthorized',
                'success' => false,

            ], 400);

        $user = Auth::user();
        $tokenResult = $user->createToken($user->name);

        return response()->json([
            'token_type' => 'Bearer',
            'access_token' => $tokenResult->accessToken,
            'message' => "New Success Login",
            'userInfo' => UserResource::collection(User::where('id', $user->id)->get()),
            'success' => true,
        ]);

    }

    public function ReorderStudent()
    {
        $schools = School::all();
        foreach ($schools as $school) {
            $student = Student::where('school_id', $school->id)->update([
                "order" => $school->id
            ]);

        }
        return response()->json(["status" => true, "message" => "Students Reordered"]);
    }

    public function PositionsStudents(Request $request)
    {
        $position = $request->positions;
        $i = 1;

        foreach ($position as $k => $v) {
            $student = Student::where('id', $i)->update([
                "order" => $v,
            ]);
            $i++;
        }

        return response()->json(["status" => true, "message" => "Students Reordered"]);
    }


}
