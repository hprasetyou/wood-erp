<?php

/**
 *
 */
 function format_currency($val,$cur_code = 'USD'){
   $curr = CurrencyQuery::create()->findOneByCode($cur_code);
   $val = number_format($val, 2, ',', '.');
   return $curr->getPlacement()=='before'?$curr->getSymbol()." ".$val:$val." ".$curr->getSymbol();
 }
