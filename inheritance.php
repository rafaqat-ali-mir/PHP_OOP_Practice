<?php
class USER{
       function login($usertype){
        echo" $usertype logged in";
    }
}
class Student extends USER{
    function GetName(){
        echo "Ali";
    }
}
class teacher extends USER{
     function Getskill(){
        echo "PHP_OOP";
    }
}
$s1 = new Student();
$s1->login("student");
echo"<br/>";
$s1->GetName();
echo"<br/>";
$t1= new Teacher();
$t1->login("teacher");
echo"<br/>";
$t1->Getskill();
?>