<?
    include 'admin/sqlConnect.php';
    date_default_timezone_set('Europe/Oslo');
    

                    $query = "SELECT * FROM clock";
                    $result= mysql_query($query);
                    $timer	= date("Y-m-d G:i:s", strtotime(mysql_result( $result,0,"countTime")));
                    $stamp = date(mysql_result( $result,0, "timeStamp"));
                    $now = date("Y-m-d G:i:s");
                    $show = mysql_result($result, 0, "show");
                    $start_date = new DateTime($now);
                    $since_start = $start_date->diff(new DateTime($timer));

            //build array fpr return
            $array = [
                    "hour" => $since_start->format('%r%h'),
                    "minute" => $since_start->format('%r%i'),
                    "seconds" => $since_start->format('%r%S'),
                    "show" => $show
                ];

    echo json_encode($array);
?>
