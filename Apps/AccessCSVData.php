<?php
namespace Apps;
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
$count = 1;
    while($line = fgetcsv($fileHandle))
    {
      if ($line[2]){
        $userName = $line[2];
        if ($userName != $billObject->userName){
          $billObject -> userName = $line[2];
          $billObject -> userEmail = $line[3];
          //$billObject -> fileName = $line[0];
          //$billObject -> service = $line[5];
          //$billObject -> startTime = $line[6];
          //$billObject -> endTime = $line[7];
          //$billObject -> serviceHours = $line[8];
          //$billObject -> notes = $line[9];
          $billObject -> serviceInfoArray = ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]];

          $billObject -> attachmentArray = [$line[0]];
          echo 'count inside if: '. $count . ' ' . $line[2]. "\r\n";
          //var_dump($billObject);
          $count++;
        } else {
          if ($line[0]){
            array_push($billObject -> attachmentArray, $line[0]);
          }
            array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8],'notes' => $billObject -> notes = $line[9]]);
            //var_dump($billObject);
            echo 'count inside else: '. $count . ' ' . $line[2]. "\r\n";
            $count++;
        }
      }
    }
    //var_dump($billObject);
    fclose($fileHandle);
  }
}
