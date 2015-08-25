<? 
include 'sqlConnect.php';
//include 'setup.php';
/*Set localtime*/
date_default_timezone_set('Europe/Oslo');

    $h =$_POST['h'];
    $m =$_POST['m'];
    $s =$_POST['s'];
    $cmd =$_POST['Cmd'];
    $sek =$_GET['sek'];
    
    if($sek != "")
    {
        $query = "UPDATE `clock` SET `show` = $sek WHERE 1";
        mysql_query($query);
        
        
       /* $affected = mysql_affected_rows();
        if($affected > 0)
            echo "row was updated/inserted<br>";
        else
            echo "No rows were ....<br>";
        
        echo $query;*/
    }
        
    if($cmd == "") 
        $cmd =$_GET['Cmd'];
    
    $h = $h*60*60;
    $m = $m*60;
    
    if($cmd)
    {
    $until = date('Y-m-d G:i:s ', time()+$h+$m+$s);
    $today = date("H:i:s");
    $date = date('Y-m-d G:i:s');

    //echo "$until<br />$today<br />";
    $query = "UPDATE clock SET timeStamp = \"$date\", countTime = \"$until\" WHERE 1";
    mysql_query($query);
        
    }
?>

<!doctype html>
<html>
<head>
<meta charset="UTF-8">
<title>Adminpanel for talerklokke</title>
<link rel="stylesheet" type="text/css" href="css/css.css">
<link rel="stylesheet" type="text/css" href="css/style.css" />
<link rel="stylesheet" type="text/css" href="css/buttonstyles.css" />

<script type="text/javascript" src="js/jquery-2.0.0.min.js"></script>
    <style>
    .hjem p{
        color: black;   
    }
    .pad{
        padding-top: 2em;   
    }
    .center{
        text-align: center;
    }
    .button{
        width: 100%;
    }
    </style>
</head>
<body>
    <div class="content1">
        <div class="hjem" >
            <h1>Klokke</h1>
            <?
    $query = "SELECT * FROM clock";
    $result=mysql_query($query);
    $timer	= date(mysql_result( $result,0,"countTime"));
    $stamp = date(mysql_result( $result,0, "timeStamp"));
    $now = date("Y-m-d G:i:s");

    $start_date = new DateTime($now);
    $since_start = $start_date->diff(new DateTime(date(mysql_result( $result,0, "countTime"))));
    echo "<p>Time when set: $stamp</p><p>Timer set to expire: $timer</p><p>Remaining time: ".$since_start->format('%r%H:%I:%S')."</p>";
            
            ?>
            
            <form action="index.php" method="post" class="form">
                    <p class="pad"><input class="center" type="text" name="m" placeholder="Input number of minutes" required ></p>
                    <input type="hidden" name="Cmd" value="1" />
				    <p><input type="Submit" value="Sett"></p>
			        <p class="pad"><a type="button" href="index.php?sek=1" value="vis sekunder"> Vis sekunder </a></p>
                    <p class="pad"><a type="button" href="index.php?sek=0" value="Skjul sekunder"> Skjul sekunder </a></p>
            </form>
            
            
        </div>
        <span class="pad">
            
                </span>
    </div>
</body>
</html>