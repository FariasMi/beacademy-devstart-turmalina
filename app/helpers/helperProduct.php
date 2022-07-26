<?php 

function formatMoney($money)
{
    $clean_money = str_replace('','',$money);

    return 'R$ '. number_format($clean_money,2,',','.');
}