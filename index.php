<?php
$precio1 = 5;
$producto1 = 5;

$precio2 = 10;
$producto2 = 3;

$precio3 = 4;
$producto3 = 2;

$impuesto = 0.18;
$descuento = 0.05;

$subtotal = ($precio1 * $producto1) + ($precio2 * $producto2) + ($precio3 * $producto3);

$impuestofinal = $subtotal * $impuesto;

$descuentofinal = $subtotal * $descuento;

$total = $subtotal + $impuestofinal - $descuentofinal;

echo "Subtotal: $" . number_format($subtotal, 2) . "<br/>";
echo "Impuesto: $" . number_format($impuestofinal, 2) . "<br/>";
echo "Descuento: $" . number_format($descuentofinal, 2) . "<br/>";
echo "Total: $" . number_format($total, 2) . "<br/>";
?>