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

use Seed\Nucleos;
use Seed\Router;

class Controller extends Nucleos {
  protected $request;

  function __construct () {
    parent::__construct();
    $this->request = new Router();
    $this->auth();
  }
  
  private function auth(){
    if(1==1){
       # $this->request->response(401);
       # die();
    }
  }

} // class
