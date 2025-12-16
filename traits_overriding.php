<?php

trait parentCompany1{
    function getTotalEmp(){
        echo 500;
    }
}
trait parentCompany2{
    function getTotalEmp(){
        echo 50;
    }

}
class Company{
    use parentCompany1;
    use parentCompany2{
        parentCompany1::getTotalEmp insteadof parentCompany2;
        // we can call both functions also
        parentCompany2::getTotalEmp as getEmpCompany2;
    }
}
$cmp=new Company();
$cmp->getTotalEmp();
echo "<br/>";
$cmp->getEmpCompany2();


?>