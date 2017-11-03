<?php 

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit 
 * -------------------------------------------------------- */

namespace App\Controllers;
use Seed\Controller;
use Seed\Router;

defined('ENV') or die('O acesso direto ao script não é permitido!');


class Welcome extends Controller {

  function __construct () {
    parent::__construct();
  }

  public function index_get () {
       return Router::response(200, ['message' => "welcomet index"]);
  }

  public function teste_get () {
    return Router::response(200, ['message' => "Controller Welcome Método Welcome"]);
  }


} // class
