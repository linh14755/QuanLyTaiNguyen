<?php

namespace App\Http\Controllers;

use App\Permission;
use App\Role;
use App\Traits\DeleteModelsTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    private $role;
    private $permission;
    use DeleteModelsTrait;

    public function __construct(Role $role, Permission $permission)
    {
        $this->role = $role;
        $this->permission = $permission;
    }

    public function index()
    {
        $roles = $this->role->latest()->paginate(15);
        return view('admin.role.index', compact('roles'));
    }

    public function create()
    {
        $roleParents = $this->permission->where('parent_id', 0)->get();
        return view('admin.role.add', compact('roleParents'));
    }

    public function store(Request $request)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->create([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);

            $role->permission()->attach($request->permission_id);

            DB::commit();
            return redirect()->route('role.index');
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function edit($id)
    {
        $roleParents = $this->permission->where('parent_id', 0)->get();
        $roleEdit = $this->role->find($id);
        $permissionChecked = $roleEdit->permission;

        return view('admin.role.edit', compact('roleParents', 'roleEdit', 'permissionChecked'));
    }

    public function update(Request $request, $id)
    {

        try {
            DB::beginTransaction();
            $this->role->find($id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name
            ]);

            $role = $this->role->find($id);
            $role->permission()->sync($request->permission_id);
            DB::commit();
            return redirect()->route('role.index');

        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $role = $this->role->find($id);
            $role->user()->detach();
            $role->permission()->detach();
            DB::commit();

            return $this->deleteModelTrait($id, $this->role);
        } catch (\Exception $exception) {
            Log::error('Message' . $exception->getMessage() . ' ------Line ' . $exception->getLine());
            DB::rollBack();
        }
    }
}
