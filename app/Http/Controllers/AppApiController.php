<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AppApiController extends Controller
{
    /**
     * AppApiController constructor.
     */
    public function __construct()
    {
        $this->topics = new Topics();    
    }

    public function getAllTopics()
    {
        $topics = json_encode($this->topics->all()->toArray());
        echo $topics;
    }

    public function login(Request $request)
    {
        $data = $request->all();
        $email = !empty($data['email']) ? $data['email'] : '';
        $password = !empty($data['password']) ? $data['password'] : '';

        $result = [
            'status'    => 404,
            'message'   => 'Login Failed'
        ];

        if (!empty($email) && !empty($password)) {
            //check auth
            $credentials = ["email" => $email, "password" => $password];
            $checkLogin = Auth::attempt($credentials, true);
            if ($checkLogin) {
                $user = Auth::user();
                $result = [
                    'status'            => 200,
                    'message'           => 'Login Success',
                    'remember_token'    => $user['remember_token']
                ];
            }
        }

        return response()->json($result);
    }

}
