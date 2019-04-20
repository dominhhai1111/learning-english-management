<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class UserController extends Controller
{
    public function __construct(Request $request)
    {
        $this->users = new User();
    }

    public function register(Request $request)
    {
        if ($request->method() == "POST") {
            $data = $request->all();
            $validatedData = $request->validate([
                'name'          => 'bail|required|max:191',
                'email'         => 'bail|required|email|max:191',
                'password'      => 'bail|required|max:191',
                're-password'   => 'bail|required|same:password',
            ]);
            $result = $this->users->insert([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]);
        }

        return View::make('webview/user/register');
    }
    
    public function info(Request $request)
    {
        $rememberToken = $request->query('remember_token');
        if (!empty($rememberToken)) {
            $user = $this->users->where(['remember_token' => $rememberToken])->first();
            Auth::setUser($user);
        }

        $params = [];
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];

        return View::make('webview/user/info', $params);
    }
}
