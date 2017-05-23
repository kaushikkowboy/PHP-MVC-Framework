<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<h1>Welcome to Home page</h1>
	<p>Hello <?php echo htmlspecialchars($name);?></p>
	<ul>
		<?php foreach ($knows as $know): ?>
		<li><?php echo htmlspecialchars($know);?></li>
		<?php endforeach; ?>
	</ul>
</body>
</html>