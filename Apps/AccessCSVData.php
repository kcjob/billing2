<?php
namespace Apps;
use Apps\EmailMessageData;
/**
* Read CSV data file
* Create data array object
*/
class AccessCSVData {
  static function getCsvDataAsArray(){
    $csvData = array();
    $fileName = parse_ini_file("config/config.ini");
    $csvFile = $fileName['csvFile'];

    $fileHandle = fopen($csvFile,"r");
    $emailArray = [];
    $billObject = new billingDetails();

    while($line = fgetcsv($fileHandle))
    {
      if (is_numeric($line[1]) and !$billObject->userName){
        $billObject -> userName = $line[2];
        $billObject -> userEmail = $line[3];
        $billObject -> month = date('F');

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }
      } elseif (($line[2] == $billObject->userName) and is_numeric($line[1])){

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }

      } elseif (($line[2] != $billObject->userName) and is_numeric($line[1])){

        //echo '***************************' . "\r\n";
        //echo '*CONFIGURE AND SEND EMAIL *' . "\r\n";
        //echo 'ß**************************' . "\r\n";

     try {
        EmailMessageGenerator::createEmail($billObject);
      } catch (Exception $e) {
        $log->error($e->getMessage());
        echo "Problem retriving data from file\r\n";
        die();
      }      

        $billObject = new billingDetails();
        $billObject -> userName = $line[2];
        $billObject -> userEmail = $line[3];
        $billObject -> month = date('F');

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }
      }
    } //while

    try {
      if (feof($fileHandle)){
        EmailMessageGenerator::createEmail($billObject);
        fclose($fileHandle);
      }
    } catch (Exception $e) {
        $log->error($e->getMessage());
        echo "Problem retriving data from file\r\n";
        die();
    }
  }
}
