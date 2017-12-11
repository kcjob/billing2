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
        // echo "inside if \r\n";
        // echo 'name: ' . $line[2] . "\r\n";
        // echo 'PI Number: ' . $line[1] . "\r\n";
        $billObject -> userName = $line[2];
        $billObject -> userEmail = $line[3];

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }
        // $count = 1;
        // echo "pass: " . $count . "\r\n";
        // $count++;

      } elseif (($line[2] == $billObject->userName) and is_numeric($line[1])){
        // echo "inside 1st elseif \r\n";
        // echo 'name: ' . $line[2] . "\r\n";
        // echo 'PI Number: ' . $line[1] . "\r\n";
        // echo "pass " . $count . "\r\n";
        // $count++;

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }

      } elseif (($line[2] != $billObject->userName) and is_numeric($line[1])){

        //var_dump($billObject);

        echo '***************************' . "\r\n";
        echo '*CONFIGURE AND SEND EMAIL *' . "\r\n";
        echo 'ß**************************' . "\r\n";

        EmailMessageGenerator::createEmail($billObject);

        // $count = 1;
        // echo "inside 2nd elseif \r\n";
        // echo "pass " . $count . "\r\n";
        // $count++;
        // echo 'name: ' . $line[2] . "\r\n";
        // echo 'PI Number: ' . $line[1] . "\r\n";

        $billObject = new billingDetails();
        $billObject -> userName = $line[2];
        $billObject -> userEmail = $line[3];

        array_push($billObject -> serviceInfoArray, ['service' => $billObject -> service = $line[5], 'startTime' => $billObject -> startTime = $line[6], 'endTime' => $billObject -> endTime = $line[7], 'serviceHours' => $billObject -> serviceHours = $line[8], 'notes' => $billObject -> notes = $line[9]]);

        if ($line[0]){
          array_push($billObject -> attachmentArray, $line[0]);
        }
      }
    } //while

    if (feof($fileHandle)){
      EmailMessageGenerator::createEmail($billObject);
      fclose($fileHandle);
    }
    //var_dump($billObject);
    //echo 'name: ' . $line[2] . "\r\n";
    //echo 'PI Number: ' . $line[1] . "\r\n";
  }
}
