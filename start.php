<?php
require_once(__DIR__ .'/vendor/autoload.php');

use \Apps\BillingDetails;
use \Apps\AccessCSVData;
use \Apps\EmailMessageGenerator;
use \Apps\TemplateView;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

// create a log channel
$log = new Logger('bills');
$dbStream = new StreamHandler('data/billing.log', Logger::ERROR);
$log->pushHandler($dbStream);

try {
    $billObject = AccessCSVData::getCsvDataAsArray();
} catch (Exception $e) {
    $log->error($e->getMessage());
    echo "Problem retriving data from file\r\n";
    die();
}
