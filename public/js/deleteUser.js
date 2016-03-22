$(document).ready(function(){
    $(".delete-user-button").click(function()
    {
        //alert( "Logout" );
        var userID = $(this).attr('id');
        $("#confirmDialog").modal('show');
        $("#deleteButton").click(function()
        {
            $.ajax({
                type: 'POST',
                data: {'userid': userID},
                url: 'http://test1/User/DeleteUser',

                success: function (data) {
                    //alert("Delete link " + linkID);
                    window.location.href = 'http://test1/User/AllUsers/?page=0'
                },
                error: function (xhr, desc, err) {
                    console.log(xhr);
                    console.log("Details: " + desc + "\nError:" + err);
                }
            }); // end ajax call
            $("#confirmDialog").modal('hide');
        });
    });
});