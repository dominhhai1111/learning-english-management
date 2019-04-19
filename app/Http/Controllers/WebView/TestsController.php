<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Questions;
use App\Tests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TestsController extends Controller
{
    public function __construct(Request $request)
    {
        $this->tests = new Tests();
        $this->questions = new Questions();
        $this->user = new User();

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

        $params = [];
        $params['tests'] = $tests;
        $params['user'] = !empty(Auth::user()) ? Auth::user() : [];

        return view('webview/user/listTests', $params);
    }

    public function test(Request $request) {
        $id = $request->query('id');
        $test = $this->tests->getTestById($id);
        $questions = $this->questions->getQuestionsOfTest($test['questions']);
        $questions = $this->getFullChildrenQuestion($questions);
        $render = '';
        if ($test['topic_id'] == 1) {
            $render = 'webview/user/testPhotograph';
        }

        return view($render, ['test' => $test, 'questions' => $questions]);
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
}