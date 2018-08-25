<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        //dd($data);
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'doc' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'num_doc' => 'required|unique:users,dni,ruc'
        ];

        $messages = [
            'name.required' => 'El campo nombre es requerido',
            'name.string' => 'El campo nombre debe contener letras',
            'name.max' => 'El campo nombre debe tener máximo 255 caracteres',
            'email.required' => 'El campo email debe tener máximo 255 caracteres',
            'email.string' => 'El campo email debe tener letras',
            'email.email' => 'El campo email debe tener estructrura de email',
            'email.max' => 'El campo email debe tener máximo 255 caracteres',
            'email.unique' => 'Este email ya esta siendo usado',
            'password.required' => 'El campo password es obligatorio',
            'password.string' => 'El password debe tener letras',
            'password.min' => 'El password debe tener minimo 6 caracteres',
            'password.confirmed' => 'Las contraseñas no coinciden',
            'doc.required' => 'El campo tipo de documento es requerido',
            'address.required' => 'El campo dirección es requerido',
            'phone.required' => 'El campo telefono es requerido',
            'num_doc.required' => 'El campo numero de documento es requerido',
            'num_doc.unique' => 'Este numero de documento ya esta usado.',

        ];

        $validator = Validator::make($data, $rules, $messages);

        $validator->after(function ($validator) use ($data){
            if ($data['doc']==1 && strlen($data['num_doc']) != 8) {
                $validator->errors()->add('document', 'Dni incorrecto');
            }

            if ($data['doc']==2 && strlen($data['num_doc']) != 11) {
                $validator->errors()->add('document', 'RUC incorrecto');
            }
        });


        return $validator;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        //dd($data);
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'role_id' => 3,
            'password' => Hash::make($data['password']),
            'address' => $data['address'],
            'phone' => $data['phone'],
        ]);

        if ($data['doc']==1){
            $user->dni = $data['num_doc'];
            $user->save();
        } else {
            $user->ruc = $data['num_doc'];
            $user->save();
        }

        return $user;
    }
}
