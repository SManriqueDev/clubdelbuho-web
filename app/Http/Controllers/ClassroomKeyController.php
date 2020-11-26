<?php

namespace App\Http\Controllers;

use App\Models\Classroom;
use App\Models\ClassroomKey;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Str;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class ClassroomKeyController extends Controller
{
    public function create(Request $request) {
        $key = new ClassroomKey;
        $key->classroom_id = $request->classroom_id;
        $key->code = substr(Str::uuid()->toString(), -10);
        $key->save();
        return response(['status' => 'OK', 'message' => 'Código de Aula generado correctamente'], 200);
    }

    public function index()
    {
        return Inertia::render('Admin/ClassroomKeys/Index', [
            'filters' => \Illuminate\Support\Facades\Request::all('search', 'trashed'),
            'classroomkeys' => ClassroomKey::filter(Request::only('search', 'trashed'))
                ->orderByName()
                ->paginate()
                ->transform(function ($exercise) {
                    return [
                        'id' => $exercise->id,
                        'code' => $exercise->name,
                        'deleted_at' => $exercise->deleted_at,
                    ];
                }),
            'classrooms' => Classroom::all(),
            'roles' => Role::all()
        ]);
    }

}
