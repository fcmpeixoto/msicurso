<?php

namespace App\Http\Controllers\Permissao;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class PermissaoController extends Controller
{
    /**
     * @var User
     */
    private $user;

    /**
     * PermissaoController constructor.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // get a list of all permissions directly assigned to the user
        $permissionNames = $this->user->getPermissionNames(); // collection of name strings
        //$permissions4 = $this->user; // collection of permission objects

        // get all permissions for the user, either directly, or from roles, or from both
        $permissions1 = $this->user->getDirectPermissions();
        $permissions2 = $this->user->getPermissionsViaRoles();
        $permissions3 = $this->user->getAllPermissions();

        // get the names of the user's roles
        //$roles = $this->user->getRoleNames(); // Returns a collection

        dd(User::permission('curso-storage')->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
