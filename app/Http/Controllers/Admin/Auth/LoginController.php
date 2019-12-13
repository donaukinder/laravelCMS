<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function index()
    {
        return view('admin.login');
    }

    public function authenticate(Request $request)
    { 
        $data = $request->only([
            'email',
            'password'
        ]);
        $validator = $this->validator($data);

        $remember = $request->input('remember', false);

        if ($validator->fails()) {
            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();
        }

        if (Auth::attempt($data, $remember)) {
            return redirect()->route('admin');
        }else {
            $validator->errors()->add('password', 'E-mail e/ou senha incorretos!');

            return redirect()->route('login')
            ->withErrors($validator)
            ->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

    protected function validator(array $data)
    {
        return Validator::make($data, [
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:8']
        ]);
    }
}
