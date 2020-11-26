<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\Exercise;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class ExercisesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Inertia::render('Admin/Exercises/Index', [
            'filters' => Request::all('search', 'trashed'),
            'exercises' => Exercise::filter(Request::only('search', 'trashed'))
                ->orderByName()
                ->paginate()
                ->transform(function ($exercise) {
                    return [
                        'id' => $exercise->id,
                        'name' => $exercise->name,
                        'deleted_at' => $exercise->deleted_at,
                    ];
                }),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($exercise_type)
    {

        return Inertia::render('Admin/Exercises/' . ucwords($exercise_type) . '/Create.vue', [
            'type' => 'Multiple'
        ]);
    }

    public function store()
    {
        Request::validate([
            'name' => ['required'],
        ]);

        Classroom::create([
            'name' => Request::get('first_name'),
        ]);

        return Redirect::route('admin.classrooms.index')->with('success', 'Aula creada correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function show(Exercise $exercise)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function edit(Exercise $exercise)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exercise $exercise)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exercise  $exercise
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exercise $exercise)
    {
        //
    }
}
