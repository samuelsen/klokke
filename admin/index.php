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
    
    $query = "SELECT * FROM clock";
    $result=mysql_query($query);
    $timer	= date(mysql_result( $result,0,"countTime"));
    $stamp = date(mysql_result( $result,0, "timeStamp"));
    $show = mysql_result( $result,0, "show");
    $now = date("Y-m-d G:i:s");

    $start_date = new DateTime($now);
    $since_start = $start_date->diff(new DateTime(date(mysql_result( $result,0, "countTime"))));    
?>

<!doctype html>
<html lang="no">
<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
<title>Adminpanel for talerklokke</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    
</head>
<body>
    <div class="container-fluid text-center">
        
        <div class="page-header"><h1>Klokke</h1></div>
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <?php
                    if($show == 1){
                        echo '
                        <div class="alert alert-success" role="alert">Viser sekunder</div>';
                    } 
                ?>
            <p><h4>Tid:<!--?=$since_start->format('%r%H:%I:%S')?--></h4></p>
                <iframe style="margin:auto;" src="klokke.html" height="40px;" width="75px;" frameborder="0"></iframe>
            <form action="index.php" method="post">
                <input type="hidden" name="Cmd" value="1" />
                <div class="form-group">
                    <input class="form-control text-center" type="text" name="m" placeholder="Input number of minutes" required >
                </div>
                    <button type="submit" class="btn btn-primary btn-block">Sett</button>
			        <a type="button" class="btn btn-success  btn-block" href="index.php?sek=1">Vis sekunder</a>
                    <a type="button" class="btn btn-danger  btn-block" href="index.php?sek=0">Skjul sekunder</a>
            </form>
            </div>
        </div>
    </div>
</body>
</html>