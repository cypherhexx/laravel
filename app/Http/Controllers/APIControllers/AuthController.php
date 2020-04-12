<?php

namespace App\Http\Controllers\APIControllers;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\RegistersUsers;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
     
     use RegistersUsers;
        
    public function register(Guard $auth, Request $request) {
        
        $fields = ['email', 'password', 'name'];
        // grab credentials from the request
        $credentials = $request->only($fields);
        
        $validator = Validator::make(
            $credentials,
            [
                'name' => 'required|max:255',
                'email' => 'required|email|max:255|unique:users',
                'password' => 'required|min:6',
            ]
            );
        if ($validator->fails())
        {
            return response($validator->messages());
        }
        
        $result = User::create([
            'name' => $credentials['name'],
            'email' => $credentials['email'],
            'password' => bcrypt($credentials['password']),
        ]);
        
        $result['token'] = $this->tokenFromUser($result['id']);        

        return response($result->only(['email', 'token']));
    }
    
    
    protected function login(Request $request) {
        
        auth()->shouldUse('api');
        // grab credentials from the request
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            $result['token'] = auth()->issue();
            $result['email'] = $credentials['email'];
           return response($result);
        }
    
        return response(['Invalid Credentials']);
    }
    
    public function tokenFromUser($id)
    {
        // generating a token from a given user.
        $user = User::find($id);
    
        auth()->shouldUse('api');
        // logs in the user
        auth()->login($user);
    
        // get and return a new token
        $token = auth()->issue();
    
        return $token;
    }
}
