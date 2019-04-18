<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Questions;
use App\Tests;
use Illuminate\Http\Request;

class TestsController extends Controller
{
    public function __construct()
    {
        $this->tests = new Tests();
        $this->questions = new Questions();
    }

    public function listTests(Request $request)
    {
        $topicId = $request->query('topic-id');
        $tests = $this->tests->where(['topic_id' => $topicId])->get()->toArray();
//dd($tests);
        return view('webview/user/listTests', ['tests' => $tests]);
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