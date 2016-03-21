<?php
include("phpgraphlib.php");
$graph = new PHPGraphLib(1100,1000); 
$dataArray = array();
 
$dbhost = 'localhost:3036';
$dbuser = 'smartpluguser';
$dbpass = 'chris';
 
$link = mysql_connect($dbhost, $dbuser, $dbpass)
   or die('Could not connect: ' . mysql_error());
      
mysql_select_db('smartplug') or die('Could not select database');
   
$dataArray=array();
 
//get data from database
$sql = "SELECT tempinC, time FROM smartplug LIMIT 150";
$result = mysql_query($sql) or die('Query failed: ' . mysql_error());
if ($result) {
  while ($row = mysql_fetch_assoc($result)) {
      $tempinC = $row["tempinC"];
      $count = $row["time"];
      //add to data areray
      $dataArray[$count] = $tempinC;
  }
}
//configure graph
$graph->addData($dataArray);
$graph->setRange(100,0);
$graph->setRange(10000000000,0);
$graph->setTitle("Temperature");
$graph->setGradient("lime", "green");
$graph->setBarOutlineColor("black");
$graph->setBars(false);
$graph->setLine(true);
$graph->createGraph();
echo $sql;
?>
