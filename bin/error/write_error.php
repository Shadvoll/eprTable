
<?php
/* Код ошибки
	1- ошибка с запросом в MySQL bareElements
	2-	ошибка с запросом в MySQL elements2
	3- ошибка при обработки PICK переменной, отвечающей за номер в таблице Менделеева 
	4- ошибка при загрузке картинки
	5- при удалении ошибки
	6- при выводе картинки
	7-
*/
	function write_error($index,$msg)
	{
	$logfile="log/error.log";	
		if (isset($error_index))
		{
			$msg=date(DATE_RFC822)." ".$msg."\n";
			switch ($index) {
				case 1:
					# code...
					$msg=$msg."\n\tcode error=1. Query fail with TABLE bareElements\n";
					error_log($msg,3,$logfile);
					break;
				case 2:
					$msg=$msg."\n\tcode error=2. Query fail with TABLE elements2\n";
					error_log($msg,3,$logfile);
					break;
				case 3:
					$msg=$msg."\n\tcode error=3. Variable 'pick' is not set\n";
					error_log($msg,3,$logfile);
					break;
				case 4:
					$msg=$msg."\n\tcode error=4. Error upload file\n";
					error_log($msg,3,$logfile);
					break;
				case 5:
					$msg=$msg."\n\tcode error=5. Error rename file\n";
					error_log($msg,3,$logfile);				
					break;
				case 6:
					$msg=$msg."\n\tcode error=6. Error in showing image\n";
					break;
				case 7:
					break;
				case 8:
					break;				
				default:
					error_log($msg,3,$logfile);
					break;
			}
			
		}
	}
?>