<?php

namespace App\Http\Controllers;

use App\Models\Training;
use App\Models\Body_Part;
use App\Models\Workout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\StoreTrainingController;

class TrainingController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index', 'show']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$trainings = Training::all();

        $trainings = DB::select(
            'SELECT trainings.id, trainings.description, trainings.repetition, trainings.weight, trainings.created_at, workouts.workout_name,body__parts.name 
            FROM trainings
            INNER JOIN workouts ON trainings.workout_id=workouts.id
            INNER JOIN body__parts ON workouts.body_part_id=body__parts.id'
        );
        
        //return $trainings;
        return view('trainings.index')->with('trainings', $trainings);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //$workouts = Workout::all();

        $workouts = DB::select(
            'SELECT workouts.id, workouts.workout_name, body__parts.name 
            FROM workouts
            INNER JOIN body__parts ON workouts.body_part_id=body__parts.id
            GROUP BY body__parts.name'
        );

        //return $workouts;
        return view('trainings.create')->with('workouts', $workouts);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreTrainingController $request)
    {
        $training = new Training;
        if($request->input('description') != NULL){
            $training->description = $request->input('description');
        } 
        $training->repetition = $request->input('repetition');
        $training->weight = $request->input('weight');
        $training->workout_id = $request->input('workout_id');
        $training->user_id = auth()->user()->id;
        $training->save();

        return redirect('/home')->with('success', 'Nový trénink byl vytvořen');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {      
        $training = Training::find($id);
        $workout = Workout::find($training->workout_id);
        $body_part = Body_Part::find($workout->body_part_id);
        
        $training->workout_name = $workout->workout_name;
        $training->name = $body_part->name;
        //return $training;
        return view('trainings.show')->with('training', $training);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $training = Training::find($id);

        if(auth()->user()->id !== $training->user_id){
            return redirect('/trainings')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $workout = WorkOut::find($training->workout_id);
        $body_part = Body_Part::find($workout->body_part_id);

        $training->workout_name = $workout->workout_name;
        $training->name = $body_part->name;

        $training->workouts = DB::select(
            'SELECT workouts.id, workouts.workout_name, body__parts.name 
            FROM workouts
            INNER JOIN body__parts ON workouts.body_part_id=body__parts.id
            GROUP BY body__parts.name'
        );

        $training->body_parts = Body_Part::all();
        return view('trainings.edit')->with('training', $training);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreTrainingController $request, $id)
    {
        $training = Training::find($id);
        if($request->input('description') != NULL){
            $training->description = $request->input('description');
        } 
        $training->repetition = $request->input('repetition');
        $training->weight = $request->input('weight');
        $training->workout_id = $request->input('workout_id');
        $training->save();

        return redirect('/trainings')->with('success', 'Trénink byl editován');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $training = Training::find($id);
        if(auth()->user()->id !== $training->user_id){
            return redirect('/trainings')->with('error', 'K této operaci nemáte oprávnění.');
        }

        $training->delete();
        return redirect('/trainings')->with('success', 'Trénink byl odstraněn.');
    }
}
