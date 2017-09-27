<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>EPR TABLE </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/about.css">
	</head>
	<body>
		<div class="navbar navbar-inverse navbar-fixed-top ">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
				<img  class="logo" src="img/logo.svg" alt="EPR TABLE">
        <a class="navbar-brand" href="index.html"  >EPR TABLE</a>
      </div>
      <div class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right cl-effect-3 ">
          <li ><a href="index.html">Домой</a></li>
          <li class="active"><a href="#">Про нас</a></li>
          <li><a href="#">База данных ЭПР</a></li>
          <!-- <li><a href="#">Работы</a></li> -->
          <li><a href="mail.php"><i class="fa fa-envelope-o" aria-hidden="true"></i> Обратная связь</a></li>
        </ul>
      </div>
    </div>
  </div>
	<br>
<div class="container-fluid">
		<div class="row ">

			<?php
			 	include "bin/session/base.php";
				$row=$epr_base->query('SELECT * from staff');
				$i=0;
				while($info=$row->fetch()){
					echo "<div class='col-sm-3 staff block'>\n";
					if ($info['Photo']){
							echo "<img src=".$info['Photo']." class='staff'>\n";
							$i++;
					}else{
							echo "<img src='img/noimage.jpg'> \n";
							$i++;
					}
					echo "</div>\n";
					echo "<div class='col-sm-3 staff block'>\n";
						echo $info['Name']."<br>\n";
						echo $info['Degree']."<br>";
						echo "<a href=".$info['url'].">Cсылка на профиль</a>";
						$i++;
					echo "</div>\n";
				}
			?>
		</div>
</div>


<br>
  <div class="navbar-fixed-bottom row-fluid" id="footer">
    <div class="navbar-inner">
      <div class="container">
        <div class="row centered">
          <a href="contacts.html">Контакты </a>
          <!-- <a href="#"><i class="fa fa-twitter"></i></a>
          <a href="#"><i class="fa fa-facebook"></i></a>
          <a href="#"><i class="fa fa-vk"></i></a> -->
        </div>
      </div>
  </div>
  </div>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	</body>
</html>
