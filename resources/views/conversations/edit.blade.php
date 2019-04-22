@extends('layout')

@section('page-inner')
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Edit conversation</h2>
            </div>
        </div>
        <div class="box box-warning direct-chat direct-chat-warning conversation-area">
            <div class="box-header with-border">
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <!-- Conversations are loaded here -->
                <div class="direct-chat-messages">
                    @foreach($lines as $line)
                    @if(!empty($line['user_id']))
                            <!-- Message. Default to the left -->
                    <div class="direct-chat-msg right">
                        <!-- /.direct-chat-info -->
                        <div class="direct-chat-text" style="margin: 0 0 0 50px">
                            {{$line['content']}}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                    @else
                            <!-- Message to the right -->
                    <div class="direct-chat-msg ">
                        <!-- /.direct-chat-info -->
                        <div class="direct-chat-text" style="margin: 0 50px 0 0">
                            {{$line['content']}}
                        </div>
                        <!-- /.direct-chat-text -->
                    </div>
                    <!-- /.direct-chat-msg -->
                    @endif
                    @endforeach
                </div>
                <!--/.direct-chat-messages-->

                <!-- Contacts are loaded here -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer">
                <form action="#" method="post">
                    <div class="input-group">
                        <input type="text" name="message" placeholder="Type Message ..." class="form-control message-input">
                      <span class="input-group-btn">
                        <p class="btn btn-warning btn-flat btn-send">Send</p>
                      </span>
                    </div>
                </form>
            </div>
            <!-- /.box-footer-->
        </div>
    </div>
    <script>
        var lastTime = '<?php echo !empty($lines) ? $lines[sizeof($lines) - 1]['created_at'] : 0 ?>';
        var conversation = <?php echo json_encode($conversation); ?>;
        var lines = <?php echo json_encode($lines); ?>;
    </script>
@endsection

@section('bottom-script')
    <script src="../js/conversations/conversation.js"></script>
@endsection
