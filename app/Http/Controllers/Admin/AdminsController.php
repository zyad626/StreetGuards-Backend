<?php
namespace App\Http\Controllers\Admin;

use App\Models\Admin;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class AdminsController extends Controller
{
    public function index()
    {
        $admins = Admin::paginate();
        $data = [
            'admins' => $admins
        ];
        return view('admin.admins.index', $data);
    }

    public function create()
    {
        $admin = new Admin();

        $data = [
            'admin' => $admin,
            'action' => route('admin.admins.store')
        ];
        return view('admin.admins.create', $data);
    }

    public function store(Request $request)
    {
        $rules = [
            'login_name' => 'required|unique:mongodb.admins',
            'email' => 'unique:mongodb.admins',
            'password' => 'required|confirmed'
        ];
        $this->validate($request, $rules);

        $admin = new Admin();
        $this->loadAdmin($admin, $request);
        $admin->save();
        return redirect(route('admin.admins'));
    }

    public function edit($id)
    {
        $admin = Admin::findOrFail($id);

        $data = [
            'admin' => $admin,
            'action' => route('admin.admins.update', $id)
        ];
        return view('admin.admins.edit', $data);
    }

    public function update($id, Request $request)
    {
        $rules = [
            'login_name' => [
                'required',
                Rule::unique('mongodb.admins')->ignore($id, '_id')
            ],
            'email' => [
                Rule::unique('mongodb.admins')->ignore($id, '_id')
            ],
            'password' => 'confirmed',
        ];

        $this->validate($request, $rules);

        $admin = Admin::findOrFail($id);
        $this->loadAdmin($admin, $request);
        $admin->save();
        return redirect(route('admin.admins'));
    }

    protected function loadAdmin($admin, $request)
    {
        $admin->login_name = $request->login_name;
        $admin->email = $request->email;
        $admin->is_active = $request->is_active;
        if ($request->password) {
            $admin->password = bcrypt($request->password);
        }
    }
}
