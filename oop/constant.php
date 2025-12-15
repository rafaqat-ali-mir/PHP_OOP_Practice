<?php
class ConstantDemo{
    const collegeName = "GMS College";
    function getcollege(){
        echo self::collegeName;
    }
}
// direct calling funation from class
// echo ConstantDemo::collegeName;

$c1 = new ConstantDemo();
$c1->getcollege();
?>