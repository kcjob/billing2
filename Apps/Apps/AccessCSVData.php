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

    $file = fopen($csvFile,"r");
    while(!feof($file))
    {
      $csvDataArray[] = fgetcsv($file);
    }
    fclose($file);
    unset( $csvDataArray[0] ); // unset 1st element
    unset( $csvDataArray[1] ); // unset 1st element
    return $csvDataArray;
  }
}
