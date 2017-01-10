<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Cadastro de Professor</title>
</head>

<body>
	@foreach ($professor as $prof)
		<h1> {{$prof}} </h1>
	@endforeach

	<?php  foreach ($professor as $prof) {
		echo "<h1>$prof</h1>";
	}
	?>
</body>

</html>