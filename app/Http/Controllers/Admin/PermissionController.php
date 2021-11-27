<?php
namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\{Role,Permission};
use Illuminate\Support\Facades\{Validator,Auth,Session};

class PermissionController extends Controller {

	public function __construct() {
		$this->middleware(['auth']);
		$this->middleware(['role:root|admin']);
	}

	public function index(): object {
        $uer = auth()->user();
        if ($uer->can('permission-create')) {
            dd('ok');
        }
        dd('y');

		$permissions = Permission::all();
		return view('admin.permissions.index')->with('permissions', $permissions);
	}

	public function create() {
		$roles = Role::get();
		return view('permissions.create')->with('roles', $roles);
	}

	public function store(Request $request) {
		$rules = array('name' => 'required|max:40|unique:permissions',);
		$v = Validator::make($request->all(), $rules);
		if ($v->fails()) {
			return redirect()->route('permissions.create')->with('error', 'PermissionName : '. $request->name.' Duplicate!');
		}

		$name = $request['name'];
		$permission = new Permission();
		$permission->name = $name;
		$roles = $request['roles'];
		$permission->save();

		if (!empty($request['roles'])) {
			foreach ($roles as $role) {
				$r = Role::where('id', '=', $role)->firstOrFail();
				$permission = Permission::where('name', '=', $name)->first();
				$r->givePermissionTo($permission);
			}
		}
		return redirect()->route('permissions.index')->with('success', 'PermissionName : '. $permission->name.' created successfully!');
	}

	public function show($id) {
		return redirect('permissions');
	}

	public function edit($id) {
		$permission = Permission::findOrFail($id);
		return view('permissions.edit', compact('permission'));
	}

	public function update(Request $request, $id) {
		$permission = Permission::findOrFail($id);
		$this->validate($request, [
			'name'=>'required|max:40',
		]);
		$input = $request->all();
		$permission->fill($input)->save();

		return redirect()->route('permissions.index')->with('success', 'PermissionName : '. $request->name.' edit successfully!');
	}

	public function destroy($id) {
		$permission = Permission::findOrFail($id);
		// dd($permission);
		// //Make it impossible to delete this specific permission
		// if ($permission->name == "Administer roles & permissions") {
		//	return redirect()->route('permissions.index')
		//  	->with('flash_message',
		//		'Cannot delete this Permission!');
		//}
		$permission->delete();
		return redirect()->route('permissions.index')->with('success', 'Permission deleted!');
	}
}
