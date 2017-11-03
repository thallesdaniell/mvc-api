<?php

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit
 * -------------------------------------------------------- */

namespace Seed;

defined('ENV') or die('O acesso direto ao script não é permitido!');

class Nucleos {
  protected $config;
  protected $routes;

  function __construct () {
    if (!include('config/settings.php')) {
      die("Faltando o arquivo essencial: 'config / settings.php'. Abortado.");
    }
        $this->config = $config;
        unset($config);
    
    if (!include('config/routes.php')) {
      die("Faltando o arquivo essencial: 'config / routes.php'. Abortado.");
    }
        $this->routes = $routes;
        unset($routes);

  }

  public function getConfig () {
    return $this->config;
  }

  public function getVersion() {
    return $this->config['version'];
  }
  
    public function getRoutes() {
    return $this->routes;
  }
} // class 
