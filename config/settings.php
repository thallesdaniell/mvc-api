<?php 

 /* --------------------------------------------------------
 | PHP API KIT
 | @author Rogerio Taques (rogerio.taques@gmail.com)
 | @version 0.1
 | @license MIT
 | @see http://github.com/rogeriotaques/php-api-kit
 * -------------------------------------------------------- */

defined('ENV') or die('O acesso direto ao script não é permitido!');

$config = []; // DO NOT REMOVE THIS LINE 
/* --------------------------------------------------------
 | Version  
 * -------------------------------------------------------- */
$config['version'] = '1.0.2';
/* --------------------------------------------------------
 | Current server address  
 * -------------------------------------------------------- */
$config['base-url'] = [
  'production'  => "{$_SERVER['HTTP_HOST']}/",
  'development' => "localhost/"
];

/* --------------------------------------------------------
 | Allowed methods  
 * -------------------------------------------------------- */
$config['cors'] = true;
#$config['methods'] = [ 'get', 'post', 'put', 'delete', 'options', 'patch' ];
$config['methods'] = [ 'get', 'post', 'put'];

/* --------------------------------------------------------
 | Allowed headers keys 
 * -------------------------------------------------------- */
$config['headers'] = [ 'Origin', 'Content-Type', 'X-Auth-Token' , 'Authorization', 'X-Requested-With' ];

/* --------------------------------------------------------
 | Cache control  
 * -------------------------------------------------------- */
$config['cache'] = true;
$config['cache-max-age'] = 0;#3600;

/* --------------------------------------------------------
 | Database
 * -------------------------------------------------------- */
$config['database'] = [
  'development' => [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'pass' => '',
    'base' => 'php-api-kit',
    'charset' => 'utf8'
  ],
  'production' => [
    'host' => 'localhost',
    'port' => '3306',
    'user' => 'root',
    'pass' => '',
    'base' => 'php-api-kit',
    'charset' => 'utf8'
  ]
];

/* --------------------------------------------------------
 | Usage log 
 * -------------------------------------------------------- */
$config['log'] = true;

/* --------------------------------------------------------
 | Other 
 * -------------------------------------------------------- */
$config['language'] = 'pt-br';
$config['charset'] = 'utf8';
