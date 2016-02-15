<?php
//session_start();
if (!$_SESSION['is_auth'])
{
    echo "Access denied! Please sign in.";
    echo "</br>";
}
else
{
    echo "Hello, " . $_SESSION['userlogin'];
    echo "</br>";
    ?>

    <h1>Add new link</h1>

    <form method = post action = "AddLink">
        Header: <input type = text name = "linkheader" value = ""></br>
        Link: <input type = text name = "userlink" value = ""></br>
        Description: <textarea rows="10" cols="75" name="linkdescription" ></textarea></br>
                 <input type="hidden" name="linkflag" value="0" />
        Private: <input type = checkbox name = "linkflag" value = "1"></br>
        <input type = submit name = "loginbutton" value = "Enter!">
    </form>

<?php
}
?>


