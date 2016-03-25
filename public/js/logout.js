$(document).ready(function(){
    $("#logout").click(function()
    {
        //alert( "Logout" );
        $.ajax({
            type: 'POST',
            url: 'http://test1/User/Logout',
            success: function(data) {
                alert("Success logout");
                window.location.href = 'http://test1/User/Login'
            },
            error: function(xhr, desc, err) {
                console.log(xhr);
                console.log("Details: " + desc + "\nError:" + err);
            }
        }); // end ajax call
    });
});


//function ololo()
//{
//    alert ("sdfasf");
//}


//function logoutUser()
//{
//    alert("adsfsadfsg");
//
//    //var button = document.getElementById("logout");
//    //alert("olol");
//    //
//    //var func = function () {
//    //    alert("Logout!!");
//    //}
//    //button.addEventListener("click", func, false);
//
//
//}
