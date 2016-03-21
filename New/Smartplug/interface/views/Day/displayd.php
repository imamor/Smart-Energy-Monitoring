<?php    
    $username = "smartpluguser"; 
    $password = "chris";   
    $host = "localhost";
    $database="smartplug";
    
    $server = mysql_connect($host, $username, $password);
    $connection = mysql_select_db($database, $server);
    
    $myquery = "SELECT  SUM(hourlycost)AS 'sumd' FROM  `currents` ORDER BY 'Date' DESC LIMIT 24  ";

    $query = mysql_query($myquery);
    
    if ( ! $query ) {
        echo mysql_error();
        die;
    }
 
  while ($row = mysql_fetch_assoc($query)) {
      $data = $row["sumd"];
  }
      

    //echo $data;     
     session_start();
     $_SESSION['powercostd']=$data;
     echo $_SESSION['powercostd'];
	mysql_close($server);
?>
