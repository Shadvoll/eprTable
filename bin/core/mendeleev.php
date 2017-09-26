<?php include "bin/session/base.php" ?>
<html>
 <head>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
  <title>TableBetta</title>
  <!--<style>
		img{
		    width: ;
		    -webkit-transition: width 0.5s;
		    -moz-transition: width 0.5s;
		    -o-transition: width 0.5s;
		     transition: width 0.5s;
		     z-index: 1;
		}
		img:hover{
		    width: 125%;
		    z-index: 2;
		}
</style>-->
 </head>
 <body> 	
 	<table width='100%'>
 	<?php 
 		$i=0;$j=0; // счетчики
 		$columns=11; // количество столбцов
 		$strings=10; //количество строк
 		$current=1; // номер картинки
 		function print_cell($current)
 		{
 				$current_text=strval($current); 
 				 if ( ($current<10) && (fmod($current,10) > 0)){
 				 	$current_text="00".$current_text;
 				 } else if (($current<100) && (fmod($current,100) > 0)) {
 				 	$current_text="0".$current_text;
 				 } 				
 				
 					echo "<td><p><a  href='pick.php?pick=".$current."' ><img src='files/el".$current_text.".bmp' width='100%' ></a></p></td>"; 				 				
 			
 			
 				
 				 //echo "<td>".$current_text."</td>";
 		}
 		for ($i=0;$i<$strings;$i++)
 		{
 			echo "<tr>";
 			for ($j=0;$j<$columns;$j++)
 			{
 				if ($i==0){
 					if (($j>0) && ($j<10)){
 						echo "<td> </td>";
 					} else{
 					print_cell($current);
 					$current++;
 					}
 				}else if( ($i==1) || ($i==2) || ($i==4) || ($i == 6) || ($i==8)){
 					if ($j>6 && $j<10){
 						echo "<td></td>";
 					} else{
 					print_cell($current);
 					$current++;
 					}
 				} else if (($i==3) || ($i==5)) {
 					if ($j==10){
 						echo "<td></td>";
 					}else{
 						print_cell($current);
 						$current++;
 					}
 				} else if ($i==7){
 					if ($j==2){
 						print_cell(110);
 						$current=72;
 					}else if($j==10){
 						echo "<td></td>";
 					}else {
 						print_cell($current);
 						$current++;
 					}
 				} else if ($i==9){
 					if ($j==2){
 						print_cell(111);
 						$current=104;
 					} else if ($j>8){
 						echo "<td></td>";
 					}else {
 						print_cell($current);
 						$current++;
 					}

 				}
 			}
 			echo "</tr>";
 		}
 	?>
 	</table>
 	<table width='100%'>
 		<?php
 			$current=57;
 			for ($i=0;$i<4;$i++)
 			{
 				echo "<tr>";
 				if ($i==2) $current=89;
 				for($j=0;$j<11;$j++)
 				{ 				
 					if (($i==1) || ($i==3)){
 						if ($j>3){
 							echo "<td></td>";
 						}
 						else{
 							print_cell($current);
 				  			$current++;
 						}
 					} else
 					{
 						print_cell($current);
 						$current++;
 					}
 				}
 				echo "</tr>";
 			}
 		?>
 	</table>
 </html>


