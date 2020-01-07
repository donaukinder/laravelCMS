<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\User;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $loggedId = intVal(Auth::id());

        $user = User::find($loggedId);

        if($user){
            return view('admin.profile.index', ['user' => $user]);
        }
        return redirect()->route('admin');
    }

    public function save(Request $request)
    {
        $loggedId = intVal(Auth::id());

        $user = User::find($loggedId);
        //Verificações padrão e Validações
        if ($user) {
            $data = $request->only([
                'name',
                'email',
                'password',
                'password_confirmation'
            ]);
            $validator = Validator::make([
                'name' => $data['name'],
                'email' => $data['email']
            ],[
               'name' => ['required', 'string', 'max:255'],
               'email' => ['required', 'string', 'max:255']
            ]);

            //Alteração do Nome
            $user->name = $data['name'];

            //Alteração do E-mail
            if ($user->email != $data['email']) {
                $hasEmail = User::where('email', $data['email'])->get();
                if (count($hasEmail) === 0) {
                    $user->email = $data['email'];
                }else {
                    $validator->errors()->add('email', __('validation.min.unique',[
                        'attribute' => 'email'
                    ]));
                }
            }
            //Verifica se vai alterar a senha, sem sim altera, se não continua como está
            if (!empty($data['password'])) {
                if(strlen($data['password']) >= 8){
                    if ($data['password'] === $data['password_confirmation']) {
                        $user->password = Hash::make($data['password']);
                    }else {
                        $validator->errors()->add('password', __('validation.confirmed',[
                            'attribute' => 'password'
                        ]));
                    }
                } else {
                    $validator->errors()->add('password', __('validation.min.string',[
                        'attribute' => 'password',
                        'min' => 8
                    ]));
                }
            }

            if (count($validator->errors()) > 0) {
                return redirect()->route('profile', [
                    'user' => $loggedId
                ])->withErrors($validator);
            }

            $user->save();

            return redirect()->route('profile')->with('warning', 'Informações alteradas com sucesso!');
        }

        return redirect()->route('profile');
    }
}
