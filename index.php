<?php
	session_start();
	// Define Global Root Path
	$_SESSION['root'] = $_SERVER["DOCUMENT_ROOT"] . ($_SERVER['SERVER_NAME']=="localhost" ? '/OS' : '') . '/';
	include  $_SESSION['root'] . 'runtime.php';

?>

<html>
	<head>
		<title>O5CA</title>
		<?php
			echo getSourceAssets($registry->getRegistry());
		?>
	</head>

	<body>
		<main>

		</main>
	<?php
		echo $actionBar->getActionBar();
	?>
	</body>
</html>