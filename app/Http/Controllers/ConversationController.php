<?php

namespace App\Http\Controllers;

use App\ConversationLines;
use App\Conversations;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;

class ConversationController extends Controller
{
    public function __construct(Request $request)
    {
        $this->users = new User();
        $this->conversations = new Conversations();
        $this->conversationLines = new ConversationLines();
    }
    
    public function listConversations()
    {
        $conversations = $this->conversations->orderBy('updated_at', 'desc')->get();
        $conversations = $this->formatConversations($conversations);
//dd($conversations);
        $params = [];
        $params['conversations'] = !empty($conversations) ? $conversations : [];

        return View::make('conversations/list', $params);
    }

    public function edit(Request $request)
    {
        $conversationId = $request->query('id');
       
        $conversation = $this->conversations->where(['id' => $conversationId])->first();
        $conversationLines = $this->conversationLines->where(['chat_id' => $conversationId])->get();
        
        $params = [];
        $params['conversation'] = $conversation;
        $params['lines'] = $conversationLines;

        return View::make('conversations/edit', $params);
    }

    private function formatConversations($conversations)
    {
        $formatConversations = [];
        foreach ($conversations as $conversation) {
            $conversationLines = $this->conversationLines->where(['chat_id' => $conversation['id']])->orderBy('id', 'DESC')->get()->toArray();
            if (!empty($conversationLines)) {
                $conversation['last_message'] = $conversationLines[0];
                $user = $this->users->where(['id' => $conversation['user_id']])->first();
                $conversation['user_name'] = $user['name'];
                $formatConversations[] = $conversation;
            }
        }

        return $formatConversations;
    }
}
