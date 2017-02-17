<?
//set time zone
date_default_timezone_set('Europe/Oslo');
     
//read the json
$json = json_decode(file_get_contents('admin/test.json'), true);
    
//set values
$timeEnd	= date($json['timeEnd']);
$show = $json["show"];
$now = date("Y-m-d G:i:s");
    
//Calculate the diff
$start_date = new DateTime($now);
$since_start = $start_date->diff(new DateTime($timeEnd)); 

//check the date to cinfirm we're on the right date
$out = -5;

//Add 1minute if we're hiding the sec.
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
    "show" => $show,
    "out" => $out
];

//convert to json
echo json_encode($array);
?>
