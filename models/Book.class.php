<?php

class Book{

    private $id;
    private $title;
    private $nbPages;
    private $image;


    public function __construct($id, $title, $nbPages, $image){
        $this->id = $id;
        $this->title = $title;
        $this->nbPages = $nbPages;
        $this->image = $image;
    }

    public function getId(){return $this->id;}
    public function setId($id){$this->id = $id;}

    public function getTitle(){return $this->title;}
    public function setTitle($title){$this->title = $title;}

    public function getNbPages(){return $this->nbPages;}
    public function setNbPages($nbPages){$this->nbPages = $nbPages;}

    public function getImage(){return $this->image;}
    public function setImage($image){$this->image = $image;}
}