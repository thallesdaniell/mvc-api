<?php

// define the api timezone 
date_default_timezone_set('America/Recife');

// is the system been updated?
if (file_exists('.update.lock'))
{
    echo json_encode(['status' => 503, 'message' => 'Serviço temporariamente indisponível. Atualização em andamento.']);
    exit;
}

// let's define the environment 
// it can be whatever you want. usually will be either 'development' or 'production'
if (!defined('ENV'))
{
    define('ENV', getenv('ENV') !== false ? getenv('ENV') : 'development');
}

if (defined('ENV'))
{

    switch (ENV) {
        case 'development':
            error_reporting(E_ALL & ~E_NOTICE);
            break;

        case 'testing':
        case 'production':
            error_reporting(0);
            break;

        default:
            exit('O ambiente do aplicativo não está configurado corretamente.');
    }
}

// import loader ...  
#if (!require_once('seed/loader.php'))
#{
#    die("Loader não encontrado! Abortado.");
#}