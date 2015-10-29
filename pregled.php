<?php
include_once('konst.php');
if($_COOKIE["urednik"]=='Profesor'){
	if (!$con)
	  {
		echo 'Napaka s povezavo z bazo';
	  } else {
			mysql_select_db("drevozelja", $con);
			if($_GET['nal']=='potrdi'){
				$query = "UPDATE zelje SET potrjeno='3', posodobljeno='".date("Y-m-d H:i:s")."' WHERE id='".$_GET['id']."'";
				$result = mysql_query($query ,$con);
			} 
			elseif ($_GET['nal']=='zavrni'){
				$query = "UPDATE zelje SET potrjeno='5', posodobljeno='".date("Y-m-d H:i:s")."' WHERE id='".$_GET['id']."'";
				$result = mysql_query($query ,$con);
			}
	}
	mysql_close($con);
}
?>
<!doctype html>
<html>
<head>
    <!--meta http-equiv="refresh" content="10" /-->
    <link rel='stylesheet' id='bootstrap-css'  href='http://www.smgs.si/wp-content/themes/Edu/assets/css/bootstrap.css?ver=3.0' type='text/css' media='all' />
	<meta charset="utf-8">
</head>
<body>
<div id="container" class="container">
  <div class="row">
	<div id="okvir">
    	<h1><a href="http://www.smgs.si/apps/drevozelja/pregled.php"><?php echo $naslov; ?> - Sporočila</a> <?php if($_COOKIE["urednik"]=='Profesor'){echo '<sup><a href="http://www.smgs.si/apps/drevozelja/pregled.php?seja=zapri"><span class="glyphicon glyphicon-remove"></span>odjava</a></sup>';} ?></h1>
            <div id="izpis"><ol id="baza" class="baza">
                <?php if($_COOKIE["urednik"]=='Profesor'){echo izpis();} ?>
            </ol></div>
    </div>
  
</div>
</div>
</body>
</html>