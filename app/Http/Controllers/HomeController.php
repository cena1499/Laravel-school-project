<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);

        $trainings = DB::select(
            'SELECT trainings.id, trainings.description, trainings.repetition, trainings.weight, trainings.created_at, workouts.workout_name,body__parts.name 
            FROM trainings
            INNER JOIN workouts ON trainings.workout_id=workouts.id
            INNER JOIN body__parts ON workouts.body_part_id=body__parts.id
            INNER JOIN users ON users.id=trainings.user_id
            WHERE users.id = ' . $user_id
        );
        return view('home')->with('trainings', $trainings);
    }
}
