<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tests;
use App\Topics;
use App\Questions;
use Illuminate\Support\Facades\Config;


class TestsController extends Controller
{
    public function __construct() {
        $this->tests = new Tests();
        $this->topics = new Topics();
        $this->questions = new Questions();

        $this->myconf = config("myconf");
    }

    public function listAction() {
        $tests = $this->tests->getTestLists();

        return view('tests.list', ['tests' => $tests]);
    }

    public function addAction(Request $request) {
        $topics = $this->topics->all()->toArray();

        if ($request->method() == "POST") {
            $name = $request->input('name');
            $topic = $request->input('topic');
            $file = $request->file('image');
            $folder = 'resources/tests';
            $imageLink = $file->move($folder, $file->getClientOriginalName());

            $result = $this->tests->insert([
                'name' => $name,
                'part_id' => $topic,
                'image_link' => $imageLink,
                'created_at' => new \DateTime(),
                'updated_at' => new \DateTime()
            ]);
            if ($result) {
                return redirect('tests/list');
            }
        }

        return view('tests.add', ['topics' => $topics]);
    }

    public function editAction(Request $request) {
        $id = $request->query('id');
        $test = $this->tests->getTestById($id);
        $topic = $this->topics->where('id', $test['part_id'])->first();
        $questions = !empty($test['questions']) ? $this->questions->getQuestionsOfTest($test['questions']) : [];
        $questions = !empty($questions) ? $questions : [];

        if ($request->method() == "POST") {
            $params = $request->all();

            $questions = !empty($params['questions']) ? $params['questions'] : [];
            $questions = json_encode($questions);
            $name = $request->input('name');
            $file = $request->file('image');
            $folder = 'resources/tests';
            if (!empty($file)) {
                $imageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $updatedData = [];
            if (!empty($name)) $updatedData['name'] = $name;
            if (!empty($imageLink)) $updatedData['image_link'] = $imageLink;
            if (!empty($questions)) $updatedData['questions'] = $questions;
            if (!empty($updatedData)) $updatedData['updated_at'] = new \DateTime();

            if (!empty($updatedData)) {
                $result = $this->tests->where('id', $id)->update($updatedData);
            }

            if ($result) {
                return redirect('tests/list');
            }
        }

        return view('tests.edit', ['test' => $test, 'topic' => $topic, 'questions' => $questions, 'myconf' => $this->myconf]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->query('id');
        $result = $this->tests->where('id', $id)->delete();

        if ($result) {
            return redirect('tests/list');
        }
    }

    public function testPhotographAction(Request $request) {
        $id = $request->query('id');
        $test = $this->tests->getTestById($id);
        $questions = $this->questions->getQuestionsOfTest($test['questions']);
        $questions = $this->getFullChildrenQuestion($questions);

        return view('tests.testPhotograph', ['test' => $test, 'questions' => $questions]);
    }

    public function getQuestionById(Request $request) {
        $id = $request->query('questionId');
        $question = $this->questions->where('id', '=', $id)->first()->toArray();

        return response()->json($question);
    }

    public function getRandomQuestions(Request $request) {
        $data = $request->all();
        $easyQuestionNumber = !empty($data['easyQuestionNumber']) ? $data['easyQuestionNumber'] : 0;
        $mediumQuestionNumber = !empty($data['mediumQuestionNumber']) ? $data['mediumQuestionNumber'] : 0;
        $hardQuestionNumber = !empty($data['hardQuestionNumber']) ? $data['hardQuestionNumber'] : 0;

        $easyQuestions = $this->questions->where('level', '=', 1)->orWhere('level', '=', NULL)->get()->toArray();
        if (sizeof($easyQuestions) > $easyQuestionNumber && !empty($easyQuestionNumber)) {
            $easyQuestionIds = array_rand($easyQuestions, $easyQuestionNumber);
            foreach ($easyQuestionIds as $questionId) {
                $questions[] = $easyQuestions[$questionId];
            }
        }

        $mediumQuestions = $this->questions->where('level', '=', 2)->get()->toArray();
        if (sizeof($mediumQuestions) > $mediumQuestionNumber  && !empty($mediumQuestionNumber)) {
            $mediumQuestionIds = array_rand($mediumQuestions, $mediumQuestionNumber);
            foreach ($mediumQuestionIds as $questionId) {
                $questions[] = $mediumQuestions[$questionId];
            }
        }

        $hardQuestions = $this->questions->where('level', '=', 3)->get()->toArray();
        if (sizeof($hardQuestions) > $hardQuestionNumber  && !empty($hardQuestionNumber)) {
            $hardQuestionIds = array_rand($hardQuestions, $hardQuestionNumber);
            foreach ($hardQuestionIds as $questionId) {
                $questions[] = $hardQuestions[$questionId];
            }
        }

        return response()->json($questions);
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
