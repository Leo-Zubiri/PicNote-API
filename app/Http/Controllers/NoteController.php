<?php

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Album;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(User $user,Album $album,
        Note $note, Request $request)
    {
        // Mostrar contenido de Nota {note}
        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");

        if ($album->belongsTo($user) && $note->belongsTo($album))
            return $note;

        return jsend_fail("No tienes acceso a esta nota");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(User $user,Album $album,Request $request)
    {
        // Crear nota
        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");

        $note = Note::create([
            'album_id' => $album["id"],
            'image_url' => $request->image_url,
            'isHomework' => $request->isHomework,
            'dueTo' => $request->dueTo 
        ]);
        return $note;

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function show(Note $note)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Note $note)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Note  $note
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user,Album $album,
        Note $note,Request $request)
    {
        if($user["api_token"] != $request["api_token"])
            return jsend_fail("Token de usuario no corresponde");
        
        if ($album->belongsTo($user) && $note->belongsTo($album)){
            $note->delete();
            return jsend_success("Nota eliminada");
        }

        return jsend_fail("Error,nota no eliminada");
            
    }
}
