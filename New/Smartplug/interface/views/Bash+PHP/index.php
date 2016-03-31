<?php
// Get cURL resource


$curl1 = curl_init();
curl_setopt_array($curl1, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350048000c47343432313031/real_power?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp1 = curl_exec($curl1);
curl_close($curl1);


$curl2 = curl_init();
curl_setopt_array($curl2, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350048000c47343432313031/app_power?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp2 = curl_exec($curl2);
curl_close($curl2);


$curl3 = curl_init();
curl_setopt_array($curl3, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350048000c47343432313031/rms_voltage?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp3 = curl_exec($curl3);
curl_close($curl3);


$curl4 = curl_init();
curl_setopt_array($curl4, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350048000c47343432313031/rms_current?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp4 = curl_exec($curl4);
curl_close($curl4);


$curl5 = curl_init();
curl_setopt_array($curl5, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350048000c47343432313031/factor_power?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp5 = curl_exec($curl5);
curl_close($curl5);


$data1 = json_decode($resp1);
$data2 = json_decode($resp2);
$data3 = json_decode($resp3);
$data4 = json_decode($resp4);
$data5 = json_decode($resp5);

$RealPower = $data1->result;
$ApparentPower = $data2->result;
$RMSVoltage = $data3->result;
$RMSCurrent = $data4->result;
$PowerFactor = $data5->result;


$dbhost = 'localhost:3036';
$dbuser = 'smartpluguser';
$dbpass = 'chris';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}



$hour=date('H');
echo 'Hour is:';
echo $hour;
echo PHP_EOL;
if ((($hour >= 0) && ($hour < 10)) || (($hour>17) && ($hour<21)))
{
	$cost=0.10;
}
else {$cost=0.07;}
$mincost=$RealPower*$cost;
echo $RealPower;
echo PHP_EOL;
echo $ApparentPower;
echo PHP_EOL;
echo $RMSCurrent;
echo PHP_EOL;
echo $RMSVoltage;
echo PHP_EOL;
echo $PowerFactor;
$sql = 'INSERT INTO smartplug '.
     '(RMSCurrent, RMSVoltage, RealPower, ApparentPower, PowerFactor, Cost, mincost) '.
     'VALUES ( '.$RMSCurrent.', '.$RMSVoltage.', '.$RealPower.', '.$ApparentPower.','.$PowerFactor.',
'.$cost.','.$mincost.')';
mysql_select_db('smartplug');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
mysql_close($conn);
 

