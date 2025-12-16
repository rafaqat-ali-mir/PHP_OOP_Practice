<?php
class Company{
    function getName(){
    echo"This is Honda Motors . ";
    return $this;
    }
    function getEmployes(){
    echo"Honda has 3000 Employees . ";
    return $this;
    }
    function getOffices(){
    echo"Honda has 30 Offices.";
  
    }
}
$company = new Company();
$company->getName()-> getEmployes()->getOffices();
?>