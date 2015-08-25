<?
    include 'admin/sqlConnect.php';
date_default_timezone_set('Europe/Oslo');

?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
        <title>countdown clock</title>
        <link rel="stylesheet" type="text/css" href="css.css" />
    </head>
    <body>
        <div id="clock" class="clock"></div>
            <?
        
                function db(){
                    $query = "SELECT * FROM clock";
                    $result=mysql_query($query);
                    $timer	= date(mysql_result( $result,0,"countTime"));
                    $stamp = date(mysql_result( $result,0, "timeStamp"));
                    $now = date("Y-m-d G:i:s");

                    $start_date = new DateTime($now);
                    $since_start = $start_date->diff(new DateTime(date(mysql_result( $result,0, "countTime"))));
                    //echo "<p>Time when set: $stamp</p><p>Timer set to expire: $timer</p><p>Remaining time: ".$since_start->format('%r%H:%I:%S')."</p>";
                    return $since_start;
                }

                $since_start = db();                
            
        echo '<script type="text/javascript">
            var houres = '.$since_start->h.';
            var minute = '.$since_start->i.';
            var seconds = '.$since_start->s.';
            
            
            var myVar=setInterval(function () {myTimer()}, 1000);
            //myTimer();
            function myTimer()
            {
                if(minute != -25)
                {
                        seconds = seconds -1;
                    
                        if(seconds == -1){
                            minute = minute - 1;
                            seconds = 59;
                        }
                        
                    if(minute == -1)
                        {
                            houres = houres -1;
                            minute = 59;
                        }
                    if(houres != 0)
                    {
                        if(seconds >= 10)
                        {
                            if(minute <= 9)
                            {
                                document.getElementById("clock").innerHTML= houres + ":0" + minute + ":" + seconds;
                            }
                            else
                            {
                                document.getElementById("clock").innerHTML= houres +":" + minute + ":" + seconds;
                            }
                        }
                        else
                        {
                            if(minute <= 9)
                            {
                                document.getElementById("clock").innerHTML=houres + ":0" + minute + ":0" + seconds;
                            }
                            else
                            {
                                document.getElementById("clock").innerHTML=houres + ":"+ minute + ":0" + seconds;
                            }
                        }
                    }
                    else
                    {
                        if(minute < 5)
                        {
                            document.getElementById("clock").style.color = "red";                                                       
                        }
                        if(seconds >= 10)
                        {
                            if(minute <= 9)
                            {
                                document.getElementById("clock").innerHTML= "0" + minute + ":" + seconds;
                            }
                            else
                            {
                                document.getElementById("clock").innerHTML= minute + ":" + seconds;
                            }
                        }
                        else
                        {
                            if(minute <= 9)
                            {
                                document.getElementById("clock").innerHTML="0" + minute + ":0" + seconds;
                            }
                            else
                            {
                                document.getElementById("clock").innerHTML=minute + ":0" + seconds;
                            }
                        }
                    }
                }
            }
        </script>';
    
    ?>
        <script>
            setInterval(function () {<?php echo db(); ?>}, 5000);
        </script>
    </body>
</html>