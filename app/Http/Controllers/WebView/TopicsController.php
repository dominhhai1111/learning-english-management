<?php

namespace App\Http\Controllers\WebView;

use App\Http\Controllers\Controller;
use App\Topics;

class TopicsController extends Controller
{
    public function __construct()
    {
        $this->topics = new Topics();
    }

    public function listTopics()
    {
        $topics = $this->topics->all()->toArray();

        return view('webview/user/listTopics', ['topics' => $topics]);
    }
}