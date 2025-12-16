<?php
    class MathOperations{
        // public $val=30;
        function sum($a,$b){
            echo $a+$b;
        }
    }
    $math= new MathOperations();
    $math->sum(45,10);echo"<br/>";
    $math1=new MathOperations();
    $math1->sum(10,10);
?>