<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Questions;
use App\Tests;
use App\User;
use App\UserTest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->tests = new Tests();
        $this->questions = new Questions();
        $this->user = new User();
        $this->userTest = new UserTest();

        $rememberToken = $request->query('remember_token');
        if (!empty($rememberToken)) {
            $user = $this->user->where(['remember_token' => $rememberToken])->first();
            Auth::setUser($user);
        }
    }

    public function listTests(Request $request)
    {
        $topicId = $request->query('topic-id');
        $tests = $this->tests->where(['topic_id' => $topicId])->get()->toArray();
        $tests = $this->formatTest($tests);

        $params = [];
        $params['tests'] = $tests;
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];

        return view('webview/user/listTests', $params);
    }

    public function test(Request $request) {
        $id = $request->query('id');
        $test = $this->tests->getTestById($id);
        $questions = $this->questions->getQuestionsOfTest($test['questions']);
        $questions = $this->formatQuestions($questions);
        $questions = $this->getFullChildrenQuestion($questions);
       
        $view = "webview/user/test" . $this->getTopicView($test['topic_id']);

        $params = [];
        $params['test'] = $test;
        $params['questions'] = $questions;
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];

        return view($view, $params);
    }

    private function getFullChildrenQuestion($questions) {
        if (empty($questions)) return NULL;

        $formatQuestions = $questions;
        foreach ($questions as $key => $question) {
            $childrenQuestions = $this->questions->where(['parent_id' => $question['id']])->get()->toArray();
            $formatQuestions[$key]['children'] = $childrenQuestions;
        }

        return $formatQuestions;
    }

    private function formatTest($tests) {
        if (empty($tests)) return NULL;

        $user = Auth::user();

        foreach ($tests as $key => $test) {
            //Get totalScore
            $totalScore = 0;
            $questions = $this->questions->getQuestionsOfTest($test['questions']);
            $questions = $this->getFullChildrenQuestion($questions);

            foreach ($questions as $question) {
                if (!empty($question["children"])) {
                    $totalScore += sizeof($question["children"]);
                } else {
                    $totalScore += 1;
                }
            }

            $tests[$key]['total_score'] = $totalScore;

            //Get user test record
            $where = [
                "user_id"   => $user['id'],
                "test_id"   => $test['id'],
            ];
            $userTestRecord = $this->userTest->where($where)->first();
            if (!empty($userTestRecord)) {
                $tests[$key]['highest_score'] = $userTestRecord['score'];
                $tests[$key]['time'] = $userTestRecord['time'];
                $tests[$key]['record_created'] = date_format($userTestRecord['updated_at'], 'Y-m-d h:i:s');
            }
        }

        return $tests;
    }

    private function getTopicView($topicId) {
        switch ($topicId) {
            case 1: return "Photograph";
            case 2: return "QuestionResponse";
            case 3: return "ShortConversations";
            case 4: return "ShortTalks";
            case 5: return "IncompleteSentences";
            case 6: return "TextCompletion";
            case 7: return "ReadingComprehension";
        }
    }

    private function formatQuestions($questions) {
        foreach ($questions as $key => $question) {
            $questions[$key]['answers'] = (array)json_decode($questions[$key]['answers']);
        }

        return $questions;
    }
}