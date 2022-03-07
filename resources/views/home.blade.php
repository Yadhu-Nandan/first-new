 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
<meta name="csrf-token" content="{{ csrf_token() }}" />
@extends('master')
@section('title','Homepage')
@section('content')

<h3>Post a message</h3>
    <form action="/create" method="POST">
        <input type="text" name='title' placeholder="Title">      
        <input type="text" name='content' placeholder="Content">
        {{csrf_field()}}
        <button type="submit">Post</button>

    </form>

    <h3>Recent Messages</h3>
    <ul>

        @foreach($messages as $message)
        <li>
           <strong> {{$message->title}} </strong><br>
                {{$message->content}}<br>
                {{$message->updated_at->diffForHumans()}}<br>
                <a href="/message/{{$message->id}}">View</a>
                <a href="/message/delete/{{$message->id}}">Delete</a>
                <a href='' id="editmessage" data-toggle="modal" data-target="#modalEdit" onclick="edits({{$message->id}})" data-id="{{$message->id}}" >Edit</a>
                <a href="/message/update/{{$message->id}}">Edit 2</a>

                <!-- Modal -->
                <div class="modal fade" id="modalEdit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Message</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="messagedata" method='post' action="abc">
                        <div class="modal-body">
                            <input type="text" id='etitle' name='etitle' value="">      
                            <input type="text" id='econtent' name='econtent' value=''>
                            {{csrf_field()}}

                            

                        
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" id="esubmit" >Save changes</button>
                            
                        </div>
                        </form>

                </div>
            </div> 
        </div>
                
    </li> 
        
        @endforeach

    </ul>

@endsection
@push('script')
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
<script>
$.ajaxSetup({
    headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
});

async=false;    

var nid;
console.log('aaaa');
function edits(id) {
    nid=id;
    $.ajax({
        type: 'GET', //THIS NEEDS TO BE GET
        url: 'message/edits/'+id,
        success: function (data) {
            console.log(data);
            $("#data").append(data);
            $('#econtent').val(data.data.content);
            $('#etitle').val(data.data.title);
        },
        error: function() { 
            console.log(data);
    }
     
    });
    $('#messagedata').attr("action", "/message/edit/"+id);


};


// function makechange() {
//         console.log(nid);

//     var content = $("#econtent").val();
//     var title = $("#etitle").val();

//      if(title != '' && content != ''){



//         $.post('/message/edit',{id:nid,title: title,content: content},function(data){
//             console.log(data);
//         });
//         //  fetch("message/edit", {
     
//         //     // Adding method type
//         //     method: "POST",
            
//         //     // Adding body or contents to send
//         //     body: JSON.stringify({
//         //         id:nid,
//         //         title: title,
//         //         content: content
//         //     }),
            
//         //     // Adding headers to the request
           
//         // })
//     };
// //     $.ajax({
// //       url: 'message/edit',
// //       type: "POST",
// //       data: {
// //         _token: CSRF_TOKEN,
// //         id:nid,
// //         title: title,
// //         content: content
// //       },
// //       success: function (data) {
// //           alert(data);
// //           $('#messagedata').trigger("reset");
// //           $('#modalEdit').modal('hide');
// //       },
// //       error:function(data){
// //           alert(data);
// //       }
// //   });
//      };



</script>
@endpush