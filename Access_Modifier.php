<?php
class teachers{
    Private  function questionPaper(){
        echo"Question Paper for Student";
    }
    function exam(){
        $this->questionPaper();
    }
}
$t1 = new teachers();
// $t1->questionPaper ();
$t1->exam();
?>