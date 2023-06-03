												
<?php
    if (isset($_GET['ref'])) 
    {
	}else{
	header('Location: index-new.php');
	}        
//Argument from runDHLClient.cmd
//Input for dhlclient path 
$arg0 = "";
//Input for directory path
$arg1 = "request/";
//Input path for Request XML files
$arg2 = "req.xml";
//Input path for Response XML Files
$arg3 = "../response/";
//Input path for Server url details
$arg4 = "https://xmlpi-ea.dhl.com/XMLShippingServlet";
//%FUTURE_DAY% 
$arg5 = false;
//%TIMEZONE%
$arg6 = 5;



$myxml = "<?xml version='1.0' encoding='UTF-8'?>" .
"<req:UnknownTrackingRequest xmlns:req='http://www.dhl.com' xmlns:xsi='http://www.w3.org/2001/XMLSchema-instance' xsi:schemaLocation='http://www.dhl.com TrackingRequestKnown.xsd' schemaVersion='1.0'>" .
"<Request>" .
"<ServiceHeader>" .
"<MessageTime>" . date("Y-m-d") . "T12:40:56-08:00</MessageTime>" .
"<MessageReference>2312454SyedAutonetics8756497</MessageReference>" .
"<SiteID>v62_A2RmGNU2aJ</SiteID>" .
"<Password>iljatp6cXw</Password>" .
"</ServiceHeader>" .
"</Request>" .
"<LanguageCode>en</LanguageCode>" .
"<AccountNumber>359058774</AccountNumber>" .
"<ShipperReference>" .
"<ReferenceID>" . $_GET['ref'] . "</ReferenceID>" .
"</ShipperReference>" .
"<ShipmentDate>" .
"<ShipmentDateFrom>" . date('Y-m-d',(strtotime ( '-120 day' , strtotime ( date("Y-m-d")) ) )) . "</ShipmentDateFrom>" .
"<ShipmentDateTo>" . date("Y-m-d") . "</ShipmentDateTo>" .
"</ShipmentDate>" .
"</req:UnknownTrackingRequest>";

//FILE PATH
$dir_url = $arg1;
//REQUEST PATH & REQUEST FILE
$filename = $arg1.$arg2;
//RESPONSE PATH 
$response_url = $arg1.$arg3;
//SERVER URL
$server_url = $arg4;
//Future Date
$futureDate = $arg5;

//Starting the StopWatch
//=StopWatch::start();

//IP ADDRESS
//=$localIPAddress = getHostByName(getHostName());

//Set Cookie to store Client's IP address
//=$_COOKIE['info[0]'] = $localIPAddress;

//Set Cookie to store filename that is being executed
//=$_COOKIE['info[1]'] = $arg0;

//Setting timezone to UTC
date_default_timezone_set("UTC");
$utc = $arg6;
$utc_parsed_1 = str_replace(":",".",$utc);
$utc_parsed_2 = str_replace(".30",".50",$utc_parsed_1);
$utc_parsed_2 = str_replace(".45",".75",$utc_parsed_1);
$ts = (time() + ($utc_parsed_2*3600));
$dtformat = "Y_m_d_H_i_s_";

//Set Cookie for timestamp after timezone is applied
//=$_COOKIE['info[2]'] = $ts;

$count = 0;

goto A;
echo "<BR>";

A: 

//Getting the .xml file.
//=$file = file_get_contents($filename, true);
//=$len = strlen($file);
$len = strlen($myxml);

//=echo  "futureDate set to :: ".$futureDate."<BR>";

//=echo "TimeZone set to :: UTC".$arg6."<BR>";

//UTF-8 checking for .xml file.
//==$encoding = mb_detect_encoding($file, 'UTF-8');
$encoding = mb_detect_encoding($myxml, 'UTF-8');
if ($encoding == "UTF-8") {
	$new_server_url = $server_url.'?isUTF8Support=true';


	$reqxml= $myxml;
//=	$reqxml= $file;

	$el_start = "<MessageReference>";
	$el_end = "</MessageReference>";
	$MessageReference = getBetween($reqxml,$el_start,$el_end);
} else {
	$new_server_url = $server_url;
	$MessageReference = "";
}

//=echo "Opening the connection ..... : ".$server_url."<BR><BR>";
//echo "Connecting to Server IP: ".$localIPAddress." URL:".$new_server_url."<BR><BR>";

//Check whether url exist.
$invalidurl = "";
$file_headers = @get_headers($new_server_url);
if(!$file_headers || $file_headers[0] == 'HTTP/1.1 404 Not Found') {
	$invalidurl = true;
	$flushDNS = true;
	$retry = true;
} else {
	$flushDNS = false;
	$retry = false;
}

