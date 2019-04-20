@extends('webview/user/layout')

@section('page-inner')
    <div class="webview-container user-info-screen">
        <div class="user-info-area">
            <p>User Name: {{$user['name']}}</p>
            <p>Email: {{$user['email']}}</p>
            <p>Scores: {{$user['scores']}}</p>
            <p>Rank:</p>
            <p>Registered date: {{$user['created_at']}}</p>
        </div>
    </div>
@endsection