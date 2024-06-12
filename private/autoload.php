<?php
spl_autoload_register(/**
    * @throws Exception
    */
   function ($className) {
       // Replace namespace separators with directory separators and ensure proper case
       $classFile = str_replace('\\', '/', $className) . '.php';
       $classFile = str_replace('App/', '', $classFile);

        $path = __DIR__ . '../' . $classFile;
   
        if (file_exists($path)) {
              require_once $path;
         } else {
           // If the class file doesn't exist, throw an error
              throw new Exception("Class $className not found in $classFile");
        }
   });
   