<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserAddRequest;
use App\Http\Requests\UserEditRequest;
use App\Role;
use App\Traits\DeleteModelsTrait;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;

class UserController extends Controller
{
    private $user;
    private $role;
    use DeleteModelsTrait;

    public function __construct(User $user, Role $role)
    {
        $this->user = $user;
        $this->role = $role;
    }

    public function index()
    {
        $users = $this->user->latest()->paginate(10);
        return view('admin.user.index', compact('users'));
    }

    public function create()
    {
        $roles = $this->role->all();
        return view('admin.user.add', compact('roles'));
    }

    public function store(UserAddRequest $request)
    {
        try {
            DB::beginTransaction();
            $path = '';
            if (!empty($_FILES['image_path']['name'])) {
                $file = $_FILES['image_path']['tmp_name'];
                $path = $_FILES['image_path']['name'];
                $path_parts = pathinfo($path);
                $path = "user/" . time() . '.' . $path_parts['extension'];
            }

            $user = $this->user->create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'image_path' => $path
            ]);

            $roleIds = $request->role_id;

            $user->roles()->attach($roleIds);
            if (!empty($_FILES['image_path']['name'])) {
                move_uploaded_file($file, $path);
            }

            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $roles = $this->role->all();
        $userEdit = $this->user->find($id);
        $rolesOfUser = $userEdit->roles;

        return view('admin.user.edit', compact('userEdit', 'roles', 'rolesOfUser'));
    }

    public function update(UserEditRequest $request, $id)
    {

        try {
            DB::beginTransaction();
            $path = $this->user->find($id)->image_path;

            if (!empty($_FILES['image_path']['name'])) {
                $file = $_FILES['image_path']['tmp_name'];
                $path = $_FILES['image_path']['name'];
                $path_parts = pathinfo($path);
                $path = "user/" . time() . '.' . $path_parts['extension'];
            }


            $this->user->find($id)->update([
                'name' => $request->name,
                'email' => $request->email,
                'image_path' => $path
            ]);
            if ($request->password != null) {
                $this->user->find($id)->update([
                    'password' => Hash::make($request->password),
                ]);
            }

            $user = $this->user->find($id);
            $roleIds = $request->role_id;

            $user->roles()->sync($roleIds);

            if (!empty($_FILES['image_path']['name'])) {
                move_uploaded_file($file, $path);
            }


            DB::commit();
            return redirect()->route('user.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        return $this->deleteModelTrait($id, $this->user);
    }
}
