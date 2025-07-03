<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class ApiController extends Controller
{
    public function getUsers(){
        $users = User::get();
        return response()->json(['data'=>$users]);
    }

    public function editUser($id){
        $user = User::findOrFail($id);
        return response()->json(['status'=>'success', "message"=>'Request Success', 'data' => $user]);
    }

    public function storeUser(Request $request){
        try {
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'required'
            ]);

            if($validator->fails()){
                return response()->json(['status'=>'error', 'errors' => $validator->errors()], 422);
            }
            $users = User::create($request->all());
            return response()->json(['data' => $users, 'message' => 'request sussess']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'request failed', 'error' => $th->getMessage(), 500]);
        }


    }

    public function updateUser(Request $request, $id){
        try {
            $user = User::findorFail($id);
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email|unique:users,email',
                'password' => 'nullable'
            ]);

            if($validator->fails()){
                return response()->json(['status'=>'error', 'errors' => $validator->errors()], 422);
            }


            $user->name= $request->name;
            $user->email= $request->email;

            if($request->filled('password')){
                $user->password = Hash::make($request->password);
            }
            $user->save();

            return response()->json(['status' => 'success', 'message' => 'request update success', 'data' => $user]);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'request failed', 'error' => $th->getMessage(), 500]);
        }


    }

    public function deleteUser($id){
        try {
            $user = User::findOrFail($id);
            $user->delete();
            return response()->json(['status' => 'success', 'message' => 'request delete success']);
        } catch (\Throwable $th) {
            return response()->json(['status' => 'error', 'message' => 'request delete failed', 'error' => $th->getMessage(), 500]);
        }
    }
}
