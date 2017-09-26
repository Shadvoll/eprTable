<?php
//			print "Вычисление поля<BR>";
			$Frequency=0;
			$gfactor=0;
			if (!empty($_GET["Frequency"]))
			{
				$Frequency=$_GET['Frequency'];
			}
			if (!empty($_GET["gfactor"]))
			{
				$gfactor=$_GET['gfactor'];
			}
			$H=$Frequency*1000./$gfactor/1.4;
			$buf=sprintf("%.2f",$H);
			print "Магнитное поле ".$buf." Гс<BR>";
?>