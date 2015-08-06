<?php

	function getSourceAssets($registry)
	{
		// Core CSS
		$assets = '<link rel="stylesheet" type="text/css" href="src/css/styles.css">';
		$assets .= '<link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">';

		// Program CSS files
		foreach($registry as $program) {
			$dir = $_SESSION['root'] . 'programs/' . $program['id'] . '/src/css/';
			if (!is_dir($dir)) {
				die('Fatal Error: Invalid Directory Path for ' . $dir . 'when sourcing CSS files');
			} else {
				foreach (scandir($dir) as $file) {
					if ('.' === $file) continue;
					if ('..' === $file) continue;
					$assets .= '<link rel="stylesheet" type="text/css" href="'. $dir . $file .'">';
				}
			}
		}

		// Core JS
		$assets .= '<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>';
		$assets .= '<script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>';
		$assets .= '<script src="src/js/js.min.js"></script>';

		return $assets;
	}

	function getClassFiles()
	{
		$rootDir = $_SESSION['root'] . 'classes/';
		if (!is_dir($rootDir)) {
			die('Fatal Error: Invalid Directory Path for ' . $_SERVER["DOCUMENT_ROOT"] . $rootDir);
		}

		foreach (scandir($rootDir) as $dir) {
			if ('.' === $dir) continue;
			if ('..' === $dir) continue;

			$classDir = $rootDir . $dir;
			foreach (scandir($classDir) as $file) {
				if ('.' === $file) continue;
				if ('..' === $file) continue;
				include $classDir . '/' . $file;
			}
		}
	}
