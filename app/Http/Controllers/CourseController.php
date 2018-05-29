<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Course;
use App\Http\Resources\Course as CourseResource;

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

        $data['message'] = "Found";
        $data['status'] = 1;
        $data['courses_info'] = $course;

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
        
        $data['message'] = "Found";
        $data['status'] = 1;
        foreach ($courses as $key=>$course) {
            $data['courses_info_by_group'][$key] = $course;
        }
        
        return json_encode($data);
            
        
        
    }

    public function update(Request $request)
    {
        $course = Course::find($request->id);

        if($course != null){
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
