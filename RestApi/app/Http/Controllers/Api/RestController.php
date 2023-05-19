<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\apis;
// use Illuminate\Database\Eloquent\Factories\Factory;
use Tymon\JWTAuth\Contracts\Providers\Auth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Jwtapi;
use PHPOpenSourceSaver\JWTAuth\Contracts\Providers\Auth as ProvidersAuth;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTAuth\factory;
use Tymon\JWTAuth\Facades\JWTAuth;

class RestController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // return response()->json([
        //     'data'=>apis::get()->toArray()
        // ]);

        $data = apis::get();
        echo count($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $val = Validator::make($request->all(), [
            'name' => ['required'],
            'email' => ['required', 'email', 'unique:apis'],
            'password' => ['required', 'min:5']

        ]);
        if ($val->fails()) {
            return response()->json($val->messages(), 400);
        } else {

            $data = [
                'name' => $request->name,
                'email' => $request->email,
                'password' => $request->password
            ];
            DB::beginTransaction();

            try {
                $usser = Jwtapi::create($data);
                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
            }
        }
        if ($usser != null) {
            return response()->json([

                'message' => 'user is create',


                $d = $request->all(),
                print_r($d),
            ]);
        } else {
            return response()->json(['messages' => 'internal server error'], 500);
        }
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update($id, Request $request)
    {
        $data = Jwtapi::find($id);

        print_r($request->all());
        if (is_null($data)) {

            return response()->json([
                'message' => 'errrrorrr'
            ]);
        } else {
            DB::beginTransaction();
            print_r($request->all());

            try {
                $data->name = $request['name'];
                $data->email = $request['email'];
                $data->password = $request['password'];
                $data->save();
                DB::commit();
            } catch (\Exception $er) {
                $er->getMessage();
                Db::rollBack();
            }

            if (!is_null($request)) {
                return response()->json([
                    'message' => 'done dond done'
                ]);
            } else {

                return response()->json([
                    'message' => 'empty'
                ]);
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Jwtapi::find($id);
        if ($data != null) {
            DB::beginTransaction();
            try {
                $data->delete();
                DB::commit();
            } catch (\Exception $err) {
                DB::rollBack();
            }
            return response()->json([
                'message' => 'doneee'
            ]);
        } else {
            return response()->json([
                'message' => 'not exists'
            ]);
        }
    }


    public function register(Request $request){
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $credentials = $request->only('email', 'password');
        $token = Auth()->attempt($credentials);
        return response()->json([
            'status' => 'success',
            'message' => 'User created successfully',
            'user' => $user,
            'authorisation' => [
                'token' => $token,
                'type' => 'bearer',
            ]
        ]);
    }
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
        ]);
        $credentials = $request->only('email', 'password');

        $token = Auth()->attempt($credentials);
        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => 'Unauthorized',
            ], 401);
        }

        $user = Auth()->user();
        return response()->json([
                'status' => 'success',
                'user' => $user,
                'authorisation' => [
                    'token' => $token,
                    'type' => 'bearer',
                    'expire_in' => Auth::factory()->getTTL()  
                ]
            ]);



    }


    public function logout()
    {
        Auth::logout();
        return response()->json([
            'status' => 'success',
            'message' => 'Successfully logged out',
        ]);
    }
 
}
 

  // public function (){}
  // public function (){}
