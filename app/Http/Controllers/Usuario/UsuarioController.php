<?php

namespace App\Http\Controllers\Usuario;

use App\Http\Controllers\Controller;
use App\Models\Aluno;
use App\Models\Endereco;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use function Doctrine\Common\Cache\Psr6\get;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsuarioController extends Controller
{
    /**
     * @var User
     */
    private $userModel;
    /**
     * @var Role
     */
    private $roleModel;

    /**
     * UsuarioController constructor.
     */
    public function __construct(User $userModel, Role $roleModel)
    {
        $this->userModel = $userModel;
        $this->roleModel = $roleModel;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $rsUsuario = $this->userModel->orderBy('name', 'ASC')->paginate(15);

        return view('usuario.index', compact('rsUsuario'));
    }

    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $rsPerfil  = $this->roleModel->where('id','<>',1)->orderBy('name', 'ASC')->get();

        return view('usuario.create',compact('rsPerfil'));
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
        ]);

        DB::transaction(function () use ($request) {

            $user = $this->userModel->create([
                'name'      => $request->name,
                'last_name' => $request->last_name,
                'email'     => $request->email,
                'password'  => Hash::make($request->password),
            ]);


            /*
            $rsCurso = $this->cursosModel->find($request->input('txtidcurso'))->id;
            $rsAnexo->curso()->attach($rsCurso);
            */
            $user->assignRole($request->perfil);

        });

        return redirect(RouteServiceProvider::HOME);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
