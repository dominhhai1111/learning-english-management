<?php

namespace App\Http\Controllers;

use App\User;
use App\UserTest;
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
        $this->users = new User();
        $this->userTest = new UserTest();
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
}
