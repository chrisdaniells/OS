<?php
    session_start();

    // Pull General Functions

    $request = $_POST['request'];
    $programId = $_POST['programId'];
    $rootDir = $_POST['rootDir'];

    include  '../functions/general.php';
    getClassFiles();

    // NEED dynamically named variables

    switch($request) {
        case "open":
            $program = new core\window\window($programId);
            echo $program->getProgram();
            break;
        case "close":
            unset($program);
            break;
        default:
            break;
    }


