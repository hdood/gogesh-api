<?php

namespace App\Http\Controllers\Dashboard\Auth;

use DataTables;
use App\Models\User;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'show']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            $data = User::get();
            return $this->usersDataTable($data)->escapeColumns([])->make(true);
        }
        return view('user.index');
    }

    // !tabel
    private function usersDataTable($data)
    {
        return Datatables::of($data)->addIndexColumn()
            ->addColumn('name', function ($data) {
                return "<a href='" . route('user.edit', $data->id) . "'>$data->name</a>";
            })
            ->addColumn('email', function ($data) {
                return $data->email;
            })
            ->addColumn('role', function ($data) {
                $span = "";
                if (!empty($data->getRoleNames())) {
                    foreach ($data->getRoleNames() as $key => $role) {
                        $span .= "<span class='badge rounded-pill bg-dark text-light'>" . $role . "</span>";
                    }
                } else {
                    $span =  '<span class="badge rounded-pill bg-></span>';
                }
                return $span;
            })
            ->addColumn('action', function ($data) {
                return '
          <div class="dropdown">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown"
                aria-expanded="false">
                <span class="zmdi zmdi-more"></span>
            </a>
            <div class="dropdown-menu dropdown-menu-left">
                <a class="dropdown-item" id="del" data-url="' . route('user.destroy', $data->id) . '"><i
                        class="fas fa-times text-orange-red"></i><span>' . __('delete') . '</span></a>
                <a class="dropdown-item"
                    href="' . route('user.edit', $data->id) . '"><i
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
        $roles = Role::get();
        return view('user.action.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);

        $user = User::create($input);
        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User created successfully');
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
        $user = User::find($id);
        $roles = Role::all();
        $userRole = $user->roles->pluck('id', 'id')->all();
        return view('user.action.edit', compact('user', 'roles', 'userRole'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|confirmed',
            'roles' => 'required'
        ]);

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }

        $user = User::find($id);
        $user->update($input);
        DB::table('model_has_roles')->where('model_id', $id)->delete();

        $user->assignRole($request->input('roles'));

        return redirect()->route('user.index')
            ->with('success', 'User updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find($id)->delete();
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
