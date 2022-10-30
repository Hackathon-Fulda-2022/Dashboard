time=[
<?php
    include("config.php");    
    $patient = $_GET["patient"];
    $vital = $_GET["vital"];
    $db = pg_connect($pg_conn_str);
    $time = 0; //time()-86400;
    $sql = 'SELECT "vitValue", "vitDateTime" FROM public.vitals WHERE "patientID" = '.$patient.' AND "vitType" = \''.$vital.'\'  ORDER BY "vitDateTime";';
    //$sql = 'SELECT "vitValue", "vitDateTime" FROM public.vitals WHERE "patientID" = '.$patient.' AND "vitType" = \''.$vital.'\' AND "vitDateTime" >='.$time.' ORDER BY "vitDateTime";';
    //Zeitbegrenzung aus Datenvervfügbarkeitsgründen rausgenommen.
    //echo($sql);
    $result = pg_query($db, $sql);
    $time = array();
    $value = array();
    for($i = 0; $row = pg_fetch_row($result); $i++) {
        $value[$i] = $row[0];
        $time[$i] = $row[1];
    }
    for($i = 0; $i < sizeof($value); $i++)
        //echo 'new Date('.(intval($time[$i])*1000).').getHours()+":"+addZ(new Date('.(intval($time[$i])*1000).').getMinutes()),';
        echo "'".gmdate('Y-m-d\TH:i:s\Z', $time[$i])."',";
    echo "]; value=[";
    for($i = 0; $i < sizeof($value); $i++)
        echo $value[$i].",";
    echo "];";
    $result = pg_query($db, 'SELECT "vitName", "vitUnit" FROM "vitalsTypes" WHERE "vitType" ='.$vital);
    $row = pg_fetch_row($result);
    echo ' type="'.$row[0].'"; unit="'.$row[1].'";';
    pg_free_result($result);
	pg_close($db );										
?>