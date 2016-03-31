<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    
    $myquery = "SELECT  SUM(HourlyRealKWH)AS 'used', SUM(HourlyCost)AS 'costd' FROM  `PowerCost` ORDER BY 'Date' DESC LIMIT 24  ";

    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["costd"];
      $data2 = $row["used"];
  }
      

    //echo $data;     
     session_start();
     $_SESSION['powercostd']=$data;
     $_SESSION['powerused']=$data2;
     echo $_SESSION['powercostd'];
     echo $_SESSION['powerused'];
	mysql_close($server);
?>
