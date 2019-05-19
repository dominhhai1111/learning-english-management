<?php

namespace App\Http\Controllers;

use App\Questions;
use Illuminate\Http\Request;
use App\Tests;
use App\Topics;
use App\Services\ImportService;

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

    public function importAction(Request $request) {
        $topics = $this->topics->all()->toArray();
        $params = [];
        $params['topics'] = $topics;

        if ($request->method() == "POST") {
            $data = $request->all();
            ImportService::importQuestions($data['file'], $data['part_id']);
            return redirect('questions/list');
        }

        return view('questions.import', $params);
    }

    public function addAction(Request $request) {

//        dd($request->all());
        $topicId = $request->query('part_id');
        $view = "questions.add" . $this->getTopicView($topicId);
        $topics = $this->topics->all()->toArray();

        if ($request->method() == "POST") {
            $questionType = $request->input('questionType');
            if (!empty($questionType)) {
                switch ($questionType) {
                    case $questionType == PHOTOGRAPH:
                        $result = $this->createPhotographQuestion($request);
                        break;
                    case $questionType == INCOMPLETE_SENTENCES:
                        $result = $this->createIncompleteSentencesQuestion($request);
                        break;
                }
            }

            if ($result) {
                return redirect('questions/list');
            }
        }

        return view($view, ['topics' => $topics]);
    }

    public function editAction(Request $request) {
        $id = $request->query('id');
        $question = $this->questions->where('id', '=', $id)->first()->toArray();
        $topic = $this->topics->where(['id' => $question['part_id']])->first()->toArray();
        $childrenQuestions = $this->questions->where(['parent_id' => $id])->get();
        $question['answers'] = (array)json_decode($question['answers']);
//        dd($question);
        if (!empty($childrenQuestions)) {
            $childrenQuestions = $childrenQuestions->toArray();
        } else {
            $childrenQuestions = [];
        }
        $view = "questions.edit" . $this->getTopicView($question['part_id']);
        
        if ($request->method() == "POST") {
            $questionType = $request->input('questionType');
            if (!empty($questionType)) {
                switch ($questionType) {
                    case $questionType == PHOTOGRAPH:
                        $result = $this->updatePhotographQuestion($request);
                        break;
                    case $questionType == INCOMPLETE_SENTENCES:
                        $result = $this->updateCompleteSentences($request);
                        break;
                }

            }
            return redirect('questions/list');
        }

        return view($view, ['question' => $question, 'topic' => $topic, 'childrenQuestions' => $childrenQuestions]);
    }

    public function deleteAction(Request $request)
    {
        $id = $request->query('id');
        $result = $this->questions->where('id', $id)->delete();

        if ($result) {
            return redirect('questions/list');
        }
    }

    private function createPhotographQuestion($request)
    {
        if (empty($request)) return NULL;
        
        $params = $request->all();
        $questions = !empty($params['questions']) ? $params['questions'] : [];
        if (empty($questions)) return NULL;

        //create folder
        $folder = 'resources/questions/photographs' . date('YmdHis');
        mkdir($folder, 0777, true);

        //set radio link
        $radioFile = !empty($params['radio_link']) ? $params['radio_link'] : '';
        if (!empty($radioFile)) {
            $radioLink = $folder . '/' . $radioFile->getClientOriginalName();
            $savedRadioLink = $radioFile->move($folder, $radioFile->getClientOriginalName());
        }

        //create parent question
        $parentQuestionData = [
            'part_id'      => 1,
            'parent_id'     => 0,
            'level'         => !empty($request->input('level')) ? $request->input('level') : 1,
            'description'   => !empty($request->input('description')) ? $request->input('description') : '',
            'radio_link'    => $radioLink,
            'image_link'    => $folder,
            'created_at'    => new \DateTime(),
            'updated_at'    => new \DateTime()
        ];
        $savedParentQuestionId = $this->questions->insertGetId($parentQuestionData);

        //create children questions
        foreach ($questions as $question) {
            $file = !empty($question['image']) ? $question['image'] : '';
            if (!empty($file)) {
                $imageLink = $folder . '/' . $file->getClientOriginalName();
                $savedImageLink = $file->move($folder, $file->getClientOriginalName());
            }

            $questionData = [
                'part_id'          => 1,
                'parent_id'         => $savedParentQuestionId,
                'image_link'        => $imageLink,
                'created_at'        => new \DateTime(),
                'updated_at'        => new \DateTime(),
                'correct_answer'    => $question['option']
            ];

            $savedQuestionId = $this->questions->insertGetId($questionData);
        }

        return true;
    }

    private function updatePhotographQuestion($request) {
        $params = $request->all();
        $parentQuestion = $this->questions->where('id', '=', $params['id'])->first()->toArray();
        $parentData = [];
        $parentData['description'] = $params['description'];
        $parentData['level'] = $params['level'];
        $childrenQuestions = $params['questions'];
        if (!empty($childrenQuestions)) {
            foreach ($childrenQuestions as $key =>$question) {
                if (strpos($key, 'new') !== false) {
                    //add new question
                    $file = !empty($question['image']) ? $question['image'] : '';
                    if (!empty($file)) {
                        $imageLink = $parentQuestion['image_link'] . '/' . $file->getClientOriginalName();
                        $savedImageLink = $file->move($parentQuestion['image_link'], $file->getClientOriginalName());
                    }

                    $questionData = [
                        'part_id'      => 1,
                        'parent_id'     => $parentQuestion['id'],
                        'image_link'    => $imageLink,
                        'created_at'    => new \DateTime(),
                        'updated_at'    => new \DateTime(),
                        'correct_answer'    => $question['option']
                    ];

                    $savedQuestionId = $this->questions->insertGetId($questionData);
                } else {
                    $file = !empty($question['image']) ? $question['image'] : '';
                    if (!empty($file)) {
                        $imageLink = $parentQuestion['image_link'] . '/' . $file->getClientOriginalName();
                        $savedImageLink = $file->move($parentQuestion['image_link'], $file->getClientOriginalName());
                    }
                    $questionData = [];
                    $questionData['updated_at'] = new \DateTime();
                    if (!empty($imageLink)) $questionData['image_link'] = $imageLink;
                    if (!empty($question['option'])) $questionData['correct_answer'] = $question['option'];

                    $updatedQuestion = $this->questions->where('id', $key)->update($questionData);
                }
            }
        }

        $updatedParentQuestion = $this->questions->where('id', $params['id'])->update($parentData);
    }

    private function createIncompleteSentencesQuestion($request) {
        $params = $request->all();

        $questionData = [
            'part_id'          => INCOMPLETE_SENTENCES,
            'parent_id'         => 0,
            'level'             => !empty($params['level']) ? $params['level'] : 1,
            'question'          => !empty($params['question']) ? $params['question'] : '',
            'answers'           => !empty($params['answers']) ? json_encode($params['answers']) : '',
            'description'       => !empty($params['description']) ? $params['description'] : '',
            'created_at'        => new \DateTime(),
            'updated_at'        => new \DateTime(),
            'correct_answer'    => !empty($params['correct_answer']) ? $params['correct_answer'] : 'A',
        ];

        $savedQuestionId = $this->questions->insertGetId($questionData);
    }

    private function updateCompleteSentences($request)
    {
        $params = $request->all();
        $id = $request->query('id');

        $questionData = [
            'part_id'          => INCOMPLETE_SENTENCES,
            'parent_id'         => 0,
            'level'             => !empty($params['level']) ? $params['level'] : 1,
            'question'          => !empty($params['question']) ? $params['question'] : '',
            'answers'           => !empty($params['answers']) ? json_encode($params['answers']) : '',
            'description'       => !empty($params['description']) ? $params['description'] : '',
            'created_at'        => new \DateTime(),
            'updated_at'        => new \DateTime(),
            'correct_answer'    => !empty($params['correct_answer']) ? $params['correct_answer'] : 'A',
        ];

        $updatedQuestion = $this->questions->where('id', $id)->update($questionData);
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
}
