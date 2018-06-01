<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\StudentGroup;
use App\Http\Resources\StudentGroup as StudentGroupResource;
use App\Student;
use App\User;
use App\Group;

class StudentGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $studentgroup = StudentGroup::where('student_id', $request->student_id)->first();

        if($studentgroup == null){
            $studentgroup = new StudentGroup;
            $studentgroup->student_id = $request->student_id;
            $studentgroup->group_id = $request->group_id;
            $studentgroup->active = 1;

            if($studentgroup->save()){

                $data['message'] = "Inserted";
                $data['status'] = 1;

                return json_encode($data);
                

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
    public function show(Request $request)
    {
        $studentgroup = StudentGroup::where('student_id', $request->student_id)->where('active', 1)->first();
        if($studentgroup != null){
            $group = Group::find($studentgroup->group_id);
            
            $data['message'] = "Found";
            $data['status'] = 1;
            $data['group_info'] = $group;
            
            return json_encode($data);
        }
        $data['message'] = "Not Found";
        $data['status'] = 0;
        
        return json_encode($data);
    }
    
    public function getStudentByGroupId(Request $request){
        $studentgroups = StudentGroup::where('group_id', $request->group_id)->where('active', 1)->get();
        //dd($studentgroups);

        if(count($studentgroups) > 0){
            
            $data['message'] = "Found";
            $data['status'] = 1;

            foreach ($studentgroups as $key => $studentgroup) {
                $student = Student::find($studentgroup->student_id);
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
    public function update(Request $request, $id)
    {
        $studentgroup = StudentGroup::find($request->id);

        if($studentgroup != null){
            $studentgroup = StudentGroup::where('id', $request->id)->first();
            $studentgroup->student_id = $request->student_id;
            $studentgroup->group_id = $request->group_id;
            $studentgroup->active = $request->active;

            if($studentgroup->save()){

                $data['message'] = "updated";
                $data['status'] = 1;

                return json_encode($data);
                

            }
            else{
                
                $data['message'] = "update failed";
                $data['status'] = 0;

                return json_encode($data);

            }
        }
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
