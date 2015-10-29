<?php
include_once('konst.php');

if (!$con)

  {

	echo '<span class="label label-danger" style="padding:10px 20px;">Sporočilo ni bilo poslano!</span>';

  } else {

 

mysql_select_db("drevozelja", $con);


// create query
$query = "SELECT sporocilo FROM zelje WHERE potrjeno = 3 ORDER BY id DESC";
$result = mysql_query($query ,$con);

		$response = '';
		if (mysql_num_rows($result) > 0) {
			while($row = mysql_fetch_row($result)) {
				
				$search = array("\\\\","\\0","\\n", "\\r", "\'", '\"', "\\Z");	
				$replace = array("\\",  "\x00", "\n",  "\r",  "'",  '"', "\x1a");			
				$response .= "<li>".str_replace($search, $replace, $row[0])."</li>";
			}
		}
		else {
			$response = $default;
		}

	mysql_free_result($result); 

}
mysql_close($con);

?>
<!doctype html>
<html>
<head>
    <!--meta http-equiv="refresh" content="10" /-->
    <link href='http://fonts.googleapis.com/css?family=Allura&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <link rel='stylesheet' id='bootstrap-css'  href='http://www.smgs.si/wp-content/themes/Edu/assets/css/bootstrap.css?ver=3.0' type='text/css' media='all' />
    <link rel='stylesheet' href='animacija.css' type='text/css' media='all' />
	<meta charset="utf-8">
</head>
<body>
<div id="container" class="container">
  <div class="row">
	<div id="okvir">
    	<h1><?php echo $naslov; ?></h1>

            <h2><span class="rotate-arena"><span data-rotate="#baza"></span></span></h2>
			<ul id="baza" class="baza" data-rotate-interval="7000" data-rotate-animate="fadeInDown,fadeOutDown">
                <?php echo $response; ?>
            </ul>
    </div>
  <div class="row">
    <div id="dodaj">
        <!--button class="btn btn-default btn-sm" type="button" id="zapri" style="display:none">Pošljite svojo željo!</button-->
      
      <span id="odpri">
      <form id="obrazec" method="post">
    <div class="input-group"><span class="input-group-addon input-sm" id="maks"><?php echo $tekst_len; ?></span>
      <input type="text" class="form-control input-sm" maxlength="<?php echo $tekst_len; ?>" id="tekst">
      <span class="input-group-btn">
        <button class="btn btn-default input-sm" type="button" id="poslji">Pošlji svojo željo</button>
      </span>
    </div><input type="hidden" id="seja" value="ENnj6ymusU4XC8b6GyXDkPLog4cDKFeBypRdrsWhrLSuQbUWF9Lp6Tm4VNppMgkqtJkLQNrFicWD6L82vJ2XqAd4QDfi2PbJm7rC" /></form></span><div id="izpis" style="display:none;"></div><!-- /input-group -->
    </div>
  </div>
</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="text.min.js"></script>
<script>
    $(document).ready(function() {
         $(".baza").rotator();
         
		 $("#tekst").keyup(function(){
			$("#maks").text(<?php echo $tekst_len; ?>-($("#tekst").val().length));
         });
		 $("#zapri").click(function(){
			//$("#zapri").hide();
			//$("#odpri").show();
         });
		 $("#poslji").click(function() {
				$.ajax({
				data: {
            'tekst': $("#tekst").val(), 'seja': $("#seja").val()
        },
				type: $("#obrazec").attr('method'), // GET or POST
				url: 'http://www.smgs.si/apps/drevozelja/poslji.php', // the file to call
				//async: false,
				success: function(response) { // on success..
				   $('#izpis').html(response); // update the DIV
				   if(response!=''){
					    $("#tekst").val('');
				   		$("#maks").html(<?php echo $tekst_len; ?>);
				   }
				   
					$("#odpri").hide();
					$("#izpis").show();
					setTimeout(function (){
						$("#izpis").hide();
						$("#odpri").show();
					 }, 3000);
				},
			});	
		return false;
		})
    });
    </script>
</body>
</html>