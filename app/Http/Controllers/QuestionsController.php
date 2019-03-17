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
            $questionType = $request->input('questionType');
            if (!empty($questionType) & $questionType == 'photograph') {
                $result = $this->createPhotographQuestion($request);
            }

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

    private function createPhotographQuestion($request)
    {
        if (empty($request)) return NULL;

        $result = false;
        $params = $request->all();
        $questions = !empty($params['questions']) ? $params['questions'] : [];
        if (empty($questions)) return NULL;

        //create folder
        $folder = storage_path('images/questions/photographs') . date('YmdHis');
        mkdir($folder, 0777, true);

        //set radio link
        $radioFile = $params['radio_link'];
        if (!empty($radioFile)) {
            $radioLink = $radioFile->move($folder, $radioFile->getClientOriginalName());
        }

        //create parent question
        $parentQuestionData = [
            'topic_id'      => 1,
            'parent_id'     => 0,
            'level'         => !empty($request->input('level')) ? $request->input('level') : 1,
            'description'   => !empty($request->input('description')) ? $request->input('description') : '',
            'radio_link'    => $radioLink,
            'created_at'    => new \DateTime(),
            'updated_at'    => new \DateTime()
        ];
        $savedParentQuestionId = $this->questions->insertGetId($parentQuestionData);

        //create children questions
        foreach ($questions as $question) {
            $file = $question['image'];
            if (!empty($file)) {
                $imageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $questionData = [
                'topic_id'      => 1,
                'parent_id'     => $savedParentQuestionId,
                'image_link'    => $imageLink,
                'created_at'    => new \DateTime(),
                'updated_at'    => new \DateTime()
            ];

            $savedQuestionId = $this->questions->insertGetId($questionData);
        }

        return $result;
    }
}
