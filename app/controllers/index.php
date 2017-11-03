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


class Index extends Controller {

  function __construct () {
    parent::__construct();
  }

  public function index_get($id) {
    return Router::response(200, ['message' => "Controller Index, Método Index - MICRO FRAMEWORK API {$id}"]);
  }



} // class
