<?php 

function formatMoney($money)
{

    return 'R$ '. number_format($money,2,',','.');
}