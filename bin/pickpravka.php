<?php include "bin/session/base.php";
	include "bin/error/write_error.php";
 ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html>

	<body>
		

		<?php


		$imageDirr="image/";

		function myReplacer($text)
		// замена некоторых символов из sql таблицы, которые нельзя там хранить
		{
			$text=str_replace("#en#","</br>",$text); // перевод на след строчку 
			$text=str_replace("+-","±",$text);
			return $text;
		}
		if (!isset($_GET['pick']))
		{
			write_error(3,__FILE__." ".__LINE__);
		}
		$pick=$_GET['pick'];
		
		if (isset($_POST['new'])) // new isotop parameter 
		{	
			$info=mysql_query("SELECT * FROM bareElements WHERE number='".$_POST['number']."' AND weight2='".$_POST['weight2']."' ");
			$row=mysql_fetch_array($info);
			mysql_query("INSERT INTO elements2 (number,weight,weight2 ) VALUES ('".$row['number']."','".$row['weight']."','".$row['weight2']."')");

		}
		elseif (isset($_POST['picNew'])) //upload new image on server + mysql
		{
			// echo "<pre>";
			//$uploaddir="D:/USR/www/table.localhost/image/";
			$uploaddir=$imageDirr;
			$userfile=$_POST['userfile'];
			//$uploadfile=$uploaddir . basename($_FILES[$userfile]['name']);
			switch ($_FILES['userfile']['type']) {
				case "image/jpeg":
					# code...
					$type=".jpg";
					break;
				case "image/gif":
					$type=".gif";
					break;
				case "image/bmp":
					$type=".bmp";
					break;
				case 'image/png':
					$type=".png";
					break;	
				default:
					# code...
					$type=".jpg";
					break;
			}
			$uploadfile=$uploaddir . $userfile. $type;
			if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile))				
			{
				#success
				$info=mysql_query("SELECT image,imageName FROM elements2 WHERE id='".$_POST['id']."'");
				$row=mysql_fetch_array($info);
				$newImage=$row['image']."#dlmtr#".$userfile.$type;
				$newimageName=$row['imageName']."#dlmtr#".$_POST['imageName'];
				if(mysql_query("UPDATE elements2 SET image='".$newImage."' , imageName='".$newimageName."' WHERE id='".$_POST['id']."'"))
				{
					//echo "success";
				} else
				{
					echo "FAIL MYSQL query \n";
					write_error(2,__FILE__." ".__LINE__);
				}

			} else
			{
				echo "<br>FILE UPLOAD FAIL</br>";
				echo "<br>".$_FILES['userfile']['error']."</br>";
				echo $uploadfile."\n";
				print_r($_FILES);
				echo $_POST['id'];
				write_error(4,__FILE__." ".__LINE__." ".$_FILES."\n");
			}
			// echo "</pre>";
		}
		elseif (isset($_POST['deletepic'])) //delete picture 
		{
			$info=mysql_query("SELECT * FROM elements2 WHERE id=".$_POST['id']." ");
			$row=mysql_fetch_array($info);
			$pieces_image=explode("#dlmtr#",$row['image']);
			$pieces_imageName=explode("#dlmtr#",$row['imageName']);
			$newImage=NULL;
			$newImageName=NULL;
			$i=0;
			// echo $_POST['delimage'];
			if (count($pieces_image)>2)
			{
				for ($i=0;$i<count($pieces_image);$i++)
				{
					if (strcmp($_POST['delimage'],$pieces_image[$i])!=0)
					{
						$newImage=$newImage.$pieces_image[$i]."#dlmtr#";
						$newImageName=$newImageName.$pieces_imageName[$i]."#dlmtr#";
					}
				}
			} elseif(count($pieces_image)==2)
			{
				for ($i=0;$i<count($pieces_image);$i++)
				{
					if (strcmp($_POST['delimage'],$pieces_image[$i])!=0)
					{
						$newImage=$pieces_image[$i];
						$newImageName=$pieces_imageName[$i];
					}
				}
			}

			// echo $_POST['id'];
			if (mysql_query("UPDATE elements2 SET image='".$newImage."', imageName='".$newImageName."' WHERE id='".$_POST['id']."'"))
			{
				#succsess
				if (!rename($imageDirr.$_POST['delimage'],$imageDirr."/OLD/old_".$_POST['delimage']))
				{
					echo "rename FAIL";
					write_error(5,__FILE__." ".__LINE__);
				}
			}
			else
			{
				echo "Deleting Image Fail\n";
				write_error(2,__FILE__." ".__LINE__);
			}
		}
		elseif (isset($_POST['delete'])) // delete isotop parameters
		{

			if (!mysql_query("DELETE FROM elements2 WHERE id='".$_POST['id']."'"))
			{
				write_error(2,__FILE__." ".__LINE__);	
			}
		}
		elseif(isset($_POST['g_iso']) || isset($_POST['g_per']) || isset($_POST['g_par']) || isset($_POST['g_xx']) || isset($_POST['g_yy']) || isset($_POST['g_zz']) || isset($_POST['a_iso']) || isset($_POST['a_per']) || isset($_POST['a_par']) || isset($_POST['a_xx']) || isset($_POST['a_yy']) || isset($_POST['a_zz']) || isset($_POST['refs']) || isset($_POST['weight2'])) 
		{
			// echo $_POST['weight2'];
			// if (!mysql_query("UPDATE elements2 SET g_iso='".$_POST['g_iso']."',g_par='".$_POST['g_par']."',g_per='".$_POST['g_per']."',g_xx='".$_POST['g_xx']."',g_yy='".$_POST['g_yy']."',g_zz='".$_POST['g_zz']."',a_iso='".$_POST['a_iso']."',a_par='".$_POST['a_par']."',a_per='".$_POST['a_per']."',a_xx='".$_POST['a_xx']."',a_yy='".$_POST['a_yy']."',a_zz='".$_POST['a_zz']."',refs='".$_POST['refs']."' WHERE weight2='".$_POST['weight2']."', number='".$_POST['number']."' "))
				if (!mysql_query("UPDATE elements2 SET g_iso='".$_POST['g_iso']."', g_par='".$_POST['g_par']."', g_per='".$_POST['g_per']."',g_xx='".$_POST['g_xx']."',g_yy='".$_POST['g_yy']."',g_zz='".$_POST['g_zz']."',a_iso='".$_POST['a_iso']."',a_par='".$_POST['a_par']."',a_per='".$_POST['a_per']."',a_xx='".$_POST['a_xx']."',a_yy='".$_POST['a_yy']."',a_zz='".$_POST['a_zz']."',refs='".$_POST['refs']."'WHERE id='".$_POST['id']."'"))
				{ 
					echo "FAIL UPDATE";
					write_error(2,__FILE__." ".__LINE__);
				};
			//mysql_query("UPDATE elements2 SET g_iso='".$_POST['g_iso']."' WHERE weight2='".$_POST['weight2']."'");
			
		}
		$pick=$_GET['pick'];
		$info=mysql_query("SELECT * FROM bareElements WHERE number=".$pick." ");
		if ($info==FALSE)
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
				//нередактируемая информация
					$info=mysql_query("SELECT * FROM bareElements WHERE number=".$pick." ");
					while ($row=mysql_fetch_array($info))
					{
						echo "<td>\n";
							//echo"<li>  Номер :".$row['number']."</li>\n";
							//echo"<li> Наименование :".$row['name']."</li>\n";
							//echo"<li> Символ :".$row['symbol']."</li>\n";
							echo"<li> Оболочка :'".$row['shell']."'</li>\n";
							echo"<li> % :'".$row['percent']."'</li>\n";
							echo"<li> i :'".$row['i']."'</li>\n";
							echo"<li> ион :'".$row['ion']."'</li>\n";
							echo"<li> gmin :'".$row['g_min']."'</li>\n";
							echo"<li> gmax :'".$row['g_max']."'</li>\n";
							echo"<li> endor :'".$row['endor']."'' МГц при 0.35 Тл</li>\n";
							echo"<li> amin :'".$row['a_min']."'</li>\n";
							echo"<li> amax :'".$row['a_max']."'</li>\n";

							echo"<form id='deleteForm' action='pickpravka.php?pick=".$pick."' method='post'>\n";
								echo "<input id='weight2' name='weight2' hidden=1 value=".$row['weight2'].">\n";
								echo "<input id='number' name='number' hidden=1 value=".$row['number'].">\n";
								echo "<input id='new' name='new' hidden=1 value=1>\n";
								echo"<input type='submit' method='post' value='Добавить'>\n";
							echo"</form>\n";
						echo "</td>\n";
					}
				echo "</tr>\n";	
			$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");
			if ($info==FALSE)
			{
				write_error(2,__FILE__." ".__LINE__);
			}
			echo "<tr>\n";
			//колонки для редактирования 
			while( $row=mysql_fetch_array($info)){
				echo "<td>\n";
						$row=myReplacer($row);
						//echo"<li> Символ :".$row['symbol']."</li>\n";				
						//echo"<li> Наименование :".$row['name']."</li>\n";
						echo"<li> Вес :".$row['weight2']."</li>\n";
						echo"<li> Вес :".$row['weight']."</li>\n";
						echo"<form action='pickpravka.php?pick=".$pick."' method='post'>\n";	
							echo "<input id='weight2' name='weight2' hidden=1 value=".$row['weight2'].">\n";												
							echo "<input id='number' name='number' hidden=1 value=".$row['number'].">\n";												
							echo "<input id='number' name='id' hidden=1 value=".$row['id'].">\n";												
							echo"<li> ссылки :";
							echo"<input id='refs' name='refs' type='text' maxlength='100' value='".$row['refs']."'></li>\n";
							echo"<li> g изотропное :";
							echo "<input id='g_iso' name='g_iso' type='text' value='".$row['g_iso']."'></li>\n";
							echo"<li> g параллельное:";
							echo"<input id='g_par' name='g_par' type='text' value='".$row['g_par']."'></li> "; 
							echo"<li> g перпендикулярное:";
							echo"<input id='g_per' name='g_per' type='text' value='".$row['g_per']."'></li>\n";																
							echo"<li> g  xx :";
							echo"<input id='g_xx' name='g_xx' type='text' value='".$row['g_xx']."'></li>\n";																
							echo"<li> g  yy :";
							echo"<input id='g_yy' name='g_yy' type='text' value='".$row['g_yy']."'></li>\n";										
							echo"<li> g  zz :";
							echo"<input id='g_zz' name='g_zz' type='text' value='".$row['g_zz']."'></li>\n";										

							echo"<li> a изотропное :";
							echo"<input id='a_iso' name='a_iso' type='text' value='".$row['a_iso']."'></li>\n";										
							echo"<li> a параллельное:";
							echo"<input id='a_par' name='a_par' type='text' value='".$row['a_par']."'></li>\n";										
							echo"<li> a перпендикулярное:";
							echo"<input id='a_per' name='a_per' type='text' value='".$row['a_per']."'></li>\n";										
							echo"<li> a  xx :";
							echo"<input id='a_xx' name='a_xx' type='text' value='".$row['a_xx']."'></li>\n";										
							echo"<li> a  yy :";
							echo"<input id='a_yy' name='a_yy' type='text' value='".$row['a_yy']."'></li>\n";										
							echo"<li> a  zz :";
							echo"<input id='a_zz' name='a_zz' type='text' value='".$row['a_zz']."'></li>\n";										
							echo"<input type='submit' method='post' value='Сохранить'>\n";
						echo"</form>\n";

						echo"<form onsubmit="?>'return confirm("Вы точно хотите удалить?");'<?php echo "action='pickpravka.php?pick=".$pick."' method='post'>\n";
							echo "<input id='id' name='id' hidden=1 value=".$row['id'].">\n";
							echo "<input id='delete' name='delete' hidden=1 value=1>\n";
							echo"<input type='submit' method='post' value='Удалить'>\n";			
						echo"</form>\n";

				echo "</td>\n";
			}
			echo "</tr>\n";
			echo "<tr>\n";
			// загрузка Картинок
				echo "<td colspan=100% align='center'>\n";					
					$countImage=0;
					$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");	
					while ($row=mysql_fetch_array($info)){			
						$pieces_image=0;
						$pieces_imageName=0;
						if (($pieces_image=explode("#dlmtr#",$row['image'])) || $pieces_imageName=explode("#dlmtr#",$row['imageName']) )
						{//если много картинко и названий разбиварй в массив
							if (count($pieces_image)==1)							
							{
								if (isset($row['image']) && isset($row['imageName']))
								{
									$pieces_imageName=explode("#dlmtr#",$row['imageName']);
									$pieces_image=explode("#dlmtr#",$row['image']);
									$i=0;
									while($i<count($pieces_image))
									{
										echo"<img height=350px width=500px src=".$imageDirr.$pieces_image[$i].">\n";
										// echo $imageDirr.$pieces_image[$i];
										echo"<p><b>".$pieces_imageName[$i]."</b></p>\n";
										//delete img
										echo"<form onsubmit="?> 'return confirm("Вы точно хотите удалить?");' <?php echo "action='pickpravka.php?pick=".$pick."' method='post'>\n";
											echo "<input name='delimage' value='".$pieces_image[$i]."' hidden=1>";
											echo "<input name='delimageName' value='".$pieces_imageName[$i]."' hidden=1>";
											echo "<input id='id' name='id' hidden=1 value=".$row['id'].">\n";									
											echo "<input  name='deletepic' hidden=1 value=1>\n";
											echo "<input type='submit' value='Удалить'>";
										echo "</form>";
										echo"<li> Температура измерения:".$row['temperature']."</li>\n";	
										$i++;
									}
									$countImage=$countImage+count($pieces_image);
								}
							}
							// else
							// {

							// 	echo"<img src=".$row['image'].">\n";
							// 	echo"<p><b>".$row['imageName']."</b></p>\n";
							// 	$countImage++;
							// }
						}
						else
						{
							write_error(6,__FILE__." ".__LINE__);
						}
						
					}					
					// UPLOAD IMAGE 
					$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");	
					$row=mysql_fetch_array($info);
					echo"<form enctype='multipart/form-data' action='pickpravka.php?pick=".$pick."' method='post'>\n";
						echo "<input name='MAX_FILE_SIZE' value='3000000' hidden=1>";
						echo "<input id='id' name='id' hidden=1 value=".$row['id'].">\n";
						echo "<input  name='picNew' hidden=1 value=1>\n";
						$countImage++;
						$name='image_'.$row['symbol'].'_'.$countImage;
						echo "<input  id='userfile' name='userfile' value='".$name."' hidden=1 >\n";
						echo "<br><input required type='file' name='userfile' accept='image/*'></br>\n";
						echo "<br>Подпись к рисунку<input  required type='text' name='imageName' ></br>";
						echo "<input type='submit' value='Добавить'>\n";			
					echo"</form>\n";
				echo "</td>\n";	
			echo "</tr>\n";
		echo "</table>\n";
		
