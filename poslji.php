<?php 

//<iframe src="http://www.smgs.si/apps/drevozelja/" style="width:100%;min-height:500px;overflow: hidden;"></iframe>
include_once('konst.php');
$tekst=trim($_POST['tekst']);
$tekst=substr($tekst,0,$tekst_len);
$tekst=mysql_real_escape_string($tekst);
	$search = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");
	$replace = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");
$tekst = str_replace($search, $replace, $tekst);


if($tekst<>'' && $_POST['seja']=='ENnj6ymusU4XC8b6GyXDkPLog4cDKFeBypRdrsWhrLSuQbUWF9Lp6Tm4VNppMgkqtJkLQNrFicWD6L82vJ2XqAd4QDfi2PbJm7rC'){

$con = mysql_connect('localhost', 'drevozelja', 'Dr3vo.zelja');

if (!$con)

  {
	echo '<span class="label label-danger" style="padding:10px 20px;">Sporočilo ni bilo poslano!</span>';

  } else {

 

mysql_select_db("drevozelja", $con);


$sql="INSERT INTO zelje (sporocilo, ustvarjeno, vir)

VALUES

('".$tekst."', '".date("Y-m-d H:i:s")."', '".$_SERVER['REMOTE_ADDR']."')";

 
if (!mysql_query($sql,$con))

  {

  echo '<span class="label label-danger" style="padding:10px 20px;">Sporočilo ni bilo poslano!</span>';

  } else {

	$message = 'Sporočilo: "'.$tekst.'"'."\n\n";
	$message .= 'http://www.smgs.si/apps/drevozelja/pregled.php?seja=D9yJSjgSkHirDPdNMVeJ2UMHFYJJyxknVfVKdEaJhFM5sJjR5wgSAYJKUU2CZPnw9kJX6hBPxF9fAmDNMvfjrEdRhLFmcLthVDcZ'."\n\n";
	$message = wordwrap($message, 70, "\r\n");
	$headers = 'From: podpora@smgs.si' . "\r\n";
	mail('podpora@smgs.si', 'Poslana želja', $message, $headers);
	
	echo '<span class="label label-success" style="padding:10px 20px;"> Sporočilo je bilo uspešno poslano!</span>';

  }
}
mysql_close($con);


}else{
	echo '<span class="label label-danger" style="padding:10px 20px;">Sporočilo ni bilo poslano!</span>';
} 
?>