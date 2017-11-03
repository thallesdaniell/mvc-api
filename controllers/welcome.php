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

class Welcome extends Controller {

  function __construct () {
    parent::__construct();
  }

  public function index_get () {
       return $this->request->response(200, ['message' => "GET Id-{$id} Nome-{$nome} Idade-{$idade}"]);
  }

  public function welcome_get () {
    return $this->request->response(200, ['message' => "Controller Welcome Método Welcome"]);
  }


} // class
