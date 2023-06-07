<?php

function dk_date_format($date)
{
    $pieces = explode(" ", $date);
    $dage = explode("-", $pieces[0]);
    $newformat = $dage[2] . "/" . $dage[1] . "-" . substr($dage[0], 2);
    return $newformat;
}

function api_payment_data($order_id)
{
    $payment_statement = fetch_assoc("SELECT payment_type, status FROM shup_orders WHERE id = ? ", [$order_id]);

    $payment_status = $payment_statement['status'];

    $payment_type = $payment_statement['payment_type'];
    $payment = [];
    $payment['payment_type'] = $payment_type;
    $payment['icon'] = "";
    switch ($payment_type) {
        case api_str_contains($payment_type, "mobilepay"):
            $payment["payment_type"] = "MobilePay";
            $payment["icon"] = "https://shup.dk/shop/images/logo_mobilepay.png";
            break;
        case api_str_contains($payment_type, "mastercard"):
            $payment["payment_type"] = "Mastercard";
            $payment["icon"] = "https://shup.dk/shop/images/logo_master.png";
            break;
        case api_str_contains($payment_type, "visa");
            $payment["payment_type"] = "Visa";
            $payment["icon"] = "https://shup.dk/shop/images/logo_visa.png";
            break;
        case api_str_contains($payment_type, "dankort"):
            $payment["payment_type"] = "Dankort";
            $payment["icon"] = "https://shup.dk/shop/images/logo_dankort.png";
            break;
        case api_str_contains($payment_type, "Stripe abonnement"):
            $payment["payment_type"] = "Abonnement";
            $payment["icon"] = "https://shup.dk/shop/images/logo_dankort.png";
            break;
    }

    if ($payment_status == 0 && $payment_type != "Ikke betalt") {
        $payment["notice"] = "Husk at hæve pengene i";
        $payment["provider"] = "Quickpay";
        $payment["link"] = "https://manage.quickpay.net/";
    } else
        $payment["notice"] = "";
    $payment["payment_status"] = $payment_status;

    return $payment;
}

function api_str_contains($haystack, $needle)
{
    return $needle !== '' && mb_strpos($haystack, $needle) !== false;
}