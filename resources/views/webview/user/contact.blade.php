@extends('webview/user/layout')

@section('page-inner')
    <div class="webview-container contact-screen">
        <div class="btn-add-area">
            <p class="btn btn-success btn-add" onclick="startConversation(0)">New conversation</p>
        </div>


        <div class="list-conversation">
            @foreach($conversations as $conversation)
                <div class="box box-warning conversation" onclick="startConversation({{$conversation['id']}})">
                    <div class="box-header with-border">
                        <h3 class="box-title">{{$conversation['last_message']['content']}}</h3>
                    </div>
                    <div class="box-body">
                        Last message: {{$conversation['last_message']['created_at']}}
                    </div>
                    <!-- /.box-body -->
                </div>
            @endforeach
        </div>
    </div>
    <script>
        function startConversation(id) {
            if (id) {
                window.location.href = '/user/start-conversation?remember_token=' + "{{$user['remember_token']}}" + '&id=' + id;
            } else {
                window.location.href = '/user/start-conversation?remember_token=' + "{{$user['remember_token']}}";
            }

        }
    </script>
@endsection