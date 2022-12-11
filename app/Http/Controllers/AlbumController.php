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


    public function index(User $usuario)
    {
        $albums = User::find($usuario)->albums();
        $paginador = $albums::paginate(10);
        return $paginador;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        //$newAlbum = Album::create($request->all());
        return jsend_success(["message"=>"NICE"]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Album  $album
     * @return \Illuminate\Http\Response
     */
    public function show(Album $album)
    {
        $notes = Album::find($album)->notes();
        $paginador = $notes::paginate(10);
        return $paginador;
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
    public function destroy(Album $album)
    {
        //
    }

    // public function getCourses(Album $album){
    //     $courses = $album->courses();
    //     return $courses;
    // }
}
