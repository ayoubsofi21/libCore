<?php 
    class Book{
            private $title;
            private $author;
            private $isbn;
            private $status;
            // initialiser l'objet book au moment de sa creation
            public function __construct($title,$author,$isbn){
                $this->title = $title;
                $this->author = $author;
                $this->isbn = $isbn;
                $this->status = "available";

            }
            // lire les values sans casser la securite
            public function getTitle() {
                return $this->title;
            }

            public function getAuthor() {
                return $this->author;
            }

            public function getIsbn() {
                return $this->isbn;
            }

            public function getStatus() {
                return $this->status;
            }

            public function setStatus($status) {
                $this->status = $status;
            }

    }
?>