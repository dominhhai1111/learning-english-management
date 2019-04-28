<?php

namespace App\Http\Controllers;

use App\Jobs\SendWelcomeEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class DashboardController extends Controller
{
    public function index()
    {
//        Mail::send('mail.test', ['test' => 'Test123'], function($message) {
//            $message->to('nomcbwcz@sharklasers.com')->subject('Test laravel mail');
//        });
        dispatch(new SendWelcomeEmail("Hello"));
        return view('dashboard');
    }
}
