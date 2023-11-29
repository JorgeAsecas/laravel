<?php

use App\Generico\Carrito;

function dinero($s)
{
    return number_format($s, 2, ',', ' ') . ' €';
}

function truncar($s, $long = 20)
{
    if (mb_strlen($s) > $long) {
        return mb_substr($s, 0, $long) . '...';
    }

    return $s;
}
function order_dir_arrow($order, $order_dir)
{
    return $order == false ? '' : ($order_dir == 'desc' ? '↑' : '↓');
}

function order_dir($order, $order_dir)
{
    return $order == false ? 'asc' : ($order_dir == 'asc' ? 'desc' : 'asc');
}
function carrito()
{
    if (session()->missing('carrito')) {
        session()->put('carrito', new \App\Generico\Carrito());
    }

    return session('carrito');
}
