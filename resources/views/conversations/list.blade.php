@extends('layout')

@section('page-inner')
    <div id="page-inner">
        <div class="row">
            <div class="col-lg-12">
                <h2>Conversation List</h2>
            </div>
        </div>
        <div class="row">
            <div class="table-area">
                <table id="topics-table" class="display">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Last Message</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($conversations as $conversation)
                        <tr>
                            <td>{{$conversation['id']}}</td>
                            <td>{{$conversation['user_name']}}</td>
                            <td>{{$conversation['last_message']['content']}}</td>
                            <td>
                                <button type="button" class="btn btn-success" onclick="location.href='/conversations/edit?id={{$conversation['id']}}'">Edit</button>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('bottom-script')
    <link href="../DataTables/datatables.css" rel="stylesheet" />
    <link href="../css/topics/list.css" rel="stylesheet" />
    <script src="../DataTables/datatables.js"></script>
    <script src="../js/topics/list.js"></script>
@endsection
