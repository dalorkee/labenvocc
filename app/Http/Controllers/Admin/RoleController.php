<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\{Role,Permission};
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
	function __construct() {
		$this->middleware('auth');
		$this->middleware(['role:root|admin']);
	}

	protected function index(Request $request): object {
		$roles = Role::orderBy('id', 'ASC')->paginate(10);
		return view('admin.roles.index', compact('roles'))->with('i', ($request->input('page', 1) - 1) * 5);
	}

	protected function create(): object {
		$permission = Permission::get();
		return view('admin.roles.create', compact('permission'));
	}

	protected function store(Request $request): object {
		$this->validate($request, [
			'name' => 'required|unique:roles,name',
			'permission' => 'required',
		]);
		$role = Role::create(['name' => $request->input('name')]);
		$role->syncPermissions($request->input('permission'));
		return redirect()->route('roles.index')->with('success', 'Role created successfully');
	}

	protected function show($id): object {
		$role = Role::find($id);
		$rolePermissions = Permission::join("role_has_permissions", "role_has_permissions.permission_id", "=", "permissions.id")
			->where("role_has_permissions.role_id", $id)
			->get();
		return view('admin.roles.show', compact('role', 'rolePermissions'));
	}

	protected function edit($id): object {
		$role = Role::find($id);
		$permission = Permission::get();
		$rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id",$id)
			->pluck('role_has_permissions.permission_id','role_has_permissions.permission_id')
			->all();
		return view('admin.roles.edit', compact('role', 'permission', 'rolePermissions'));
	}

	protected function update(Request $request, $id) {
		$this->validate($request, [
			'name' => 'required',
			'permission' => 'required',
		]);
		$role = Role::find($id);
		$role->name = $request->input('name');
		$role->save();
		$role->syncPermissions($request->input('permission'));
		return redirect()->route('roles.index')->with('success', 'Role updated successfully');
	}

	protected function destroy($id) {
		DB::table("roles")->where('id', $id)->delete();
		return redirect()->route('roles.index')->with('success', 'Role deleted successfully');
	}
}
