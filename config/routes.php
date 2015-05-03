<?php

return [
  '/' => [
    'method' => 'GET',
    'target' => 'WelcomeController@index'
  ],

  '/ada' => [
    'method' => 'GET',
    'target' => 'WelcomeController@ada'
  ],

  //TODO: Improve the syntax
  '/{controller}/{action}' => [
    'method' => 'GET',
    'target' => '{controller}@{action}'
  ]
];