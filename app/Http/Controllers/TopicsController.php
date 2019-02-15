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
}
