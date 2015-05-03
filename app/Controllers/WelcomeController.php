<?php namespace App\Controllers;

use App\Models\Mock;
use Jazz\Controller as BaseController;

class WelcomeController extends BaseController
{
  function index()
  {
    $data = Mock::getUsersOnline();
    return $this->view('Welcome/Index');
  }
}