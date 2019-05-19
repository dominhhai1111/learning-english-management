<?php

namespace App\Http\Controllers;

use App\ConversationLines;
use App\Conversations;
use App\User;
use App\UserTest;
use Illuminate\Http\Request;
use App\Topics;
use Illuminate\Support\Facades\Auth;

class AppApiController extends Controller
{
    /**
     * AppApiController constructor.
     */
    public function __construct()
    {
        $this->topics = new Topics();
        $this->users = new User();
        $this->userTest = new UserTest();
        $this->conversations = new Conversations();
        $this->conversationLines = new ConversationLines();
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
            'status'    => 'fail',
            'message'   => 'Login Failed'
        ];

        if (!empty($email) && !empty($password)) {
            //check auth
            $credentials = ["email" => $email, "password" => $password];
            $checkLogin = Auth::attempt($credentials, true);
            if ($checkLogin) {
                $user = Auth::user();
                $result = [
                    'status'            => 'success',
                    'message'           => 'Login Success',
                    'remember_token'    => $user['remember_token']
                ];
            }
        }

        return response()->json($result);
    }

    public function autoLogin(Request $request)
    {
        $data = $request->all();
        $rememberToken = !empty($data['remember_token']) ? $data['remember_token'] : '';
        $user = $this->users->where(['remember_token' => $rememberToken])->first();
        
        if (!empty($user)) {
            $result = [
                'status'            => 'success',
                'message'           => 'Login Success',
            ];
        } else {
            $result = [
                'status'    => 'fail',
                'message'   => 'Login Failed'
            ];
        }

        return response()->json($result);
    }

    public function updateMemberResult(Request $request)
    {
        $data = $request->all();
        $userId = !empty($data['user_id']) ? $data['user_id'] : '';
        $testId = !empty($data['test_id']) ? $data['test_id'] : '';
        $score = !empty($data['score']) ? $data['score'] : 0;
        $time = !empty($data['time']) ? (int)$data['time'] : 0;
        $savedData = [
            "user_id"   => $userId,
            "test_id"   => $testId,
            "score"     => $score,
            "time"      => $time
        ];

        $where = [
            "user_id"   => $savedData['user_id'],
            "test_id"   => $savedData['test_id'],
        ];
        $userTestRecord = $this->userTest->where($where)->first();

        $result = [
            'isUpdated'         => false,
            'isHighestScore'    => false
        ];
        if (empty($userTestRecord)) {
            $savedUserTest = $this->userTest->create($savedData);
            if ($savedUserTest) {
                $result = [
                    'isUpdated'         => true,
                    'isHighestScore'    => true
                ];
            }
        } elseif (!empty($userTestRecord) && $userTestRecord['score'] < $score) {
            $savedUserTest = $this->userTest->where(['id' => $userTestRecord['id']])->update($savedData);
            if ($savedUserTest) {
                $result = [
                    'isUpdated'         => true,
                    'isHighestScore'    => true
                ];
            }
        }

        $this->users->updateMemberScores($userId);

        return response()->json($result);
    }

    public function updateConversation(Request $request)
    {
        $data = $request->all();
        $lastTime = !empty($data['last_time']) ? $data['last_time'] : 0;

        $chatId = !empty($data['chat_id']) ? $data['chat_id'] : '';

        $result = [
            'hasNew'    => false,
            'new_lines' => []
        ];

        $conversationLines = $this->conversationLines
            ->where(['chat_id' => $chatId])
            ->where('created_at', '>', $lastTime)
            ->get();

        if (!empty($conversationLines) && sizeof($conversationLines) > 0) {
            $result = [
                'hasNew'    => true,
                'new_lines' => $conversationLines,
                'last_time' => $conversationLines[sizeof($conversationLines) - 1]['created_at']
            ];
        }

        return response()->json($result);
    }

    public function sendConversation(Request $request)
    {
        $data = $request->all();
        $userId = !empty($data['user_id']) ? $data['user_id'] : '';
        $chatId = !empty($data['chat_id']) ? $data['chat_id'] : '';
        $content = !empty($data['content']) ? $data['content'] : '';

        $result = [
            'status'    => 'fail',
            'message'   => 'Send Failed'
        ];

        $newData = [
            'chat_id'   => $chatId,
            'content'   => $content
        ];

        if (!empty($userId)) {
            $newData['user_id'] = $userId;
        }
        
        $conversationLine = $this->conversationLines->create($newData);
        $this->conversations->where(['id' => $chatId])->update(['updated_at' => new \DateTime()]);

        if (!empty($conversationLine)) {
            $result = [
                'status'    => 'success',
                'message'   => 'Send success'
            ];
        }

        return response()->json($result);
    }
}
