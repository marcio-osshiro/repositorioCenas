<html>
<head>
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/custom.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

        <title>UFMS</title>
</head>
<body>
  <div class="container">
	<nav class="navbar navbar-default">
	  <div class="container-fluid">

		<div class="navbar-header">      
		  <a class="navbar-brand" href="#">UFMS - FACOM</a>
		</div>

	    <ul class="nav navbar-nav navbar-right">
	      <li><a href="#">Programa de Pós-Graduação</a></li>
	    </ul>
	  </div>
	</nav>

    @yield('conteudo')
	
	<footer class="footer">
	    <p>Disciplina de Computação Gráfica</p>
	</footer>
  </div>
</body>
</html>