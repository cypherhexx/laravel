<?php

namespace App\Http\Controllers\APIControllers;

use App\Notes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class NotesController extends Controller
{
    
    function __construct()
    {
        $this->middleware('auth:api');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $result = Notes::getList();
        
        return response($result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $content = $request['content'];
        
        $result = Notes::addNote($content);
        
        return response($result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $note_id)
    {
        $content = $request['content'];
        
        $result = Notes::editNote($note_id, $content);
        
        return response($result);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Notes  $notes
     * @return \Illuminate\Http\Response
     */
    public function destroy($note_id)
    {
        $result = Notes::deleteNote($note_id);
        
        return response($result);
    }
}
