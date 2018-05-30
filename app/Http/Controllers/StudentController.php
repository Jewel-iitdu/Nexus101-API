<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Student;
use App\StudentGroup;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::all();

        if(count($students) > 0){
            $data['message'] = "Found";
            $data['status'] = 1;

            foreach($students as $key=>$student){
                $data['student'][$key]['student_info'] = $student;
                $data['student'][$key]['user_info'] = User::find($student->user_id);   
        }

        return json_encode($data);
        }
        $data['message'] = "Not Found";
        $data['status'] = 0;

        return json_encode($data);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user == null){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user_type = "Student";
            $user->phone_number = $request->phone_number;

            if($user->save()){
                $student = new Student;
                $student->user_id = $user->id;
                $student->blood_group = $request->blood_group;
                $student->address = $request->address;
                $student->date_of_birth =$request->date_of_birth;
                $student->registration_number = $request->registration_number;
                $student->roll_number =$request->roll_number;
                $student->session =$request->session;
                $student->attached_hall= $request->attached_hall;

                if($student->save()){
                    $data['message'] = "Inserted";
                    $data['status'] = 1;

                    return json_encode($data);

                
                }

            }
        }

        $data['message'] = "Not Inserted";
        $data['status'] = 0;

        return json_encode($data);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $student = Student::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['student']['student_info'] = $student;
        $data['student']['user_info'] = User::find($student->user_id);

        return json_encode($data);
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $student = Student::find($request->id);

        if(count($student) > 0){

            $student->blood_group = $request->blood_group;
            $student->address = $request->address;
            $student->date_of_birth =$request->date_of_birth;
            $student->registration_number = $request->registration_number;
            $student->roll_number =$request->roll_number;
            $student->session =$request->session;
            $student->attached_hall= $request->attached_hall;

            if($student->save()){
                $user = User::where('id', $student->user_id)->first();
                $user->name = $request->name;
                $user->phone_number =$request->phone_number;

                if($user->save()){
                    $data['message'] = "Updated";
                    $data['status'] = 1;

                    return json_encode($data);
                }

            }
        }

        $data['message'] = "Not Updated";
        $data['status'] = 0;

        return json_encode($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
