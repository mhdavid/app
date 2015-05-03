<?php namespace Jazz;

class Controller
{
  protected $basePath;

  function __construct()
  {
    $this->basePath = realpath(getcwd().'/../');
  }

  function thisIsAController()
  {
    echo 'Yes, this is.';
  }

  function view($view)
  {
    //TODO: Templating system (Twig?)
    $template = file_get_contents($this->basePath.'/app/Views/'.$view.'.php');
    return $template;
  }
}