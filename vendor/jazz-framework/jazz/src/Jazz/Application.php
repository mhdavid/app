<?php namespace Jazz;

use Whoops\Run;
use Jazz\Container\Container;
use Exception as BaseException;
use Whoops\Handler\PrettyPageHandler;

use Jazz\Router;
use Jazz\Config;

class Application
{

  /**
   * The base path of the application.
   *
   * @var string
   */
  protected $basePath;

  /**
   * The path to the environment file
   *
   * @var string
   */
  protected $environmentFile;

  /**
   * All of the variables from the .env file.
   *
   * @var array
   */
  protected $environmentVariables = [];

  protected $router;
  protected $config;

  /**
   * Create a new Jazz application.
   *
   * @param  string|null  $basePath
   * @return void
   */
  public function __construct()
  {
    $this->basePath = realpath(getcwd().'/../');

    $this->config = new Config($this->basePath);
    $this->router = new Router();

    /*
    $this->container = new Container();
    $this->container['config'] = array_merge(static::loadConfiguration(), $appConfig);
    $this->container['environment'] = $this->getEnvironmentVariables();
    $this->container['request']
    $this->container['response']
    $this->container['router']
    $this->container['view']
    $this->container['']

    $this->configureApplication();
    $this->environmentFile = $this->basePath.'/.env';
    $this->setErrorHandling();
    $this->setEnvironmentVariables();
    print_r($this->environmentVariables);
    */
  }

  public function configure()
  {
    $Config = $this->config;
    $this->router->configure($Config->get('routes'));
  }

  public function run()
  {
    //TODO: Refactor
    $request = $this->router->parse();
    $str = "\App\Controllers\\".$request['controller'];
    $target = new $str;
    $response = call_user_func_array(array($target, $request['action']), array());
    echo $response;
  }

  /**
   * Set the error handling.
   *
   * @return void
   */
  protected function setErrorHandling()
  {
    error_reporting(-1);
    $errorHandler = new \Whoops\Run;
    $errorHandler->pushHandler(new \Whoops\Handler\PrettyPageHandler);
    $errorHandler->register();
  }

  /**
   * Set the environment variables with the data from the .env file.
   * The format is $key=$value
   *
   * @return void
   */
  public function setEnvironmentVariables()
  {
    $environmentFilePath = $this->basePath.'/.env';
    if (!file_exists($environmentFilePath))
    {
      return;
    }

    $file = new \SplFileObject($environmentFilePath);
    while(!$file->eof())
    {
      $line = str_replace(' ', '', trim($file->fgets()));
      if($line != "")
      {
        list($key, $value) = explode('=', $line);
        $this->environmentVariables[$key] = $value;
      }
    }
  }
}