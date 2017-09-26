<?php include "bin/session/base.php";
	include "bin/error/write_error.php";
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>
	<head>
  		<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  		<script src="js/jquery-1.8.3.js"></script>
		<script src="js/jquery-ui-1.9.2.custom.js"></script>

	</head>
	<body>
		<script type="text/javascript">

			$(document).ready(function(){})
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
	<?php
		//переменные глобальные
		$imageDirr="image/"; // директория где хранятся спектры 
		function myReplacer($text)
		// замена некоторых символов из sql таблицы, которые нельзя там хранить
		{
			$text=str_replace("#en#","</br>",$text); // перевод на след строчку 
			$text=str_replace("+-","±",$text);
			return $text;
		}
		function showNotempty($text,$textName)
		{	

			$empty="NONE";
			if  ((strcmp($text,$empty)!=0) and (strcmp($text,"")!=0))
			{
				//вывод если не пусто применить с 96ой строки
				echo "<li> ".$textName." :".$text."</li>\n";
			}
			else
			{
				//не выводтить ничего
				// echo "<br>".$textName."---".$text."--FAILED--</br>";
			}
		}
		//в php НЕТ стркутур как в СИ. поэтому обходимся двумя массивами = 1 структура. ОЧЕНЬ ВАЖНА индексация. Не нарушать! надо придумать как обойтись без этого правила
		$name_list_bare=array("weight2","weight","shell","percent","i","ion","g_min","g_max","endor","a_min","a_max");
		$name_list_bare_discription=array("Вес","Вес","Оболочка","%","i","ион","gmin","gmax","endor","amin","amax");
		$name_list_elem=array("weight2","weight","refs","g_iso","g_par","g_per","g_xx","g_yy","g_zz","a_iso","a_par","a_per","a_xx","a_yy","a_zz");
		$name_list_elem_discription=array("Вес","Вес","Ссылки","g изотропное","g параллельное","g перпендикулярное","g xx","g yy","g zz","a изотропное","a параллельное","a перпендикулярное","a xx","a yy","a zz");
		if (!isset($_GET['pick']))
		{
			write_error(3,__FILE__." ".__LINE__);
		}
		$pick=$_GET['pick'];
		$info=mysql_query("SELECT * FROM bareElements WHERE number=".$pick." ");
		if ($info== FALSE)
		{
			write_error(1,__FILE__." ".__LINE__);
		}
		$row=mysql_fetch_array($info);
		echo "<table border=1px>\n";
				echo "<tr>\n";
					echo "<td> Имя\t";					
		 				echo $row['name'];
					echo "</br>Символ\t".$row['symbol'];
					echo "</br>Номер\t".$row['number'];
					echo "</td>\n";
				echo "</tr>\n";
				echo "<tr>\n";
					$info=mysql_query("SELECT * FROM bareElements WHERE number=".$pick." ");
					while ($row=mysql_fetch_array($info))
					{
						echo "<td>\n";
							for ($i=0;$i<max(array_keys($name_list_bare));$i++)
							{
								showNotempty($row[$name_list_bare[$i]],$name_list_bare_discription[$i]);
							}
						echo "</td>\n";
					}
				echo "</tr>\n";	
			$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");
			if ($info==FALSE)
			{
				write_error(2,__FILE__." ".__LINE__);
			}
			echo "<tr>\n";
			while( $row=mysql_fetch_array($info)){
				echo "<td>\n";
						$row=myReplacer($row);
						for ($i=0;$i<max(array_keys($name_list_elem));$i++)
							{
								showNotempty($row[$name_list_elem[$i]],$name_list_elem_discription[$i]);							
							}
				echo "</td>\n";
			}
			echo "</tr>\n";
			echo "<tr>\n";
				echo "<td colspan=100% align='center'>\n";
					$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");	
					while ($row=mysql_fetch_array($info)){
						if (!is_null($row['image'])){			
							if ($pieces_image=explode("#dlmtr#",$row['image']))
							{//если много картинко и названий разбиварй в массив
								$pieces_imageName=explode("#dlmtr#",$row['imageName']);
								$i=0;
									while($i<count($pieces_image))
									{
										echo"<img height=350px width=500px src=".$imageDirr.$pieces_image[$i].">\n";
										echo"<p><b>".$pieces_imageName[$i]."</b></p>\n";
										$i++;
									}
							}
							else
							{
								if (is_null($row['image']))
								{
									echo"<img src=".$row['image'].">\n";
									echo"<p><b>".$row['imageName']."</b></p>\n";
								}
								
							}
							showNotempty($row['temperature'],"Температура измерения");
						}
					}					
				echo "</td>\n";	
			echo "</tr>\n";
		echo "</table>\n";
		?>
		<div style="padding=5px; width: 200px ; height: 100px">
  		Частота <input id='frequency' type="text" size="5" value="9.4"> ГГц <BR>
			<button type="submit" class="save_button" onclick="gfactor()">Вычислить поле</button> <BR>		
		<div id='CalcAll'>
		</div>	
  		</div>
  		<?php
  		//echo "<a > Править (функция отключена)</a>\n";
  		echo "<a href='pickpravka.php?pick=".$pick."'> Править </a>\n";
  		?>
  		<a href='index.php'>Назад</a>	
	</body>

</html>
