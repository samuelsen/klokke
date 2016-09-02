<? 

//To spit out error messages!
ini_set('display_errors', 1);
error_reporting(E_ALL ^ E_NOTICE);

/*Set localtime*/
date_default_timezone_set('Europe/Oslo');

    $h =$_POST['h'];
    $m =$_POST['m'];
    $s =$_POST['s'];
    $cmd =$_POST['Cmd'];


    $sek =$_GET['sek'];
    if($sek == "")
        $sek = $_POST['sek'];
      
    $elapse = "";

    if($sek != "" && $cmd == "")
    {
      
      $json = json_decode(file_get_contents('test.json'), true);
      $json['show'] = $sek;
      $json = json_encode($json);
      file_put_contents("test.json", $json);
    }
        
    if($cmd == "") 
        $cmd =$_GET['Cmd'];
    
    $h = $h*60*60;
    $m = $m*60;
    
    if($cmd)
    {
        $timeEnd = date('Y-m-d G:i:s ', time()+$h+$m+$s);
        $timeStart = date('Y-m-d G:i:s');
        
        $today = date("H:i:s");
        $elapse = $until;
      
        $json = json_encode(['timeStart' => $timeStart, 'timeEnd' => $timeEnd, 'show' => $sek]);
        file_put_contents("test.json", $json);
    }

   //read the json file 
    $json = json_decode(file_get_contents('test.json'), true);
   
//set timer info
    $timeEnd	= date($json['timeEnd']);
    $timeStart = date($json["timeStart"]);
    $show = $json["show"];
    $now = date("Y-m-d G:i:s");

    $start_date = new DateTime($now);
    $since_start = $start_date->diff(new DateTime($timeEnd));    
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

            <div class="page-header">
                <h1>Klokke</h1>
                <p>satt:
                    <?php echo $timeStart; ?>
                </p>
            </div>
            <div class="row">
                <div class="col-md-4 col-md-offset-4">
                    <?php
                    if($show == 1){
                        echo '
                        <div class="alert alert-success" role="alert">Viser sekunder</div>';
                    } 
                ?>
                        <p>
                            <h4>Tid:<span id="time"></span><!--?=$since_start->format('%r%H:%I:%S')?--></h4></p>
                        <iframe id="iframId" scrolling="no" style="margin:auto; overflow-x: hidden; overflow-y:hidden;" src="klokke.html" height="40px;" width="75px;" frameborder="0"></iframe>
                        <div class="row" style="padding-top: 2em;">
                            <div class="col-xs-3 col-md-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="Cmd" value="1" />
                                    <input type="hidden" name="sek" value="<? echo $show ?>">
                                    <input class="form-control text-center" type="hidden" name="m" value="5" required>
                                    <button type="submit" class="btn btn-default btn-block">5 min</button>
                                </form>
                            </div>
                            <div class="col-xs-3 col-md-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="Cmd" value="1" />
                                    <input type="hidden" name="sek" value="<? echo $show ?>">
                                    <input class="form-control text-center" type="hidden" name="m" value="10" required>
                                    <button type="submit" class="btn btn-default btn-block">10 min</button>
                                </form>
                            </div>
                            <div class="col-xs-3 col-md-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="Cmd" value="1" />
                                    <input type="hidden" name="sek" value="<? echo $show ?>">
                                    <input class="form-control text-center" type="hidden" name="m" value="15" required>
                                    <button type="submit" class="btn btn-default btn-block">15 min</button>
                                </form>
                            </div>
                            <div class="col-xs-3 col-md-3">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="Cmd" value="1" />
                                    <input type="hidden" name="sek" value="<? echo $show ?>">
                                    <input class="form-control text-center" type="hidden" name="m" value="35" required>
                                    <button type="submit" class="btn btn-default btn-block">35 min</button>
                                </form>
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-sm-12">
                                <form action="index.php" method="post">
                                    <input type="hidden" name="Cmd" value="1" />
                                    <input type="hidden" name="sek" value="<? echo $show ?>">
                                    <div class="form-group">
                                        <input class="form-control text-center" type="text" name="m" placeholder="Input number of minutes" required>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-block">Sett</button>
                                    <a type="button" class="btn btn-success  btn-block" href="index.php?sek=1">Vis sekunder</a>
                                    <a type="button" class="btn btn-danger  btn-block" href="index.php?sek=0">Skjul sekunder</a>
                                </form>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </body>

    </html>
