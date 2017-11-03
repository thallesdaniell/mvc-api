<?php 

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit
 * -------------------------------------------------------- */

namespace Models;

defined('ENV') or die('O acesso direto ao script não é permitido!');

use Seed\Model;

class Sample extends Model {

  public function getSomething () {
    $this->db->connect();
    
    $res = $this->db->exec('select 1 as total');
    $res = array_shift($res);

    $this->db->disconnect();

    return $res['total'];
  } // getSomething;

} // class
