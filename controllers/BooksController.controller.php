<?php

require_once "models/BookManager.class.php";

class BooksController{

    private $bookManager;

    public function __construct()
    {
        $this->bookManager = new BookManager;
        $this->bookManager->loadBooks();
    }

    public function displayBooks(){
        $bookManager = $this->bookManager;
        $books = $bookManager->getBooks();
        require "views/books.view.php";
    }

    public function displayBook($id){
        $book = $this->bookManager->getBookById($id);
        require "views/displaybook.view.php";
    }

    public function addBook(){
        require "views/addBook.view.php";
    }

    public function addValidationBook(){
        $file = $_FILES['image'];
        $directory = "public/images/";
        $addedPictureName = $this->addImage($file, $directory);
        $this->bookManager->addBookToDB($_POST['title'], $_POST['nbPages'], $addedPictureName);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Book added !"
        ];
        
        header('Location: '. URL ."books");
    }
    
    public function updatingBook($id){
        $book = $this->bookManager->getBookById($id);
        require "views/updateBook.view.php";
    }

    public function updatingBookValidation(){
        $currentPicture = $this->bookManager->getBookById($_POST['ident'])->getImage();
        $file = $_FILES['image'];

        if($file['size'] > 0){
            unlink("public/images/".$currentPicture);
            $directory = "public/images/";
            $PictureToAdd = $this->addImage($file, $directory);
        } else {
            $PictureToAdd = $currentPicture;
        }
        $this->bookManager->updateBookFromDB($_POST['ident'], $_POST['title'], $_POST['nbPages'], $PictureToAdd);
        
        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Book updated !"
        ];

        header('Location: '. URL ."books");
    }
        

    public function removingBook($id){
        $pictureName = $this->bookManager->getBookById($id)->getImage();
        unlink("public/images/".$pictureName);
        $this->bookManager->removingBookFromDB($id);

        $_SESSION['alert'] = [
            "type" => "success",
            "msg" => "Book deleted !"
        ];

        header('Location: '. URL ."books");
    }

    private function addImage($file, $dir){
        if(!isset($file['name']) || empty($file['name']))
            throw new Exception("You have to upload a picture !");
        
        if(!file_exists($dir)) mkdir($dir,0777);

        $extension = strtolower(pathinfo($file['name'],PATHINFO_EXTENSION));
        $random = rand(0,99999);
        $target_file = $dir.$random."_".$file['name'];

        if(!getimagesize($file["tmp_name"]))
            throw new Exception("The file is not a picture.");
        if($extension !== "jpg" && $extension !== "jpeg" && $extension !== "png" && $extension !== "gif")
            throw new Exception("Unknow file extension !");
        if(file_exists($target_file))
            throw new Exception("This file already exists");
        if($file['size'] > 500000)
            throw new Exception(("This file is too bulky."));
        if(!move_uploaded_file($file['tmp_name'], $target_file))
            throw new Exception("File not uploaded ! ");
        else return ($random."_".$file['name']);
    }
}