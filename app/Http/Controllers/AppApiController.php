<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Topics;

class AppApiController extends Controller
{
    /**
     * AppApiController constructor.
     */
    public function __construct()
    {
        $this->topics = new Topics();    
    }

    function getAllTopics() 
    {
        $topics = json_encode($this->topics->all()->toArray());
        echo $topics;
    }
}
