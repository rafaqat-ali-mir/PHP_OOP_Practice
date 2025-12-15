<?php
class teacher {
    public $city = "RWP";

    function nextexam(){
        echo "next exam is math";
    }

    function age(){
        echo "my age is 20";
    }
}

class student extends teacher {
    public $city = "ISB";  

    function age(){         
        echo "my age is 20";
    }
}

$st1 = new student();
$st1->age();
echo "<br/>";
echo $st1->city;
?>
