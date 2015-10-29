<?php
$tekst_len=120;
$naslov="Podarite željo";

$default = '<li>Vesel božič in srečno novo leto vam želi ekipa SMGŠ.</li><li>Srečnega pa zdrav\'ga! G.</li>';
if($_GET['seja']=='D9yJSjgSkHirDPdNMVeJ2UMHFYJJyxknVfVKdEaJhFM5sJjR5wgSAYJKUU2CZPnw9kJX6hBPxF9fAmDNMvfjrEdRhLFmcLthVDcZ'){
}
if($_GET['seja']=='zapri'){unset($_COOKIE["urednik"]);setcookie("urednik", "Profesor", time() -1000, "/");}

function izpis(){
$con = mysql_connect('localhost', '', '');
if (!$con)
  {
	echo 'Napaka s povezavo z bazo';
  } else {
mysql_select_db("drevozelja", $con);
$query = "SELECT id, sporocilo, potrjeno FROM zelje ORDER BY potrjeno ASC, id DESC";
$result = mysql_query($query ,$con);
		$response = '';
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_row($result)) {
				$response .= '<li>';
				
				if($row[2]==0){		
				$color="blue";			
				$response .= '<a href="http://www.smgs.si/apps/drevozelja/pregled.php?nal=potrdi&id='.$row[0].'" style="color:'.$color.';"><span class="glyphicon glyphicon-check"></span></a>';
				$response .= '&nbsp;&nbsp;';
				$response .= '<a href="http://www.smgs.si/apps/drevozelja/pregled.php?nal=zavrni&id='.$row[0].'" style="color:'.$color.';"><span class="glyphicon glyphicon-remove-circle"></span></a>';
				$response .= '&nbsp;&nbsp;';
				}
				elseif($row[2]==3){	
				$color="green";	
				$response .= '<a href="http://www.smgs.si/apps/drevozelja/pregled.php?nal=zavrni&id='.$row[0].'" style="color:'.$color.';"><span class="glyphicon glyphicon-remove-circle"></span></a>';
				$response .= '&nbsp;&nbsp;';
				}
				elseif($row[2]==5){		
				$color="red";					
				$response .= '<a href="http://www.smgs.si/apps/drevozelja/pregled.php?nal=potrdi&id='.$row[0].'" style="color:'.$color.';"><span class="glyphicon glyphicon-unchecked"></span></a>';
				$response .= '&nbsp;&nbsp;';
				}
				$search = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");	
				$replace = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");			
				$response .= '<span style="color:'.$color.';">'.str_replace($search, $replace, $row[1]).'</span>';		
				$response .= "</li>";
			}
		}
		else {
			$response = "Napaka s pridobivanjem podatkov!";
		}
	mysql_free_result($result); 
	return $response;
}
mysql_close($con);
}
?>