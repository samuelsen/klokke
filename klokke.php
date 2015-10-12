<?
    //incllud connection to the database & set time zone
    include 'admin/sqlConnect.php';
    date_default_timezone_set('Europe/Oslo');
    
    //query the database
    $query = "SELECT * FROM clock";
    $result= mysql_query($query);
    
    //Get the database result
    $timer	= date("Y-m-d G:i:s", strtotime(mysql_result( $result,0,"countTime")));
    $stamp = date(mysql_result( $result,0, "timeStamp"));
    $now = date("Y-m-d G:i:s");
    $show = mysql_result($result, 0, "show");
    
    //Get the diff
    $start_date = new DateTime($now);
    $since_start = $start_date->diff(new DateTime($timer));
            
    $hidden = 0;
    if($show == 0)
    {
        $hidden = 1;
    }
   //Build array for return
    $array = [
        "hour" => $since_start->format('%r%h'),
        "minute" => $since_start->format('%r%i') + $hidden,
        "seconds" => $since_start->format('%r%S'),
        "show" => $show
    ];

    echo json_encode($array);
?>
