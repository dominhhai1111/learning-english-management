<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tests;
use App\Topics;
use App\Questions;

class TestsController extends Controller
{
    public function __construct() {
        $this->tests = new Tests();
        $this->topics = new Topics();
        $this->questions = new Questions();
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
            $folder = storage_path('images/tests');
            $imageLink = $file->move($folder, $file->getClientOriginalName());

            $result = $this->tests->insert([
                'name' => $name,
                'topic_id' => $topic,
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
        $topic = $this->topics->where('id', $test['topic_id'])->first();
        $questions = $this->questions->getQuestionsOfTest($id);

        if ($request->method() == "POST") {
            $name = $request->input('name');
            $file = $request->file('image');
            $folder = storage_path('images/tests');
            if (!empty($file)) {
                $imageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $updatedData = [];
            if (!empty($name)) $updatedData['name'] = $name;
            if (!empty($imageLink)) $updatedData['image_link'] = $imageLink;
            if (!empty($updatedData)) $updatedData['updated_at'] = new \DateTime();

            if (!empty($updatedData)) {
                $result = $this->tests->where('id', $id)->update($updatedData);
            }

            if ($result) {
                return redirect('tests/list');
            }
        }

        return view('tests.edit', ['test' => $test, 'topic' => $topic, 'questions' => $questions]);
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
        $questions = $this->questions->getQuestionsOfTest($id);
        $questions = $this->getFullChildrenQuestion($questions);

        return view('tests.testPhotograph', ['test' => $test, 'questions' => $questions]);
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
