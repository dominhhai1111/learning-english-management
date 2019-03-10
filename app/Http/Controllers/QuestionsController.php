<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;
use App\Tests;
use App\Topics;

class QuestionsController extends Controller
{
    public function __construct() {
        $this->tests = new Tests();
        $this->topics = new Topics();
        $this->questions = new Questions();
    }

    public function listAction() {
        $questions = $this->questions->getQuestionList();
        $topics = $this->topics->all()->toArray();

        return view('questions.list', ['topics' => $topics, 'questions' => $questions]);
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

        return view('questions.addPhotograph', ['topics' => $topics]);
    }

    public function editAction(Request $request) {
        $id = $request->query('id');
        $test = $this->tests->getTestById($id);
        $topics = $this->topics->all()->toArray();
        if ($request->method() == "POST") {
            $name = $request->input('name');
            $topic = $request->input('topic');
            $file = $request->file('image');
            $folder = storage_path('images/tests');
            if (!empty($file)) {
                $imageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $updatedData = [];
            if (!empty($topic)) $updatedData['topic_id'] = $topic;
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

        return view('tests.edit', ['test' => $test, 'topics' => $topics]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->query('id');
        $result = $this->tests->where('id', $id)->delete();

        if ($result) {
            return redirect('tests/list');
        }
    }
}
