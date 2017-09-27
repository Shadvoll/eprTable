<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>EPR TABLE </title>
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="css/main.css">
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
          <li ><a href="about.php">Про нас</a></li>
          <li><a href="#">База данных ЭПР</a></li>
          <!-- <li><a href="#">Работы</a></li> -->
          <li class="active"><a href="#"><i class="fa fa-envelope-o" aria-hidden="true"></i> Обратная связь</a></li>
        </ul>
      </div>
    </div>
  </div>
	<br><br>
<div class="container">
  <h2>Форма обратной связи</h2>
  <form action="bin/mail.php">
		<div class="form-group">
      <label for="name">Имя</label>
      <input type="name" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="form-group">
      <label for="email">Email:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
		<div class="form-group">
		  <label for="comment">Text:</label>
		  <textarea class="form-control" rows="5" id="text" placeholder="Enter text here "name="text"></textarea>
		</div>
    <button type="submit" class="btn btn-default">Submit</button>
  </form>
</div>


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
