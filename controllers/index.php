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
    return $this->request->response(200, ['message' => "GET Id-{$id} Nome-{$nome} Idade-{$time}"]);
  }

  public function welcome_get ($id,$nome,$idade) {
   #   $sample = new \Models\Sample();
   # $time =  $sample->getSomething();
   # $v = $this->config['version'];
   # return $this->request->response(200, ['message' => "GET Id-{$id} Nome-{$nome} Idade-{$time}"]);
  }


} // class
