<?php 

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit
 |
 | Special routes that are gonna be used by Seed PHP to 
 | load the right controller and method according to given URI.
 |
 | e.g:
 | $routes['your/special/route'] = 'existing/route';
 | $routes['(regular|expression)/is/allowed'] = 'existing/route/$1';
 * -------------------------------------------------------- */

$routes = []; // PLEASE DO NOT REMOVE THIS LINE 

$routes['welcome'] = 'index/welcome/$1/$2/$3';
$routes['apelido'] = 'index/index/$1/$2/$3';
