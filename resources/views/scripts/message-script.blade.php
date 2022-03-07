<script>

    $('body').on('click', '#editmessage', function (event) {
    console.log("aaaaa");
    var id = $(this).attr("#data-id");
    alert(id);
    $.ajax({
        type: 'GET', //THIS NEEDS TO BE GET
        url: 'message/edits/'+id,
        success: function (data) {
            console.log(data);
            $("#data").append(data);
        },
        error: function() { 
            console.log(data);
    }
    });
    // $.get('/message/edits/'+id, function (data) {
    //      $('#userCrudModal').html("Edit category");
    //      $('#submit').val("Edit category");
    //      $('#practice_modal').modal('show');
    //      $('#econtent').val(data.data.content);
    //      $('#etitle').val(data.data.title);
    //  })
});
</script>