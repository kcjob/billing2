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
//var_dump($billObject);
//$arrayofbillObjects = BillObject::createBillObject($csvDataArray);
//$arrayOfMsgDataObjects = //MessageDataFromBillObject::getMessageData($arrayofbillObjects);
//EmailMessageGenerator::createEmail($arrayOfMsgDataObjects);





//echo $msg;
/*
$template = new TemplateView();
$template -> generateView($arrayOfMsgDataObjects);

 $loader = new Twig_Loader_Filesystem('Templates');
$twig = new Twig_Environment($loader, array('debug' => true));
$twig->addExtension(new Twig_Extension_Debug());
$template = $twig->load('messagebody.html.twig');

//----- split out each msg object
foreach($arrayOfMsgDataObjects as $msgDataObject){
//var_dump($dataObject->userName);
echo $template->render(array('dataObject'=>$msgDataObject));
}
*/
