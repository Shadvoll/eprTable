<?php ?>
<html>
	<head>
		<meta charset="utf-8">
		<title> EPR base</title>		
		<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
		<link rel="stylesheet" type="text/css" href="css/mystyle.css?v=<?php=time();?>">
		<link rel="stylesheet" type="text/css" href="css/normalize.css" />
		<link rel="stylesheet" type="text/css" href="css/demo.css" />
		<link rel="stylesheet" type="text/css" href="css/component.css" />
		
	</head>

	<body>
		
		<nav class="header">
		  <ul>
		    <li><a href="index.php"><i class="fa fa-home fa-fw"></i>Главная страница</a></li>
		    <!-- <li><a href="#">Таблица Менделеева</a></li> -->
		    <!-- <li><a href="#">О нас</a></li> -->
		    <li><a href="#">Написать письмо</a></li>
		    <li><a href="#">Контакты</a></li>
		  </ul>
		 </nav>
		 <div class="empty">
		</div>

		 <article>
		 	<h1>Представление сайта </h1>
		 	<p>текст</p>
		 	<li>бла бла</li>
		 	<li>бла бла</li>
		 </article>
		 <?php include "mendeleev.php" ?>
		<div class="empty">
			<!-- empty block -->
		</div>
		<div class="footer">
			&copy; копирайты
		</div>
	</body>
</html> 