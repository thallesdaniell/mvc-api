<?php 

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit
 * -------------------------------------------------------- */

namespace Controllers;

defined('ENV') or die('O acesso direto ao script não é permitido!');

use Seed\Controller;

class Index extends Controller {

  function __construct () {
    parent::__construct();
  }

  public function index_get() {
    return $this->request->response(200, ['message' => "Controller Index, Método Index - MICRO FRAMEWORK API"]);
  }



} // class
