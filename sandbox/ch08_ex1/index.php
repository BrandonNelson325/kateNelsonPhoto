<?php

$customer_type = $_POST['type'];
$invoice_subtotal = $_POST['subtotal'];

switch ($customer_type) {
    case 'R' || 'r':
        if ($invoice_subtotal < 100)
            $discount_percent = .0;
        else if ($invoice_subtotal >= 100 && $invoice_subtotal < 250)
            $discount_percent = .1;
        else if ($invoice_subtotal >= 250 && $invoice_subtotal <= 500)
            $discount_percent = .25;
        else {
            $discount_percent = .3;
        }
        break;
    case 'C' || 'c':
        if ($invoice_subtotal < 250)
            $discount_percent = .2;
        else {
            $discount_percent = .3;
    }
        break;
    case 'T' || 't':
        if ($invoice_subtotal < 500)
            $discount_percent = .4;
        else {
            $discount_percent = .5;
    }
    break;
    default: 
        $discount_percent = .1;
    break;
}

//if ($customer_type == 'R' || 'r') {
//    if ($invoice_subtotal < 100)
//        $discount_percent = .0;
//    else if ($invoice_subtotal >= 100 && $invoice_subtotal < 250)
//        $discount_percent = .1;
//    else if ($invoice_subtotal >= 250 && $invoice_subtotal <= 500)
//        $discount_percent = .25;
//    else {
//        $discount_percent = .30;
//    }
//} else if ($customer_type == 'C' || 'c') {
//    if ($invoice_subtotal < 250)
//        $discount_percent = .2;
//    else
//        $discount_percent = .3;
//} else if ($customer_type == 'T' || 't') {
//    if ($invoice_subtotal < 500)
//        $discount_percent = .40;
//    else {
//        $discount_percent = .50;
//    }
//}
//else {
//    $discount_percent = .1;
//}

$discount_amount = $invoice_subtotal * $discount_percent;
$invoice_total = $invoice_subtotal - $discount_amount;

$percent = number_format(($discount_percent * 100));
$discount = number_format($discount_amount, 2);
$total = number_format($invoice_total, 2);

include 'invoice_total.php';

?>