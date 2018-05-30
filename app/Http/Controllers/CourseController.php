<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Course;
use App\Http\Resources\Course as CourseResource;
use App\StudentGroup;
use App\Group;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $course = Course::all();

        if(count($course) > 0){
            $data['message'] = "Found";
            $data['status'] = 1;
            $data['course_info'] = $course;

            return json_encode($data);
        }
        else{
            $data['message'] = "Not Found";
            $data['status'] = 0;


            return json_encode($data);
        }
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
        $course = Course::where('id', $request->id)->first();

        if($course == null){
            $course = new Course;
            $course->course_name = $request->course_name;
            $course->course_code = $request->course_code;
            $course->group_id = $request->group_id;

            if($course->save()){

                $data['message'] = "Inserted";
                $data['status'] = 1;

                return json_encode($data);
                

            }
            else{
                
                $data['message'] = "Not Inserted";
                $data['status'] = 0;

                return json_encode($data);

            }
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $course = Course::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['courses_info'] = $course;

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

     public function getCourseByGroupId(Request $request){
        $courses = Course::where('group_id',$request->group_id)->get();
        
        if(count($courses)>0){
            $data['message'] = "Found";
            $data['status'] = 1;
            $data['course_info'] = $courses;
            return json_encode($data);
        }

        $data['message'] = "Not Found";
        $data['status'] = 0;

        return json_encode($data);
    }

    public function getCourseByStudentId(Request $request){
        $group = Group::where('id', StudentGroup::where('student_id', $request->student_id)->where('active', 1)->first()->group_id)->first();
        $courses = Course::where('group_id', $group->id)->get();
        if(count($courses)>0){
            $data['message'] = "Found";
            $data['status'] = 1;
            $data['course_info'] = $courses;
            return json_encode($data);
        }
        $data['message'] = "Not Found";
        $data['status'] = 0;

        return json_encode($data);
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);

        if(course($course) > 0){
            $course = Course::where('id', $request->id)->first();
            $course->course_name = $request->course_name;
            $course->course_code = $request->course_code;
            $course->course_id = $request->course_id;
            $course->group_id = $request->group_id;

            if($course->save()){

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
