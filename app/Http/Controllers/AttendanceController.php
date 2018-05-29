<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Attendance;
use App\Http\Resources\Attendance as AttendanceResource;
use App\Course;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendance = Attendance::all();

        $data['message'] = "Found";
        $data['status'] = 1;
        $data['attendances_info'] = $attendance;

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
        $attendance = Attendance::where('id', $request->id)->first();

        if($attendance == null){
            $attendance = new Attendance;
            $attendance->course_id = $request->course_id;
            $attendance->student_id = $request->student_id;
            $attendance->isPresent = $request->isPresent;
            $attendance->date = $request->date;

            if($attendance->save()){

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
        $attendance = Attendance::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['attendances_info'] = $attendance;

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

    public function getAttendancelistByStudentId(Request $request){
        $attendances = Attendance::where('student_id', $request->student_id)->where('course_id', $request->course_id)->get();

        if(count($attendances) > 0){
            $data['message'] = "Found";
            $data['status'] = 1;
            foreach($attendances as $key=>$attendance){
                $data['student_attendances_info'][$key]['attendance'] = $attendance;
                $data['student_attendances_info'][$key]['Course'] = Course::find($attendance->course_id);
            }
            

            return json_encode($data);
        }

        else{
            $data['message'] = "Not Found";
            $data['status'] = 0;

            return json_encode($data);
        }


    }

    public function storeAttendance(Request $request){
        for($i=0; $i<count($request->student_id); $i++){
            $attendance = Attendance::where('course_id', $request->course_id)->where('student_id', $request->student_id)->where('date', $request->date)->get();
            if(count($attendance) < 1){
                $attendance = new Attendance;
                $attendance->course_id = $request->course_id;
                $attendance->student_id = $request->student_id[$i];
                $attendance->isPresent = $request->isPresent[$i];
                $attendance->date = $request->date;
                $attendance->save();
            }
            else{
                $data['message'] = "Already Exists";
                $data['status'] = 0;

                return json_encode($data);
            }
            
        }

        $data['message'] = "Inserted";
        $data['status'] = 1;

        return json_encode($data);
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
        $attendance = Attendance::find($request->id);

        if($attendance != null){
            $attendance = Attendance::where('id', $request->id)->first();
            $attendance->course_id = $request->course_id;
            $attendance->student_id = $request->student_id;
            $attendance->isPresent = $request->isPresent;
            $attendance->date = $request->date;

            if($attendance->save()){

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