if ($invalidurl == true) {
}
else {

if ($encoding == "UTF-8") {
$post_header = 'Content-type: application/x-www-form-urlencoded'."\r\n".'Accept-Charset: UTF-8'."\r\n".'Content-Length: '.$len."\r\n".'futureDate: '.$futureDate."\r\n".'languageCode: PHP'."\r\n";
}
else {
$post_header = 'Content-type: application/x-www-form-urlencoded'."\r\n".'Content-Length: '.$len."\r\n".'futureDate: '.$futureDate."\r\n".'languageCode: PHP'."\r\n";
}

//Sending the Request
$stream_options = array(
	'http' => array(
	'method' => 'POST',
	'header' => $post_header,
	'content' => $myxml
	)
);

//Getting the response
$context  = stream_context_create($stream_options);
$response = file_get_contents($new_server_url, false, $context);
$resxml=simplexml_load_string($response) or die("Error: Cannot create object");

if ($response != "") {
	$AwBNo = $resxml->AWBInfo->AWBNumber;
	if (substr(trim($AwBNo),0,7)<>'UnKnown'){
		echo $AwBNo;
		header('Location: trackawb.php?id=' . $AwBNo . "&ref=" . $_GET['ref']);
	}else{
		echo "No Proper Response " . substr(trim($AwBNo),0,7);
		header('Location: trackawb.php?id=' . $_GET['ref'] . "&ref=" . $_GET['ref']);
	}
		
} else {
echo "Failed to receive response <BR><BR>";
}

//=echo "Total time taken to process request and respond back to client | ".StopWatch::elapsed()."<BR>";
//=echo "<br>Done.<br>";

}

//Unset Cookie
unset($_COOKIE['ipaddress']);

//StopWatch
//=class StopWatch {
  //@var $startTimes array The start times of the StopWatches
//=  private static $startTimes = array();

  //Start the timer 
  //@param $timerName string The name of the timer
  //@return void
//=  public static function start($timerName = 'default') {
//=    self::$startTimes[$timerName] = microtime(true);
//=  }

  //Get the elapsed time in seconds
  //@param $timerName string The name of the timer to start
  //@return float The elapsed time since start() was called
//=  public static function elapsed($timerName = 'default') {
//=    return round((microtime(true) - self::$startTimes[$timerName]) * 1000);
//=  }
//=}

function getBetween($reqxml,$el_start,$el_end){
  $el_config = explode($el_start, $reqxml);
  if (isset($el_config[1])){
      $el_config = explode($el_end, $el_config[1]);
      return $el_config[0];
  }
  return '';
}

//Flush DNS 
if ($flushDNS == true) {
	$getOSName = PHP_OS_FAMILY;
	//Windows', 'BSD', 'Darwin', 'Solaris', 'Linux' or 'Unknown'.
	$count = $count + 1;		
	
	if ($count > 1) {
	} else {
		echo "<BR>================= Please Wait for 60 seconds; Retry in progress ...... ================= <BR><BR>";
		Switch ($getOSName) {
			case "Windows": //Windows OS
				$cmd_str = "ipconfig /flushdns";
				$responsetxt = exec($cmd_str);
				$log->LogInfo($MessageReference."WINDOWS OS -> ".$cmd_str." -> ".$responsetxt); 
				echo "WINDOWS OS -> ".$cmd_str." -> ".$responsetxt."<BR><BR>";
				break;
				
			case "Darwin": //Macintosh
				$cmd_str = "dscacheutil -flushcache";
				$responsetxt = exec($cmd_str);
				$log->LogInfo($MessageReference."MAC OS -> ".$cmd_str." -> ".$responsetxt); 
				echo "MAC OS -> ".$cmd_str." -> ".$responsetxt."<BR><BR>";
				break;
				
			case "Linux": //Unix/Linux OS
				$cmd_str_1 = "nscd -I hosts";
				$responsetxt_1 = exec($cmd_str_1);
				$log->LogInfo($MessageReference."Unix/Linux OS -> ".$cmd_str_1." -> ".$responsetxt_1); 
				echo "Unix/Linux OS -> ".$cmd_str_1." -> ".$responsetxt_1."<BR><BR>";
				
				$cmd_str_2 = "dnsmasq restart";
				$responsetxt_2 = exec($cmd_str_2);
				$log->LogInfo($MessageReference."Unix/Linux OS -> ".$cmd_str_2." -> ".$responsetxt_2); 
				echo "Unix/Linux OS -> ".$cmd_str_2." -> ".$responsetxt_2."<BR><BR>";
	
				$cmd_str_3 = "rndc restart";
				$responsetxt_3 = exec($cmd_str_3);
				$log->LogInfo($MessageReference."Unix/Linux OS -> ".$cmd_str_3." -> ".$responsetxt_3); 
				echo "Unix/Linux OS -> ".$cmd_str_3." -> ".$responsetxt_3."<BR><BR>";
				break;
			
			case "Solaris":
			case "BSD":
			case "Unknown": //Unknown
				echo "Unable to flush DNS <BR><BR>";
				break;
		}
		sleep(60);
		
	}
	if ($count > 3) {
		echo "=================    Three (3) retries are done - please contact DHL Support Team       ====================== <BR><BR>";
		$log->LogInfo($MessageReference." | Total time taken to process request and respond back to client | ".StopWatch::elapsed()); 
		echo "Total time taken to process request and respond back to client | ".StopWatch::elapsed()."<BR>";
		$log->LogInfo($MessageReference." | END DHLClient");			
		exit();
	} else {
		$log->LogInfo(" | RETRY =========> ".($count));
		echo "<BR>RETRY =========> ".($count)."<BR>";

		goto A;
	}
} else {}

?>