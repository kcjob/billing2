<?php
namespace Apps;
/**
*  Bill information object
*
*/
class billingDetails {

  //public $emailMsgArray = [];
  public $serviceInfoArray = [];
  public $attachmentArray = [];
  public $userName;
  public $userEmail;
  public $fileName;
  public $service;
  public $startTime;
  public $endTime;
  public $serviceHours;
  public $notes;
  public $month;

  public function __construct() {

  }

}
