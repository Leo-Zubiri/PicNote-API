<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Http\Requests\AlbumStoreRequest;
use App\Models\User;

use Illuminate\Http\Request;

class AlbumController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    public function index(User $user, Request $request)
    {
        // Mostrar los albums de un usuario

        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");

        $albums = $user->albums()->paginate(10);
        return $albums;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user,Request $request)
    {
        // Crear un album
        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");

        $album = Album::create([
            'user_id' => $user["id"],
            'name' => $request->name, 
            'group' => $request->group, 
            'grade' => $request->grade,
            'start_schedule' => $request->start_schedule,
            'end_schedule' => $request->end_schedule,
            'daysperweek'=> $request->daysperweek 
        ]);
        return $album;    
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(User $user,Album $album,Request $request)
    {
        // Mostrar contenido del album

        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");

        
        $notes = $album->notes()->paginate(10);

        return $notes;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Album $album)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Album $album,Request $request)
    {
        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");
        
        $album->delete();
        return jsend_success("Album deleted");
    }


}
