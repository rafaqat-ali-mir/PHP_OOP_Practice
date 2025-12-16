<?php


if(isset($_POST['user'])){
    // echo $_POST['user'];
    class User{
        function GetName($name){
            echo"User Name is " .$name;
        }
    }
    $user = new User();
    $user->GetName($_POST['user']);
}
else{

?>
<form action="" method="POST">
<input type="text" name="user" placeholder="Enter User Name">
<br/>
<br/>
<button>Click</button>
</form>

<?php

}
?>