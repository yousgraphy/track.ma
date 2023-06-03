<META HTTP-EQUIV="content-type" CONTENT="text/html; charset=utf-8">

<?php require_once('header.inc') ?>
<?php 
    
    if (isset($_GET['id'])) 
    {
        
        $id =  $_GET['id'];

$curl = curl_init();   
curl_setopt_array($curl, [
	CURLOPT_URL => "https://api-eu.dhl.com/track/shipments?trackingNumber=$id&language=fr",
//	CURLOPT_URL => "https://api-eu.dhl.com/track/shipments?shipperReference=$id&language=fr",
//	CURLOPT_URL => "https://xmlpi-ea.dhl.com/XMLShippingServlet?shipperReference=$id&language=fr",

	CURLOPT_RETURNTRANSFER => true,
	CURLOPT_ENCODING => "",
	CURLOPT_MAXREDIRS => 10,
	CURLOPT_TIMEOUT => 30,
	CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
	CURLOPT_CUSTOMREQUEST => "GET",
	CURLOPT_HTTPHEADER => [
		"DHL-API-Key: mIFN4Io90KkyEuKNenHOkBpH4SfiPXAW"
	],
]);
$response_json = curl_exec($curl);
$err = curl_error($curl);
if ($err) {
	echo "cURL Error #:" . $err;
}else{
//echo $response_json;
}
curl_close($curl);
$response=json_decode($response_json, true);
        
if (isset($_GET['ref'])){        
        echo "<h2 class='text-blue'>Référence numéro: " . $_GET['ref'] . "</h2>";
}
        echo "<h2 class='text-blue'>WayBill: $id</h2>";
        if (isset($response["shipments"])){
            $id 			= $response["shipments"][0]["id"];
            $service 		= $response["shipments"][0]["service"];
            $origin 		= $response["shipments"][0]["origin"]["address"]["addressLocality"];
            $dest 			= $response["shipments"][0]["destination"]["address"]["addressLocality"];
            $statustime 	= $response["shipments"][0]["status"]["timestamp"];
            $statusaddress 	= $response["shipments"][0]["status"]["location"]["address"]["addressLocality"];
            $statusDes 		= $response["shipments"][0]["status"]["description"];
			$parcelqty 		= $response["shipments"][0]["details"]["totalNumberOfPieces"];
//-----------------------------------------------------------------------------------------------------------
echo "<div align='center'>";
echo "	<table border='1' width='100%' id='customers' style=' border-collapse: collapse; cellpadding=3'>";
echo "		<tr scope='row'>";
echo "			<td scope='col' colspan='5'>";
echo "			<p align='center'><font size='6'>Details de l'envoi</font></td>";
echo "		</tr>";

echo "		<tr scope='row'>";
echo "			<td scope='col'  bgcolor='#99CCFF' colspan='3'><font size='4'>WayBill:</font></td>";
echo "			<td scope='col' align='left' bgcolor='#99CCFF' colspan='2'><b><font size='4'>$id</font></b></td>";
echo "		</tr>";

echo "		<tr scope='row'>";
echo "			<td scope='col'  bgcolor='#99CCFF' colspan='3'><font size='4'>Status:</font></td>";
echo "			<td scope='col' align='left' bgcolor='#99CCFF' colspan='2'><b>";
echo "			<font size='4'>$statusDes</font></b></td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td scope='col'  bgcolor='#99CCFF' colspan='3'><font size='4'>Origin:</font></td>";
echo "			<td scope='col' align='left' bgcolor='#99CCFF' colspan='2'><b>$origin</b></td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td scope='col'  bgcolor='#99CCFF' colspan='3'><font size='4'>Destination:</font></td>";
echo "			<td scope='col' align='left' bgcolor='#99CCFF' colspan='2'><b>$dest</b></td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td scope='col'  bgcolor='#99CCFF' colspan='3'><font size='4'>No. of Piece(s):</font></td>";
echo "			<td scope='col' align='left' bgcolor='#99CCFF' colspan='2'><b>$parcelqty</b></td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td scope='col' bgcolor='#99CCFF' colspan='5'>&nbsp;</td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td scope='col' colspan='5'>&nbsp;</td>";
echo "		</tr>";
echo "		<tr scope='row'>";
echo "			<td  bgcolor='#99CCFF' scope='col'><font size='2'><b>S#</b></font></td>";
echo "			<td  bgcolor='#99CCFF' scope='col'><font size='2'><b>DATE</b></font></td>";
echo "			<td  bgcolor='#99CCFF' scope='col'><font size='2'><b>TIME</b></font></td>";
echo "			<td  bgcolor='#99CCFF' scope='col'><font size='2'><b>STATUS</b></font></td>";
echo "			<td  bgcolor='#99CCFF' scope='col'><font size='2'><b>LOCATION</b></font></td>";
echo "		</tr>";

//-----------------------------------------------------------------------------------------------------------
			$checkpoints = $response["shipments"][0]["events"];
            foreach($checkpoints as $key=>$value) {
         		$dte = (new DateTime($value['timestamp']))->format('D d M Y');
         		$tme = (new DateTime($value['timestamp']))->format('H:i a');
         		$add = $value['location']['address']['addressLocality'];
         		$des = $value['description'];
//--------------------------------------------------------------------------------------------------------

echo "		<tr scope='row'>";
echo "			<td scope='col'  bordercolor='#000000'><font size='2'>$key</font></td>";
echo "			<td scope='col'  bordercolor='#000000'><font size='2'>$dte</font></td>";
echo "			<td scope='col'  bordercolor='#000000'><font size='2'>$tme</font></td>";
echo "			<td scope='col'  bordercolor='#000000'><font size='2'>$des</font></td>";
echo "			<td scope='col'  bordercolor='#000000'><font size='2'>$add</font></td>";
echo "		</tr>";

//--------------------------------------------------------------------------------------------------------
}   

echo "		<tr scope='row'>";
echo "			<td scope='col' width='98%' colspan='5' bgcolor='#99CCFF'><font size='2'>End....</font></td>";
echo "		</tr>";
echo "	</table>";
echo "</div>";


        } else {
            echo "<hr><h3 class='text-danger'>désolé, aucune information de suivi disponible</h2>";
        }

    } else {
        echo "<h2 class='text-danger'>Invalid Input.</h2>";
    }

    echo "<p><a href='index.php' class='btn btn-warning btn-lg mt-2'>suivre un autre envoi</a></p>";


?>


<?php require_once('footer.inc') ?>