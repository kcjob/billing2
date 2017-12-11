<?php
namespace Apps;
/**
*  Bill information object
*
*/
class billingDetails{
  public $userName;
  public $userEmail;
  public $fileName;
  public $service;
  public $startTime;
  public $endTime;
  public $serviceHours;
  public $notes;

  public function __construct($userDataArray)
  {
    $this -> userName = $userDataArray[2];
    $this -> userEmail = $userDataArray[3];
    $this -> fileName = $userDataArray[0];
    $this -> service = $userDataArray[5];
    $this -> startTime = $userDataArray[6];
    $this -> endTime = $userDataArray[7];
    $this -> serviceHours = $userDataArray[8];
    $this -> notes = $userDataArray[9];
  }
}
