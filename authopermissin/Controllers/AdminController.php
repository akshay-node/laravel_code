<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class AdminController extends Controller
{
    public function admin_reg_view()
    {
        return view('admin');
    }


    public function admin_register(Request $request)
    {

        // $data = admin::where('id','1');
        // $data->hasRole('admin');
        // dd('hi');
        $data = admin::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);

        $role = Role::findById(1);
        $data->assignRole($role);

    }
}
