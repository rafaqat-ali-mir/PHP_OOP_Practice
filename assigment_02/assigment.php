<?php

function addOrder($orders, $dish, $qty) {
    if (isset($orders[$dish])) {
        $orders[$dish] += $qty;
    } else {
        $orders[$dish] = $qty;
    }
    return $orders;
}

function calculateTotal($orders, $priceList) {
    $total = 0;
    foreach ($orders as $dish => $qty) {
        $total += $qty * $priceList[$dish];
    }
    return $total;
}

function getMostOrderedDish($orders) {
    return array_search(max($orders), $orders);
}

$orders = [];
$orders = addOrder($orders, "Pasta", 2);
$orders = addOrder($orders, "Salad", 1);
$orders = addOrder($orders, "Pasta", 3);

$priceList = [
    "Pasta" => 10,
    "Salad" => 6
];

$total = calculateTotal($orders, $priceList);
$mostOrdered = getMostOrderedDish($orders);

echo "Total Bill: $total<br>";
echo "Most Ordered Dish: $mostOrdered";