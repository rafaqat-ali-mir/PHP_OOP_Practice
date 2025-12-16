<?php
class Properties_in_OOP{
    //Public 
    //Private
    //protected
    public $name="ali";
    function getName(){
        echo $this->name;
    }
    function updateName($names){
        $this->name=$names;
        // echo $this->name;
    }
}
$p1 = new Properties_in_OOP();
$p1->updateName("ahmad");
$p1->getName ();

// echo $p1->name; 
?>