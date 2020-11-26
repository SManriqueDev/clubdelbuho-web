<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;

class ClassroomController extends Controller
{
    public function index()
    {
        return Inertia::render('Admin/Classrooms/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'classrooms' => Classroom::filter(Request::only('search', 'trashed'))
                ->orderByName()
                ->paginate()
                ->transform(function ($classroom) {
                    return [
                        'id' => $classroom->id,
                        'name' => $classroom->name,
                        'deleted_at' => $classroom->deleted_at,
                    ];
                }),
        ]);
    }

    public function store()
    {
        Request::validate([
            'name' => ['required'],
        ]);

        Classroom::create([
            'name' => Request::get('name'),
            'school_id' => User::find(Auth::id())->school_id,
        ]);

        return Redirect::route('admin.classrooms.index')->with('success', 'Aula creada correctamente');
    }
}
