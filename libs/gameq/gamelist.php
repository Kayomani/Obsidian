<?php

$data = file_get_contents("Games.cfg");

$json = json_decode($data);

var_dump($json);

 switch(json_last_error())
    {
        case JSON_ERROR_DEPTH:
            echo ' - Maximum stack depth exceeded';
        break;
        case JSON_ERROR_CTRL_CHAR:
            echo ' - Unexpected control character found';
        break;
        case JSON_ERROR_SYNTAX:
            echo ' - Syntax error, malformed JSON';
        break;
        case JSON_ERROR_NONE:
            echo ' - No errors';
        break;
    }

    echo PHP_EOL;