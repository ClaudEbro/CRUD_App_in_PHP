<?php

require_once "models/Model.class.php";
require_once "models/Book.class.php";

class BookManager extends Model{

    private $books; //Table of books

    public function addBook($book){

        $this->books[] = $book;
    }

    public function getBooks(){

        return $this->books;
    }

    public function loadBooks(){
        $req = $this->getDb()->prepare("SELECT * FROM books ORDER BY id ASC");
        $req->execute();
        $mybooks = $req->fetchAll(PDO::FETCH_ASSOC); //To avoid double value
        $req->closeCursor();

        foreach($mybooks as $book){
            $b1 = new Book($book['id'], $book['title'], $book['nbpages'], $book['image']);
            $this->addBook($b1);
        }
    } 

    public function getBookById($id){
        for($i=0; $i < count($this->books); $i++){
            if($this->books[$i]->getId() === $id){
                return $this->books[$i];
            }
        }
        throw new Exception("This book does not exist.");
    }

    public function addBookToDB($title, $nbPages, $image){
        $req = "
        INSERT INTO books (title, nbPages, image)
        values (:title, :nbPages, :image)";
        
        $stmt = $this->getDb()->prepare($req);
        $stmt->bindValue(":title", $title, PDO::PARAM_STR);
        $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
        $stmt->bindValue(":image", $image, PDO::PARAM_STR);

        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result > 0){
           $book = new Book($this->getDb()->lastInsertId(),$title, $nbPages, $image);
           $this->addBook($book); 
        }
    }

    public function removingBookFromDB($id){
        $req = "Delete from books where id = :idBook";

        $stmt = $this->getDb()->prepare($req);
        $stmt->bindValue(":idBook", $id, PDO::PARAM_INT);
        $result = $stmt->execute();
        $stmt->closeCursor();

        if($result > 0){
            $book = $this->getBookById($id);
            unset($book);
        }
    }

    public function updateBookFromDB($id, $title, $nbPages, $image){
       $req = "
       update books
       set title = :title, nbPages = :nbPages, image = :image
       where id = :id"; 

       $stmt = $this->getDb()->prepare($req);
       $stmt->bindValue(":id", $id, PDO::PARAM_INT);
       $stmt->bindValue(":title", $title, PDO::PARAM_STR);
       $stmt->bindValue(":nbPages", $nbPages, PDO::PARAM_INT);
       $stmt->bindValue(":image", $image, PDO::PARAM_STR);

       $result = $stmt->execute();
       $stmt->closeCursor();

       if($result > 0){
            $this->getBookById($id)->setTitle($title);
            $this->getBookById($id)->setNbPages($nbPages);
            $this->getBookById($id)->setImage($image);
        }
    }
}