/*
		echo "<table border=1px>\n";
		$info=mysql_query("SELECT * FROM elements2 WHERE number=".$pick." ");
		while( $row=mysql_fetch_array($info)){
			echo "<td>\n";
				echo "<p>\n";
					echo"<li>  Номер :".$row['number']."</li>\n";
					echo"<li> Наименование :".$row['name']."</li>\n";
					echo"<li> Символ :".$row['symbol']."</li>\n";
					echo"<li> Вес :".$row['weight']."</li>\n";
					echo"<li> Оболочка :".$row['shell']."</li>\n";
					echo"<li> Вес :".$row['weight2']."</li>\n";
					echo"<li> % :".$row['percent']."</li>\n";
					echo"<li> i :".$row['i']."</li>\n";
					echo"<li> ион :".$row['ion']."</li>\n";
					echo"<li> gmin :".$row['g_min']."</li>\n";
					echo"<li> gmax :".$row['g_max']."</li>\n";
					echo"<li> endor :".$row['endor']." МГц при 0.35 Тл</li>\n";
					echo"<li> amin :".$row['a_min']."</li>\n";
					echo"<li> amax :".$row['a_max']."</li>\n";


					echo"<form action='pickpravka.php?pick=".$pick."' method='post'>\n";
					echo "<input id='weight2' name='weight2' hidden=1 value=".$row['weight2'].">\n";
					echo"<li> g изотропное : ";
					echo"<input id='g_iso' name='g_iso' type='text' value=".$row['g_iso']."></li>\n";										

					echo"<li> g параллельное:";
					echo"<input id='g_par' name='g_par' type='text' value=".$row['g_par']."></li>\n";										
					echo"<li> g перпендикулярное:";
					echo"<input id='g_per' name='g_per' type='text' value=".$row['g_per']."></li>\n";										
					echo"<li> g  xx :";
					echo"<input id='g_xx' name='g_xx' type='text' value=".$row['g_xx']."></li>\n";										
					echo"<li> g  yy :";
					echo"<input id='g_yy' name='g_yy' type='text' value=".$row['g_yy']."></li>\n";										
					echo"<li> g  zz :";
					echo"<input id='g_zz' name='g_zz' type='text' value=".$row['g_zz']."></li>\n";										

					echo"<li> a изотропное :";
					echo"<input id='a_iso' name='a_iso' type='text' value=".$row['a_iso']."></li>\n";										
					echo"<li> a параллельное:";
					echo"<input id='a_par' name='a_par' type='text' value=".$row['a_par']."></li>\n";										
					echo"<li> a перпендикулярное:";
					echo"<input id='a_per' name='a_per' type='text' value=".$row['a_per']."></li>\n";										
					echo"<li> a  xx :";
					echo"<input id='a_xx' name='a_xx' type='text' value=".$row['a_xx']."></li>\n";										
					echo"<li> a  yy :";
					echo"<input id='a_yy' name='a_yy' type='text' value=".$row['a_yy']."></li>\n";										
					echo"<li> a  zz :";
					echo"<input id='a_zz' name='a_zz' type='text' value=".$row['a_zz']."></li>\n";										
					echo"<li> ссылки :";
					echo"<input id='refs' name='refs' type='text' value=".$row['refs']."></li>\n";										
					echo"<input type='submit' method='post' value='Сохранить'>\n";
					echo"</form>\n";

				echo "</p>\n";
			echo "</td>\n";	
		}
		echo "</table>\n";*/
		?>
		
  		
  		
  		<?php 
  		echo "<a href='pick.php?pick=".$pick."'>Назад</a>\n";
  		?>
	</body>
</html>
