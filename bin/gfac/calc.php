<!DOCTYPE html>
<HTML>
	<head>
		
		
		<script src="js/jquery-1.8.3.js"></script>
		<script src="js/jquery-ui-1.9.2.custom.js"></script>


	</head>   	
	<body>
	
		<script type="text/javascript">

			$(document).ready(function()
			{
			   
			}
			)
			function gfactor()
			{
				  var Frequency=0;
				  var gfactor=2.0023;
				  cvalue=document.getElementById("frequency");				 
				  if(cvalue != 0)
				  {				 
					Frequency=cvalue.value;
				  }
				  if ( Frequency >= 0)
				  {
					var str='Frequency='+Frequency+'&gfactor='+gfactor+'&rnd='+Math.random();
					$('#CalcAll').load("gfactor.php",str);
				  } else
				  {
				  	$('#CalcAll').load("error.html");
				  }
			}
		</script>
			Частота <input id='frequency' type="text" size="5" value="9.4"> ГГц <BR>
			<button type="submit" class="save_button" onclick="gfactor()">Вычислить поле</button> <BR>		
		<div id='CalcAll'>
		</div>		
	</body>
</html>
