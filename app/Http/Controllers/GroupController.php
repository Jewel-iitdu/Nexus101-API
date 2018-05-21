<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\Group;
use App\Http\Resources\Group as GroupResource;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $group = Group::all();

        $data['message'] = "Found";
        $data['status'] = 1;
        $data['groups_info'] = $group;

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
        $group = Group::where('id', $request->id)->first();

        if($group == null){
            $group = new Group;
            $group->group_name = $request->group_name;
            $group->semester_year = $request->semester_year;

            if($group->save()){

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
        $group = Group::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['groups_info'] = $group;

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
        $group = Group::find($request->id);

        if($group != null){
            $group = Group::where('id', $request->id)->first();
            $group->group_name = $request->group_name;
            $group->semester_year = $request->semester_year;

            if($group->save()){

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
