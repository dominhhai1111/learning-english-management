<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 21/4/2019
 * Time: 8:13 PM
 */

namespace App\Http\Controllers\WebView;

use App\ConversationLines;
use App\Conversations;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\View;

class ConversationController extends Controller
{
    public function __construct(Request $request)
    {
        $this->users = new User();
        $this->conversations = new Conversations();
        $this->conversationLines = new ConversationLines();
        $rememberToken = $request->query('remember_token');
        if (!empty($rememberToken)) {
            $user = $this->users->where(['remember_token' => $rememberToken])->first();
            Auth::setUser($user);
        }
    }

    public function contact(Request $request)
    {
        $user = Auth::user();
        $conversations = $this->conversations->where(['user_id' => $user['id']])->get();
        $conversations = $this->formatConversations($conversations);
        
        $params = [];
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];
        $params['conversations'] = !empty($conversations) ? $conversations : [];

        return View::make('webview/user/contact', $params);
    }

    public function start(Request $request)
    {
        $conversationId = $request->query('id');
        $user = Auth::user();
        if (empty($conversationId)) {
            $newData = [
                'user_id'   => $user['id'],
                'status'    => FLAG_ON
            ];
            $conversation = $this->conversations->create($newData);
            $conversationLines = [];
        } else {
            $conversation = $this->conversations->where(['id' => $conversationId])->first();
            $conversationLines = $this->conversationLines->where(['chat_id' => $conversationId])->get();
        }
        
        $params = [];
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];
        $params['conversation'] = $conversation;
        $params['lines'] = $conversationLines;

        return View::make('webview/user/createConversation', $params);
    }

    private function formatConversations($conversations)
    {
        $formatConversations = [];
        foreach ($conversations as $conversation) {
            $conversationLines = $this->conversationLines->where(['chat_id' => $conversation['id']])->orderBy('id', 'DESC')->get()->toArray();
            if (!empty($conversationLines)) {
                $conversation['last_message'] = $conversationLines[0];
                $formatConversations[] = $conversation;
            }
        }

        return $formatConversations;
    }
}