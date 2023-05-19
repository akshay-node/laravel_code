<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\moment;


class UserController extends Controller
{
    public $successStatus = 200;
    public function register(Request $request)
    {
        $val = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'min:5', 'confirmed'
        ]);

        $user = User::create($val);
        $tokenobj = $user->createToken('APPLICATION')->accessToken;
        $user->remember_token = $tokenobj;
        $user->save();
        return response()->json([
            'token' => $tokenobj,
            'user' => $user,
            'message' => 'successfully'
        ]);



        // print_r( $token);

        // return redirect()->json([$val]);
    } 
  
    
   
    public function details()
    {
        $user = User::first();
        return response()->json(['success' => $user], $this->successStatus);
    }

    public function login(Request $request)
    {
        // print_r($request->all());
      
        $eml = $request->email;
        $user = User::where('email', $eml)->first();
        // dd($user);

        $tokenobj['token'] = $user->createToken('token')->accessToken;
        if (!is_null($user)){
            return response()->json([
                'success' => 'done',
                'tokens' => $tokenobj['token']
            ],);
        } else {
            return response()->json(['error' => 'Unauthorised'], 401);
        }
    }
    /**moment(testDate).format('MM/DD/YYYY');
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
