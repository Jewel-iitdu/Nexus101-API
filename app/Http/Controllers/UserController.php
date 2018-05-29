<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\requests;
use App\User;
use App\Http\Resources\User as UserResource;
use Hash;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$users = User::paginate(15);
        //return UserResource::Collection($users);
    }

    public function login(Request $request)
    {
        $user = User::where('email', $request->email)->first();

        if($user == null){
            $data['message'] = "Login failed";
            $data['status'] = 0;
            $data['user_info'] = null;

            return json_encode($data);
        }
        else{
            if(Hash::check($request->password, $user->password)){
                $data['message'] = "Login successfull";
                $data['status'] = 1;
                $data['user_info'] = $user;

                return json_encode($data);
            }
            else{
                $data['message'] = "Invalid Password";
                $data['status'] = 0;
                $data['user_info'] = null;

                return json_encode($data);
            }
        }
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
        $user = $request->isMethod('put') ? User::findOrFail($request->user_id) : new User;

        $user->id = $request->input('id');
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $request->user()->input([
            'password' => Hash::make($request->Password)
        ])->save();
        
        
        $user->updated_at = $request->input('updated_at');
        $user->created_at = $request->input('created_at');

        if ($user->save()) {
            return new UserResource($user);
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
        //single article
        $user = User::find($id);
        $data['message'] = "Found";
        $data['status'] = 1;
        $data['user'] = $user;

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
        $user = User::findOrFail($id);
        if ($user->delete()) {
            return new UserResource($user);
        }
        
    }
}
