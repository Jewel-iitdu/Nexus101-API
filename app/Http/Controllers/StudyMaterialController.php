<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Studymaterial;
use App\Http\Resources\Studymaterial as StudymaterialResource;

class StudyMaterialController extends Controller
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

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        //
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
