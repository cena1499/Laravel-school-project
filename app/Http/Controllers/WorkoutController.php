<?php

namespace App\Http\Controllers;

use App\Models\Body_Part;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WorkoutController extends Controller
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
        //$workouts = Workout::all();
        //$body_parts = Body_Part::all();
        if(!auth()->user()->isAdmin){
            return redirect('/home')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $workouts = DB::select(
            'SELECT workouts.id, workouts.workout_name, workouts.created_at, body__parts.name 
            FROM workouts
            INNER JOIN body__parts ON workouts.body_part_id=body__parts.id'
        );

        return view('workouts.index')->with('workouts', $workouts);
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
        $body_parts = Body_Part::all();
        return view('workouts.create')->with('body_parts', $body_parts);
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
            ['workout_name' => 'required'],
            ['workout_name.required' => 'Název cviku nebyl vyplněn.'],
            ['body_part_id' => 'required'],
            ['body_part_id.required' => 'Nebyla zvolená partie']
        );

        $workout = new Workout;
        $workout->workout_name = $request->input('workout_name');
        $workout->body_part_id = $request->input('body_part_id');
        $workout->save();

        return redirect('/workouts')->with('success', 'Nový cvik byl vytvořen');
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

        $workout = Workout::find($id);
        $body_part = Body_Part::find($workout->body_part_id);
        
        $workout->name = $body_part->name;
        return view('workouts.show')->with('workout', $workout);
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

        $workout = Workout::find($id);
        $body_part = Body_Part::find($workout->body_part_id);
        $workout->name = $body_part->name;
        $workout->body_parts = Body_Part::all();

        //return $data;
        return view('workouts.edit')->with('workout', $workout);
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
            ['workout_name' => 'required'],
            ['workout_name.required' => 'Název cviku nebyl vyplněn.'],
            ['body_part_id' => 'required'],
            ['body_part_id.required' => 'Nebyla zvolená partie']
        );

        $workout = Workout::find($id);
        $workout->workout_name = $request->input('workout_name');
        $workout->body_part_id = $request->input('body_part_id');
        $workout->save();

        return redirect('/workouts')->with('success', 'Cvik byl editován.');
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
        
        $workout = Workout::find($id);

        $workout->delete();
        return redirect('/workouts')->with('success', 'Cvik byl odstraněn.');
    }
}
