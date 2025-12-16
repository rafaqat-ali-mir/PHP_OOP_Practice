<?php

trait parentCompany1{
    function getTotalEmp(){
        echo 500;
    }
    function getTotalProject(){
        echo 10;
}
}
trait parentCompany2{
    function getTotalClients(){
        echo 50;
    }
    function getTotalOffices(){
        echo 05;
}
}
class Company{
    use parentCompany1;
    use parentCompany2;
}
$cmp=new Company();
$cmp->getTotalEmp();
echo "<br/>";
$cmp->getTotalProject();
echo "<br/>";
$cmp->getTotalClients();
echo "<br/>";
$cmp->getTotalOffices();

?>