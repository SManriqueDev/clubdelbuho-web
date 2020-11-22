<?php

namespace App\Http\Controllers\Auth;

use App\ClassroomKey;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Client\Request;
use Illuminate\Support\Facades\Hash;
use Inertia\Inertia;

class LoginController extends Controller
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

    /**
     * Show the application's login form.
     *
     * @return \Inertia\Response
     */
    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function showRegisterForm(): \Inertia\Response
    {
        return Inertia::render('Auth/Register');
    }

    public function register(Request $request)
    {
        $code = ClassroomKey::where('code', $request->classroom_key)->first();
        if ($code) {
            if ($code->student_id) {
                return response()->json(['status' => 'ERROR', 'message' => 'El código de aula ya se encuentra en uso'], 401);
            }

            $user = $this->create($request->all());
            $role = Role::find($code->role_id);
            $user->assignRole($role);

            $code->student_id = $this->createStudent($user, $code->classroom_id)->id;
            $code->update();

            return response()->json(['user' => $user, 'access_token' => $user->createToken('mundolector-secreto-765')->accessToken], 200);
        }
        return response()->json(['status' => 'ERROR', 'message' => 'Código de aula inválido'], 401);
        User::create();
        return Inertia::render('Auth/Register');
    }


    protected function create(array $data): User
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
