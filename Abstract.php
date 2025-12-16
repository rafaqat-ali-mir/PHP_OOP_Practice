<?php
abstract class ProductFeature {
    public $country="japan";
   
    abstract function productdetails();
    abstract function productImages();
    abstract function productOwnerdetails();
}

class UploadProduct extends ProductFeature {

    function productdetails() {
         echo "Country:" .$this->country; echo"</br>";
        echo "Product Details<br>";
         
    }

    function productImages() {
        echo "Product Images<br>";
    }

    function productOwnerdetails() {
        echo "Product Owner Details<br>";
    }
}


$obj = new UploadProduct();
// $obj->country;
$obj->productdetails();
$obj->productImages();
$obj->productOwnerdetails();
?>
