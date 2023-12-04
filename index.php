<?php

session_start();

    //Define url constant
    define("URL", str_replace("index.php","",(isset($_SERVER['HTTPS']) ? "https" : "http").
    "://$_SERVER[HTTP_HOST]$_SERVER[PHP_SELF]"));

    require_once "controllers/BooksController.controller.php";
    $bookController = new BooksController;

    try{
        if (empty($_GET['page'])){
            require "views/home.view.php";
        } else {
            
            $url = explode("/", filter_var($_GET['page']), FILTER_SANITIZE_URL);
            
            switch($url[0]){
                case "home" : require "views/home.view.php";
                break;

                case "books" :
                    if(empty($url[1])){
                        $bookController->displayBooks();
                    }
                    else if($url[1] === "b"){
                        $bookController->displayBook($url[2]);
                    }
                    
                    else if($url[1] === "a"){
                       $bookController->addBook();
                    }
                    
                    else if($url[1] === "u"){
                        $bookController->updatingBook($url[2]);
                    }
                    
                    else if($url[1] === "d"){
                        $bookController->removingBook($url[2]);
                    }
                    else if($url[1] === "va"){
                        $bookController->addValidationBook();
                    }

                    else if($url[1] === "vu"){
                        $bookController->updatingBookValidation();
                    }

                    else {
                        throw new Exception("This page is not available");
                    }                         
                break;
                default : throw new Exception("This page is not available"); 
            }
        }
    }
    catch(Exception $e){
        $msg = $e->getMessage();
        require "views/error.view.php";
    }