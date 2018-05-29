<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Teacher;
use App\Http\Resources\Teacher as TeacherResource;
use App\User;


class TeacherController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teachers = Teacher::all();

        $data['message'] = "Found";
        $data['status'] = 1;

        foreach($teachers as $key=>$teacher){
            $data['teacher'][$key]['teacher_info'] = $teacher;
            $data['teacher'][$key]['user_info'] = User::find($teacher->user_id);   
        }

        return json_encode($data);
    }

    

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $user = User::where('email', $request->email)->first();

        if($user == null){
            $user = new User;
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->user_type = "Teacher";
            $user->phone_number = $request->phone_number;

            if($user->save()){
                $teacher = new Teacher;
                $teacher->user_id = $user->id;
                $teacher->blood_group = $request->blood_group;
                $teacher->designation = $request->designation;

                if($teacher->save()){
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
        $teacher = Teacher::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['teacher']['teacher_info'] = $teacher;
        $data['teacher']['user_info'] = User::find($teacher->user_id);

        return json_encode($data);
    }


    public function update(Request $request)
    {
        $teacher = Teacher::find($request->id);

        if($teacher != null){

            $teacher->blood_group = $request->blood_group;
            $teacher->designation = $request->designation;

            if($teacher->save()){
                $user = User::where('id', $teacher->user_id)->first();
                $user->name = $request->name;

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
