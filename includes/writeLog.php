<?php
require(__DIR__.'/../vendor/autoload.php');
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

class writeLog
{
    public function __construct() {

    }
    public function writeLog($logText, $controllerName, $fileName, $logType)
    {
        $this->writeToLog($logText, $controllerName, $fileName, $logType);
        return;
    }

    private function writeToLog($logText, $controllerName, $fileName, $logType) {
        $logger = new Logger('logger');
        switch ($logType) {
            case "WARNING":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::WARNING));
                $logger->warning($controllerName." ".$logText." ".$fileName);
                break;
            case "ERROR":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::ERROR));
                $logger->error($controllerName." ".$logText." ".$fileName);
                break;
            case "INFO":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::INFO));
                $logger->info($controllerName." ".$logText." ".$fileName);
                break;
            case "DEBUG":
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::DEBUG));
                $logger->debug($controllerName." ".$logText." ".$fileName);
                break;
            default:
                $logger->pushHandler(new StreamHandler(__DIR__ .'logger.log', Logger::INFO));
                $logger->info($controllerName." ".$logText." ".$fileName);
                break;
        }
        return;
    }
}
?>