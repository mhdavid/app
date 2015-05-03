<?php namespace Jazz;

class Router
{
  protected $requestedResource;
  protected $requestedMethod;
  protected $baseUrl;
  protected $routes = [];

  function __construct()
  {
    $this->baseUrl = 'http://jazz.dev'; //TODO: Get config config/app.php
    $this->requestedResource = $_SERVER['REQUEST_URI'];
    $this->requestedMethod = $_SERVER['REQUEST_METHOD'];
  }

  public function configure($routes = array())
  {
    foreach($routes as $key => $value)
    {
      $this->routes[strtolower($value['method'])][$key] = $value['target'];
    }
  }

  function parse()
  {
    $this->redirectIfHasTrailingSlash();
    $requestedMethod = strtolower($this->requestedMethod);
    if (isset($this->routes[$requestedMethod][$this->requestedResource]))
    {
      return $this->parseRouteString($this->routes[$requestedMethod][$this->requestedResource]);
    }
    else
    {
      throw new \Exception("No route found for the requested resource.");
    }
  }

  public function parseRouteString($routeString)
  {
    //TODO: Refactor
    $parts = explode('@', $routeString);
    if (count($parts) !== 2) {
      throw new \Exception("The route string '$routeString' is invalid formatted.");
    }

    return [
      'controller' => $parts[0],
      'action' => $parts[1]
    ];

  }

  function redirectIfHasTrailingSlash()
  {
    //TODO: Refactor
    $urlParts = explode('/', $this->requestedResource);
    if(empty(array_pop($urlParts)) && count($urlParts) != 1) {
      header('Location: '.$this->baseUrl.substr($this->requestedResource, 0, -1));
    }
  }
}