<?php

namespace App\Services;

use App\Questions;

class ImportService
{
    public static function importQuestions($file, $partId)
    {
        switch ($partId) {
            case INCOMPLETE_SENTENCES: self::importIncompleteSentences($file);
        }
    }

    public static function importIncompleteSentences($file)
    {
        try {
            $fp = fopen($file, 'rb');
            $questions = [];
            $answers = '';
            $last = 0;
            $isBeginAnswers = false;
            while ( ($line = fgets($fp)) !== false) {
                if (preg_match('/^[0-9]+\.([^\.]+)/', $line)) {
                    $last = substr($line, 0, strpos($line, '.'));
                    $questions[$last]['text'] = $line;
                } elseif (strpos($line, '*ANSWERS') !== false) {
                    $isBeginAnswers = true;
                } elseif ($isBeginAnswers) {
                    $answers .= $line;
                } elseif ($last) {
                    $questions[$last]['text'] .= $line;
                }
            }

            $formatQuestions = [];
            foreach ($questions as $key => $question) {
                $questionTmp = '';
                $question['text'] = str_replace(array("\n", "\r", "\t"), '', $question['text']);
                $patternQuestion = '/[0-9]+\.([^\.]+)\./';
                preg_match_all($patternQuestion, $question['text'], $questionTmp);
                $questionTmp = $questionTmp[1];
                $formatQuestions[$key]['question'] = $questionTmp[0];

                $patternAnswerA = '/\(A\)[a-zA-Z0-9\s]+/';
                preg_match_all($patternAnswerA, $question['text'], $questionTmp);
                $questionTmp = $questionTmp[0];
                $formatQuestions[$key]['answers']['A'] = trim((substr($questionTmp[0], 3)));

                $patternAnswerA = '/\(B\)[a-zA-Z0-9\s]+/';
                preg_match_all($patternAnswerA, $question['text'], $questionTmp);
                $questionTmp = $questionTmp[0];
                $formatQuestions[$key]['answers']['B'] = trim((substr($questionTmp[0], 3)));

                $patternAnswerA = '/\(C\)[a-zA-Z0-9\s]+/';
                preg_match_all($patternAnswerA, $question['text'], $questionTmp);
                $questionTmp = $questionTmp[0];
                $formatQuestions[$key]['answers']['C'] = trim(substr($questionTmp[0], 3));

                $patternAnswerA = '/\(D\)[a-zA-Z0-9\s]+/';
                preg_match_all($patternAnswerA, $question['text'], $questionTmp);
                $questionTmp = $questionTmp[0];
                $formatQuestions[$key]['answers']['D'] = trim((substr($questionTmp[0], 3)));
            }

            if (!empty($answers)) {
                $answers = str_replace(array("\n", "\r", "\t"), '', $answers);
                preg_match_all('/[0-9]+(\s+)\([ABCD]+\)/', $answers, $formatAnswers);
                $formatAnswersTmp = $formatAnswers[0];
                $formatAnswers = [];
                foreach ($formatAnswersTmp as $answer) {
                    $key = trim(substr($answer, 0, strpos($answer, '(')));
                    $value = trim(substr($answer, strpos($answer, '(') + 1, 1));
                    $formatAnswers[$key] = $value;
                }
            }

            $questionData = [];
            if (!empty($formatQuestions)) {
                foreach ($formatQuestions as $key => $question) {
                    $questionData[] = [
                        'part_id'           => INCOMPLETE_SENTENCES,
                        'parent_id'         => 0,
                        'level'             => 1,
                        'question'          => !empty($question['question']) ? $question['question'] : '',
                        'answers'           => !empty($question['answers']) ? json_encode($question['answers']) : '',
                        'description'       => !empty($question['description']) ? $question['description'] : '',
                        'created_at'        => new \DateTime(),
                        'updated_at'        => new \DateTime(),
                        'correct_answer'    => !empty($formatAnswers[$key]) ? $formatAnswers[$key] : '',
                    ];
                }
            }
            
            $questions = new Questions();
            $questions->insert($questionData);
        } catch (\Exception $ex) {

        }

    }
}