<?php

	// -- Load Function Files
	$dir = $_SESSION['root'] . 'functions/';
	if (!is_dir($dir)) {
		die('Fatal Error: Invalid Directory Path for ' . $_SERVER["DOCUMENT_ROOT"] . $dir);
	}

	foreach (scandir($dir) as $file) {
		if ('.' === $file) continue;
        if ('..' === $file) continue;
        include $dir . $file;
	}

	// -- Load Class Files
	getClassFiles();

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
    $actionBar->buildClock();
    if(!$actionBar->buildActionBar()) {
    	die("Fatal Error Detected. actionBar failed to Load. Please check error log");
    }

    







