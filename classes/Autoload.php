<?php
    spl_autoload_register(function($class) {
        $fullClass = substr($class, strrpos($class, "\\", 0));
        $file = str_replace("\\", "/", __DIR__) . str_replace("\\", "/", $fullClass) . ".php";
         /* DEBUG */
		// echo "Class: {$class}" . "<br>";
		// echo "Class End: {$fullClass}" . "<br>";
		// echo "Full Path: {$file}" . "<br>";
		if(file_exists($file)) {
			// echo "{$file} exists";
			require $file;
		} else {
			echo "{$file} doesn't exist";
		}
    });
