$(document).ready(function(){
    //$(".delete-link-button").click(function()
    $("body").on('click','.delete-link-button',function()
    {
        var linkID = $(this).attr('id');
        $("#confirmDialog").modal('show');
        $("#deleteButton").click(function()
        {
            $.ajax({
                type: 'POST',
                data: {'linkid': linkID},
                url: 'http://test1/Link/DeleteLink',

                success: function (data) {
                    //alert("Delete link " + linkID);
                    window.location.href = 'http://test1/Link/PublicLinks/?page=0'
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
