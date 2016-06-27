<?php
//Source: http://codereview.stackexchange.com/questions/93590/php-autoload-class-from-namespace

    spl_autoload_register(function($class) {

        $filename = __DIR__ . '\\' . $class . '.php';

        if(!file_exists($filename)) {
            return false; // End autoloader function and skip to the next if available.
        }

        include $filename;
        return true; // End autoloader successfully.

    });