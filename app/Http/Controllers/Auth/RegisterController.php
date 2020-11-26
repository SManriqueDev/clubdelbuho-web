<?php

namespace App\Http\Controllers\Auth;

use App\Models\ClassroomKey;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Request;
use Inertia\Inertia;
use Spatie\Permission\Models\Role;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    public function showRegisterForm(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    public function register()
    {
        $request = Request::validate([
            'email' => ['required', 'max:50', 'email'],
            'password' => ['required', 'min:6'],
            'classroom_key' => ['required'],
        ]);
        $code = ClassroomKey::where('code', $request['classroom_key'])->first();
        if ($code) {
            if ($code->student_id) {
                return Redirect::back()->with('error', 'El código de aula ya se encuentra en uso');
            }

            $user = $this->create($request->all());
            $role = Role::find($code->role_id);
            $user->assignRole($role);

            $code->student_id = $this->createStudent($user, $code->classroom_id)->id;
            $code->update();

            return response()->json(['user' => $user, 'access_token' => $user->createToken('mundolector-secreto-765')->accessToken], 200);
        }
        return Redirect::back()->with('error', 'Código de aula inválido');
    }


    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'school_id' => $data['school_id'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
