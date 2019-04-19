<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Topics;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopicsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->topics = new Topics();
        $this->user = new User();

        $rememberToken = $request->query('remember_token');
        if (!empty($rememberToken)) {
            $user = $this->user->where(['remember_token' => $rememberToken])->first();
            Auth::setUser($user);
        }
    }

    public function listTopics(Request $request)
    {
        $topics = $this->topics->all()->toArray();

        $params = [];
        $params['topics'] = $topics;
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];

        return view('webview/user/listTopics', $params);
    }
}