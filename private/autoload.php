<?php
spl_autoload_register(/**
    * @throws Exception
    */
   function ($className) {
       // Replace namespace separators with directory separators and ensure proper case
       $classFile = str_replace('\\', '/', $className) . '.php';
   
       // Check if the class file exists in Controllers or Managers
       $controllersPath = __DIR__ . '/Controllers/' . $classFile;
       $managersPath = __DIR__ . '/Managers/' . $classFile;
   
       if (file_exists($controllersPath)) {
           require $controllersPath;
       } elseif (file_exists($managersPath)) {
           require $managersPath;
       } else {
           // If the class file doesn't exist, throw an error
           throw new Exception("Class $className not found in $controllersPath or $managersPath", 500);
       }
   });
   