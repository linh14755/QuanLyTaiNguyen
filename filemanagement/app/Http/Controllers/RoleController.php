<?php

namespace App\Http\Controllers;

use App\Role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    private $role;
    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    public function index()
    {
        $roles = $this->role->latest()->paginate(15);
        return view('admin.role.index',compact('roles'));
    }
}
