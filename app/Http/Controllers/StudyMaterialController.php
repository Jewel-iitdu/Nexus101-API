<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Studymaterial;
use App\Http\Resources\Studymaterial as StudymaterialResource;
use App\Course;

class StudyMaterialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $studymaterial = StudyMaterial::all();

        $data['message'] = "Found";
        $data['status'] = 1;
        $data['studyMaterial_info'] = $studymaterial;

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
        $studymaterial = Studymaterial::where('id', $request->id)->first();

        if($studymaterial == null){
            $studymaterial = new Studymaterial;
            $studymaterial->file_name = $request->file_name;
            $studymaterial->course_id = $request->course_id;
            $studymaterial->upload_date = $request->upload_date;
            $studymaterial->remove_date = $request->remove_date;

            if($studymaterial->save()){

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

    public function getFilesById(Request $request){
        $files = StudyMaterial::where('course_id', $request->course_id)->get();
        if(count($files) > 0){
            $data['message'] = "Found";
            $data['status'] = 1;
            $data['file_info'] = $files;
            return json_encode($data);
        }

        else{
            $data['message'] = "Not Found";
            $data['status'] = 0;

            return json_encode($data);
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
        $studymaterial = StudyMaterial::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['file_info'] = $studymaterial;

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
        $studymaterial = StudyMaterial::find($request->id);

        if($studymaterial != null){
            $studymaterial = StudyMaterial::where('id', $request->id)->first();
//            $studymaterial = Studymaterial;
            $studymaterial->file_name = $request->file_name;
            $studymaterial->course_id = $request->course_id;
            $studymaterial->upload_date = $request->upload_date;
            $studymaterial->remove_date = $request->remove_date;

            if($studymaterial->save()){

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
