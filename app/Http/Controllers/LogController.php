<?php

namespace App\Http\Controllers;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class LogController extends Controller
{
    function logMessage($logText, $controllerName, $functionName, $logType)
    {
        $logger = new Logger('logger');
        switch ($logType) {
            case "ERROR":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::ERROR));
                $logger->error($controllerName." ".$logText." ".$functionName);
                break;
            case "INFO":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::INFO));
                $logger->info($controllerName." ".$logText." ".$functionName);
                break;
        }
        return;
    }
}
?>