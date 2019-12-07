@extends('layouts.app')
@section('title')
Login Register
@stop
@section('additional_style')
<style>
    img#pp {border-radius:50%; width:75px; height:75px;}
    #timeline {height:69vh; overflow: auto;}
    table {width:100%;}
    td#pp-cel {width:5%;}
    th span, td span {margin-left:1%; margin-right:1%;}
    #my-post {background-color:#96f55b;}
</style>
@stop
@section('content')
<div class="container">
    <div class="row">
        <div class="col-sm-12" style="background-color:gray;">
            <div class="form-group" style="padding-left:2%; padding-right:2%; padding-top:1%;">
                <input type="text" class="form-control" name="status" id="status" placeholder="Update status...">
            </div>
            <div class="form-group text-right" style="padding-right:2%;">
                <button id="submit" type="button" class="btn-primary">Update</button>
            </div>
        </div>
    </div>
    <button class="btn btn-primary" id="reload">Reload</button>
    <div class="container" id="timeline">
        
    </div>
</div>
@endsection
@section('additional_script')
<script>
    $(document).ready(function() {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.get('{{route("post.index")}}', function(data) {
            console.log(data);
            var users = data.users;
            var i = 0;
            data.posts.forEach(post => {
                createPostView(post, users[i]);
                i++;
            });
        });

        $('#reload').click(function() {
            $('#timeline').empty();
            $.get('{{route("post.index")}}', function(data) {
                var users = data.users;
                var i = 0;
                data.posts.forEach(post => {
                    createPostView(post, users[i]);
                    i++;
                });
            });
        });

        $('#status').keypress(function (e) {
            if (e.which == 13) {
                var status = $("#status").val();
                $.ajax({
                    type:'POST',
                    url:'{{route("post.store")}}',
                    data:{user_id:{{$user->id}}, status:status},
                    success:function(data){
                        update(data.post, data.user);
                    }
                });
                $(this).val("");
                return false;
            }
        });

        $("#submit").click(function(e){
            e.preventDefault();
            var status = $("#status").val();
            $.ajax({
                type:'POST',
                url:'{{route("post.store")}}',
                data:{user_id:{{$user->id}}, status:status},
                success:function(data){
                    update(data.post, data.user);
                }
            });
        });
    });

    function update(data, user) {
        $('#timeline').prepend(
            '<div class="row border-top" id="my-post">'+
                '<table class="text-right">'+
                    '<tbody>'+
                        '<tr>'+
                            '<td class="align-top"><span><strong>'+user['name']+'</strong></span><br><span>'+data['status']+'</span></td>'+
                            '<td id="pp-cel">'+
                                '<img id="pp" src="/images/profiles/'+user['image']+'" alt="">'+
                            '</td>'+
                        '</tr>'+
                    '</tbody>'+
                '</table>'+
            '</div>'
        );
    }
    
    function createPostView(data, user) {
        if(user['id'] == {{$user->id}}) {
            $('#timeline').append(
                '<div class="row border-top" id="my-post">'+
                    '<table class="text-right">'+
                        '<tbody>'+
                            '<tr>'+
                                '<td class="align-top"><span><strong>'+user['name']+'</strong></span><br><span>'+data['status']+'</span></td>'+
                                '<td id="pp-cel">'+
                                    '<img id="pp" src="/images/profiles/'+user['image']+'" alt="">'+
                                '</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>'
            );
        }
        else {
            $('#timeline').append(
                '<div class="row border-top" id="friend-post">'+
                    '<table class="text-left">'+
                        '<tbody>'+
                            '<tr>'+
                                '<td id="pp-cel">'+
                                    '<img id="pp" src="/images/profiles/'+user['image']+'" alt="">'+
                                '</td>'+
                                '<td class="align-top">'+
                                    '<span><strong>'+user['name']+'</strong></span><br>'+
                                    '<span>'+data['status']+'</span>'+
                                '</td>'+
                            '</tr>'+
                        '</tbody>'+
                    '</table>'+
                '</div>'
            );
        }
    }
</script>
@endsection
