<?php namespace Jazz;

class Config
{
  protected $basePath;
  function __construct($basePath)
  {
    $this->basePath = $basePath;
  }

  function get($fileName)
  {
    $filePath = $this->basePath.'/config/'.$fileName.'.php';

    if (!file_exists($filePath)) {
      throw new \Exception("The requested config file doesn't exists.");
    }

    return require $filePath;
  }
}