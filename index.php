<?php
// Get cURL resource
$curl1 = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl1, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350027001347343339383037/current?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
$resp1 = curl_exec($curl1);
// Close request to clear up some resources
curl_close($curl1);
$curl2 = curl_init();
// Set some options - we are passing in a useragent too here
curl_setopt_array($curl2, array(
    CURLOPT_RETURNTRANSFER => 1,
    CURLOPT_URL => 'https://api.spark.io/v1/devices/350027001347343339383037/voltage?access_token=53790635296d04ffa465944aca4986faacf5536c',
    CURLOPT_USERAGENT => '192.168.0.10'
));
// Send the request & save response to $resp
$resp2 = curl_exec($curl2);
// Close request to clear up some resources
curl_close($curl2);

$data1 = json_decode($resp1);
$data2 = json_decode($resp2);
$temp1 = $data1->result;
$temp2 = $data2->result;
//get power and cost
//$temp3=$temp1*$temp2;
//$temp4=$temp3*0.07*0.001;
// MySQL stuff... sigh
$dbhost = 'localhost:3036';
$dbuser = 'smartpluguser';
$dbpass = 'chris';
$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn )
{
  die('Could not connect: ' . mysql_error());
}
$temp3=$temp1*$temp2;
//$hour=strtotime($hour);
$hour=date('H');
echo 'Hour is:';
echo $hour;
if ((($hour >= 0) && ($hour < 10)) || (($hour>17) && ($hour<21)))
{
	$cost=0.10;
}
else {$cost=0.07;}
$temp4=$temp3*$cost;
echo PHP_EOL;
echo 'Current is: ';
echo $temp1;
echo PHP_EOL;
echo 'Voltage is: ';
echo $temp2;
echo PHP_EOL;
echo 'Power is: ';
echo $temp3;
echo PHP_EOL;
echo 'Cost is: ';
echo $cost;
echo PHP_EOL;
$sql = 'INSERT INTO smartplug '.
     '(Current, Voltage, Power, Cost, mincost) '.
     'VALUES ( '.$temp1.', '.$temp2.', '.$temp3.', '.$cost.','.$temp4.'
)';
mysql_select_db('smartplug');
$retval = mysql_query( $sql, $conn );
if(! $retval )
{
  die('Could not enter data: ' . mysql_error());
}
//echo "Entered data successfully\n";
mysql_close($conn);
 
// check out the nifty graph...

