<?php

namespace App\Http\Controllers;

use App\Models\Body_Part;
use Illuminate\Http\Request;

class Body_PartController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $body_parts = Body_Part::all();
        return view('body_parts.index')->with('body_parts', $body_parts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        return view('body_parts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $this->validate($request, 
            ['name' => 'required'],
            ['name.required' => 'Název partie nebyl vyplněn.']
        );   

        $post = new Body_Part;
        $post->name = $request->input('name');
        //$post->user_id = auth()->user()->id;
        $post->save();

        return redirect('/bodyParts')->with('success', 'Nová partie byla vytvořena.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $body_part = Body_Part::find($id);
        return view('body_parts.show')->with('body_part', $body_part);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $body_part = Body_Part::find($id);
        /*if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page.');
        }*/
        return view('body_parts.edit')->with('body_part', $body_part);
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
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $this->validate($request, 
            ['name' => 'required'],
            ['name.required' => 'Název partie nebyl vyplněn.']
        );   

        $post = Body_Part::find($id);
        $post->name = $request->input('name');
        $post->save();

        return redirect('/bodyParts')->with('success', 'Partie byla upravena.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $body_part = Body_Part::find($id);
        /*
        if(auth()->user()->id !== $post->user_id){
            return redirect('/posts')->with('error', 'Unauthorized page.');
        }
        */ 
        $body_part->delete();
        return redirect('/bodyParts')->with('success', 'Partie byla odstraněna.');
    }
}
