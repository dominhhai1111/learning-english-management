<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;

class TopicsController extends Controller
{
    public function __construct() {
        $this->topics = new Topics();
    }

    public function listAction()
    {
        $topics = $this->topics->all()->toArray();

        return view('topics.list', ['topics' => $topics]);
    }

    public function addAction()
    {
        return view('topics.add');
    }

    public function editAction()
    {
        return view('topics.edit');
    }

    public function deleteAction()
    {

    }
}
