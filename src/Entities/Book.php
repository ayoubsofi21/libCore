<<<<<<< HEAD
<?php 
    class Book{
            private $title;
            private $author;
            private $isbn;
            private  $status;
            public function __construct($title,$author,$isbn){
                $this->title = $title;
                $this->author = $author;
                $this->isbn = $isbn;
                $this->status = "available";

            }
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
=======
<?php

class Book {
    private $title;
    private $author;
    private $isAvailable;

    public function __construct($title, $author) {
        $this->title = $title;
        $this->author = $author;
        $this->isAvailable = true;
    }

    public function isAvailable() {
        return $this->isAvailable;
    }

    public function setAvailable($value) {
        $this->isAvailable = $value;
    }

    public function getTitle() {
        return $this->title;
    }
}
>>>>>>> origin/member
