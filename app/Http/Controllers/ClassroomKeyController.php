<?php

namespace App\Http\Controllers;

use App\ClassroomKey;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class ClassroomKeyController extends Controller
{
    public function create(Request $request) {
        $key = new ClassroomKey;
        $key->classroom_id = $request->classroom_id;
        $key->code = substr(Str::uuid()->toString(), -10);
        $key->save();
        return response(['status' => 'OK', 'message' => 'Código de Aula generado correctamente'], 200);
    }
}
