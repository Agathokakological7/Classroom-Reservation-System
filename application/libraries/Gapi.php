<?php
session_start();
require_once 'vendor/autoload.php';
class Gapi  {

 
function readSheet($sheetid,$rg)
{
  	
  	
$client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;
$response = $service->spreadsheets_values->get($spreadsheetId, $range);
$values = $response->getValues();
if (empty($values)) {
   print 'No data found.<br>  ';
   return NULL;
} else {

  return $values;
  
}
 }

 function writeData_retirementReport($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);

echo "Thank you jesus";

 }

 function writeData_gsect_report($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21],$val[22],$val[23],$val[24],$val[25],$val[26],$val[27],$val[28],$val[29],$val[30],$val[31],$val[32],$val[33],$val[34],$val[35],$val[36],$val[37],$val[38],$val[39],$val[40],$val[41],$val[42],$val[43],$val[44],$val[45],$val[46]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);

echo "Thank you jesus";

 }



 function writeData_NewMissionary_centralsheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21],$val[22],$val[23],$val[24],$val[25],$val[26],$val[27],$val[28],$val[29],$val[30],$val[31],$val[32],$val[33],$val[34],$val[35],$val[36],$val[37],$val[38],$val[39],$val[40],$val[41],$val[42],$val[43],$val[44],$val[45],$val[46],$val[47],$val[48],$val[49],$val[50],$val[51],$val[52],$val[53],$val[54]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Thank you jesus";

 }
  function writeData_NewMissionary_inmissionarysheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;
$range = $rg;
$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21],$val[22],$val[23],$val[24],$val[25],$val[26],$val[27],$val[28],$val[29],$val[30],$val[31],$val[32],$val[33],$val[34],$val[35],$val[36],$val[37],$val[38],$val[39],$val[40],$val[41],$val[42],$val[43],$val[44],$val[45],$val[46],$val[47],$val[48],$val[49],$val[50],$val[51],$val[52],$val[53]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Updated in MP sheet";

 }
  function writeData_MSupport_centralsheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;
$range = $rg;
$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Updated in MP sheet";

 }
  function writeData_MSupport_inmissionarysheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;
$range = $rg;
$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Updated in MP sheet";

 }

 function writeData_finance_export($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);

echo "Thank you jesus";

 }

 function writeNCMMsupport_centralsheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;
$range = $rg;
$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21],$val[22]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
//echo "Updated in NCM M support in Central sheet";

 }

 function writeGSECT_finance_export($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21],$val[22],$val[23],$val[24]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);

//echo "Thank you jesus";

 }

  function writeData_missionary_stats_sheet($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Thank you jesus";

 }
function writeData_reportCatcher($sheetid,$rg,$val)
{
  //echo "Hi jesus";exit;
  
  $client = new \Google_Client();
$client->setApplicationName('jeeva');
$client->setScopes([\Google_Service_Sheets::SPREADSHEETS]);
$client->setAccessType('offline');
$client->setAuthConfig(__DIR__ . '/testapi-277617-9864140e6b89.json');
$service = new Google_Service_Sheets($client);
$spreadsheetId =$sheetid;

$range = $rg;

//print_r($val);exit;

$valueRange= new Google_Service_Sheets_ValueRange();
$valueRange->setValues(["values" => [$val[0],$val[1],$val[2],$val[3],$val[4],$val[5],$val[6],$val[7],$val[8],$val[9],$val[10],$val[11],$val[12],$val[13],$val[14],$val[15],$val[16],$val[17],$val[18],$val[19],$val[20],$val[21]]]); 
$conf = ["valueInputOption" => "RAW"];
$ins = ["insertDataOption" => "INSERT_ROWS"];
$service->spreadsheets_values->append($spreadsheetId, $range, $valueRange, $conf, $ins);
echo "Thank you jesus";

 }


}

?>