<?php
abstract class ProductFeature {
    abstract function productdetails();
    abstract function productImages();
    abstract function productOwnerdetails();
}

class UploadProduct extends ProductFeature {

    function productdetails() {
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
$obj->productdetails();
$obj->productImages();
$obj->productOwnerdetails();
?>
