<?php

	// -- Load classes file
	$rootDir = $_SERVER["DOCUMENT_ROOT"] . '/OS/classes/';
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
        	include  $classDir . '/' . $file;
        }
	}

	// -- Load Function Files
	$dir = $_SERVER["DOCUMENT_ROOT"] . '/OS/functions/';
	if (!is_dir($dir)) {
		die('Fatal Error: Invalid Directory Path for ' . $_SERVER["DOCUMENT_ROOT"] . $dir);
	}

	foreach (scandir($dir) as $file) {
		if ('.' === $file) continue;
        if ('..' === $file) continue;
        include $dir . $file;
	}

	// -- Load Registry
	$registry = new core\registry\registry();

    $registry->loadRegistry();
    $registry->filterInactivePrograms();

    if (!$registry->checkRegistryForErrors()) {
        die("Fatal Error Detected. Errors found in Registry. Please check error log");
    }

    // -- Load actionBar
    $actionBar = new gui\actionBar\actionBar($registry->getRegistry());
    $actionBar->buildIcon();
    $actionBar->buildCalender();
    if(!$actionBar->buildActionBar()) {
    	die("Fatal Error Detected. actionBar failed to Load. Please check error log");
    }

    







