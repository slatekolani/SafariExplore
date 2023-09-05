<?php

namespace App\Http\Controllers\Admin;


use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\RegisterSystemUserRequest;
use App\Http\Requests\Admin\UpdateSystemUserRequest;
use App\Http\Requests\Auth\UpdateUserRequest;
use App\Models\Auth\PermissionGroup;
use App\Models\Auth\Role;
use App\Models\Auth\User;
use App\Repositories\Access\PermissionRepository;
use App\Repositories\Access\RoleRepository;
use App\Repositories\Access\UserRepository;
use App\Repositories\Admin\UserManagementRepository;
use Yajra\DataTables\Facades\DataTables;

class UserManagementController extends Controller
{

    protected $user_repo;

    public function __construct()
    {
        $this->user_repo = new UserManagementRepository();

    }

    /*Manage users*/
    public function index()
    {
        return view('admin/users/menu');
    }


    /*System Users list*/
    public function systemUsersList()
    {
        return view('admin/users/system_users/index');
    }



    /**
     * Create system user by Admin
     */
    public function createSystemUser()
    {
        $role_repo = new RoleRepository();
        $roles = $role_repo->getAdministrativeRolesForSelect();
        return view('admin/users/system_users/create/create')
            ->with('administrative_roles', $roles);
    }


    /*Store system user*/

    public function storeSystemUser(RegisterSystemUserRequest $request)
    {
        $input = $request->all();
        $this->user_repo->storeSystemUser($input);
        return redirect()->route('admin.user_manage.system_users')->withFlashSuccess(trans('alert.general.created'));
    }


    /*Edit system user*/
    public function editSystemUser(User $user)
    {
        $roles = Role::query()->pluck('name','id');
        return view('admin/users/system_users/edit/edit')
            ->with('user', $user)
            ->with('roles', $roles);

    }

    /*Update system user*/
    public function updateSystemUser(User $user,UpdateSystemUserRequest $request )
    {
        $input = $request->all();
        $this->user_repo->updateSystemUser($user, $input);
        return redirect()->route('admin.user_manage.system_users')->withFlashSuccess(trans('alert.general.updated'));
    }

    /*Get users for DataTable*/
    public function getSystemUsersForDt()
    {

        return DataTables::of($this->user_repo->getSystemUsersForDt())
            ->addIndexColumn()
            ->addColumn('username', function ($user) {
                return $user->username;
            })
            ->addColumn('created_date', function ($user) {
                return ($user->created_at);
            })
            ->addColumn('active_status', function ($user) {
                return $user->active_status_label;
            })
            ->addColumn('role_label', function ($user) {
                return '';
            })
            ->rawColumns(['role_label', 'active_status'])
            ->make(true);
    }



}
