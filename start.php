<<?php
require_once(__DIR__ .'/vendor/autoload.php');

use \Apps\BillingDetails;
use \Apps\AccessCSVData;
use \Apps\BillObject;
use \Apps\MessageDataFromBillObject;
use \Apps\EmailMessageGenerator;
use \Apps\TemplateView;
use \Apps\EmailDetails;

use Monolog\Logger;
use Monolog\Handler\StreamHandler;

$billObject = AccessCSVData::getCsvDataAsArray();
