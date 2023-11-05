<?php

namespace App\Http\Controllers\Dashboard\Auth;

use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:role-list|role-create|role-edit|role-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:role-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:role-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:role-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Role::get();
            return $this->rolesDataTable($data)->escapeColumns([])->make(true);
        }
        return view('role.index');
    }

    // !tabel
    private function rolesDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('role.edit', $data->id) . "'>$data->name</a>";
            })
            ->addColumn('action', function ($data) {
                return '
          <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false">
                <span class="zmdi zmdi-more"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a class="dropdown-item" id="del" data-url="' . route('role.destroy', $data->id) . '"><i
                        class="fas fa-times text-orange-red"></i><span>' . __('delete') . '</span></a>
                <a class="dropdown-item"
                    href="' . route('role.edit', $data->id) . '"><i
                        class="fas fa-cogs text-dark-pastel-green"></i><span>' . __('edit') . '</span></a>

            </div>
        </div>
          ';
            });
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $permissions = Permission::get();
        return view('role.action.create', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:roles,name',
            'permission_id' => 'required',
        ]);

        $role = Role::create(['name' => $request->input('name')]);
        $role->syncPermissions($request->input('permission_id'));

        return redirect()->route('role.index')
            ->with('success', 'Role created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $role = Role::find($id);
        $permissions = Permission::get();
        $rolePermissions = DB::table("role_has_permissions")->where("role_has_permissions.role_id", $id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();
        return view('role.action.edit', compact('role', 'permissions', 'rolePermissions'));
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
        $this->validate($request, [
            'name' => 'required',
            'permission_id' => 'required',
        ]);

        $role = Role::find($id);
        $role->name = $request->input('name');
        $role->save();

        $role->syncPermissions($request->input('permission_id'));

        return redirect()->route('role.index')
            ->with('success', 'Role updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        DB::table("roles")->where('id', $id)->delete();
        return redirect()->route('role.index')
            ->with('success', 'Role deleted successfully');
    }
}
