<?php

function dd($var) {

  if(is_array($var)) {
    echo '<pre>';
    print_r($var);
    echo '</pre>';
  }
  else
    echo $var;

  die();
}