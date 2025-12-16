<?php

interface ProductFeature {
    public function productDetails(): void;
    public function productImages(): void;
    public function productOwnerDetails(): void;
}

class UploadProduct implements ProductFeature {

    public function productDetails(): void {
        echo "Product Details<br>";
    }

    public function productImages(): void {
        echo "Product Images<br>";
    }

    public function productOwnerDetails(): void {
        echo "Product Owner Details<br>";
    }
}

$obj = new UploadProduct();
$obj->productDetails();
$obj->productImages();
$obj->productOwnerDetails();

?>
