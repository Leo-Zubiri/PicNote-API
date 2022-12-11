<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $credentials = request(['email', 'password']);

        if (!Auth::attempt($credentials)) {
            return jsend_fail("Unauthorized");
        }

        $user = $request->user();
        return $user;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {   
        $user = User::create([
            'name' => $request->name, 
            'email' => $request->email,
            'password' => Hash::make( $request->password ),
            'api_token' => Str::random(60),
        ]);

        
        return jsend_success([
            "message"=>"User stored",
            "email"=>$user->email,
            'api_token' => $user->api_token,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show(User $user, Request $request)
    {
        // Ruta protegida por el api_token
        if($user["api_token"] == $request["api_token"])
            return $user;
        
        return jsend_fail("Token de usuario no corresponde");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, User $user)
    {
        if($user["api_token"] == $request["api_token"]){
            $user->update($request->all());
            return jsend_success(["message"=>"User updated"]);
        }

        return jsend_fail("Token de usuario no corresponde");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Request $request)
    {
        if($user["api_token"] == $request["api_token"]){
            $user->delete();
            return jsend_success(["message"=>"User eliminated"]);
        }

        return jsend_fail("User not deleted");
    }

    public function getAlbums(User $user){
        $albums = $user->albums();
    
        if($albums)
            return jsend_fail("No existen albums creados");
        return $user;
    }
}
