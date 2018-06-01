<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\CourseTeacher;
use App\Http\Resources\CourseTeacher as CourseTeacherResource;
use App\Course;

class CourseTeacherController extends Controller
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
        $courseteacher = CourseTeacher::where('course_id', $request->course_id)->where('teacher_id', $request->teacher_id)->first();

        if($courseteacher == null){
            $courseteacher = new CourseTeacher;
            $courseteacher->course_id = $request->course_id;
            $courseteacher->teacher_id = $request->teacher_id;
            $courseteacher->active = 1;

            if($courseteacher->save()){

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
    
    
    public function getCourseByTeacherId(Request $request){
        
        $coursesteacher = CourseTeacher::where('teacher_id', $request->teacher_id)->where('active', 1)->get();

        if(count($coursesteacher) > 0){
            
            $data['message'] = "Found";
            $data['status'] = 1;

            foreach ($coursesteacher as $key => $courseteacher) {
                $course = Course::find($courseteacher->course_id);
                $data['course_info'][$key] = $course;
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
    public function update(Request $request)
    {
        $courseteacher = CourseTeacher::find($request->id);

        if($courseteacher != null){
            $courseteacher = CourseTeacher::where('id', $request->id)->first();
            $courseteacher->course_id = $request->course_id;
            $courseteacher->teacher_id = $request->teacher_id;
            $courseteacher->active = $request->active;

            if($courseteacher->save()){

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
