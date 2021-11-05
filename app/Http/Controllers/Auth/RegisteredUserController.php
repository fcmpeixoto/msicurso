<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Endereco;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'last_name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['required', 'cpf'],
            'data_nascimento' => ['required', 'date_format:d/m/Y'],
            'cep' => ['required', 'cep'],
            'cidade' => ['required', 'min:5', 'max:120'],
            'uf' => ['required', 'min:2', 'max:2'],
            'logradouro' => ['required', 'min:5', 'max:255'],
            'numero' => ['required', 'min:1', 'max:6'],
            'complemento' => ['required', 'max:120'],
            'bairro' => ['required',  'min:5', 'max:120'],
            'telefone' => ['required', 'telefone_com_ddd'],
            'celular' => ['required', 'celular_com_ddd'],
            'tipo' => ['required', 'in:1,2,3'],
        ]);

        DB::transaction(function () use ($request) {

            $user = User::create([
                'name'      => $request->name,
                'last_name' => $request->last_name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);

            $aluno = Aluno::create([
                'users_id'        => $user->id,
                'tipo_pessoa'     => $request->tipo,
                'matricula'       => gerarMatricula(5,true,false,true,false),
                'cpf'             => $request->cpf,
                'data_nascimento' => $request->data_nascimento,
                'telefone'        => $request->telefone,
                'celular'         => $request->celular,
            ])->id;

            Endereco::create([
                'aluno_id'        => $aluno,
                'cep'             => $request->cep,
                'logradouro'      => $request->logradouro,
                'complemento'     => $request->complemento,
                'numero'          => $request->numero,
                'bairro'          => $request->bairro,
                'localidade'      => $request->cidade,
                'uf'              => $request->uf,
            ]);


            event(new Registered($user));

            Auth::login($user);

            $user->assignRole('aluno');
        });

        return redirect(RouteServiceProvider::HOME);
    }
}
