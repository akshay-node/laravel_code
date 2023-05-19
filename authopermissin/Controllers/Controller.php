<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use App\Models\admin;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function reg_view()
    {
        return view('register');
    }
    public function login_view()
    {
        return view('login');
    }

    public function register(Request $request)
    {


        // $role = Role::create(['name' => 'admin']);
        // $role = Role::create(['name' => 'user']);
        // $permission = Permission::create(['name' => 'add']);
        // $permission = Permission::create(['name' => 'update']);
        // $permission = Permission::create(['name' => 'delete']);
        // $permission = Permission::create(['name' => 'view']);
        // $role1 = Role::findById('1');
        // $role = Role::findById('2');
        // $permission1 = Permission::findById('1');
        // $permission2 = Permission::findById('2');
        // $permission3 = Permission::findById('4');

        // $role1->givePermissionTo(permission::all());
        // $role->givePermissionTo($permission1, $permission2, $permission3);

        $data = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password)
        ]);
        $role = Role::findById('2');
        $data->assignRole($role);

        return view('login');
    }
    public function login(Request $request)
    {




        $data = $request->email;
       $psw = $request->password;
    //    if()
         //  dd($psw);
       // dd($data);
    //    $data = admin::where('id', '1')->first();
    //        $show = $data->hasRole('admin');
    //         dd($show);
        $emails = admin::where('email' , $data)->first();
        // // dd($emails);
        // dd($newpsw);
        if(!is_null($emails)){
        $newpsw = $emails->password;

            // $dta = [
            //         'email' => $request->input('email'),
            //         'password' => $request->input('password')
            //     ];
    
            //     if (Auth::attempt($dta)) {
            //         return view('home');
            //     } else {
            //         echo "wroong";
            //     }
            if ( Hash::check($psw , $newpsw)){
                return view('home');
            } 
        }elseif(is_null($emails)){

            $dta = [
                'email' => $request->input('email'),
                'password' => $request->input('password')
            ];

            if (Auth::attempt($dta)) {
                return view('home');
            } else {
                echo "wroong";
            }
        }else{

            abort(404);
         }
    }



    public function logout(Request $request)
    {
        Auth::logout();
        return view('welcome');
    }



    public function home(){
        return view('home');
    }
}

