<?php
class Member{
    private $name;
    private $email;
    private $isActive;
    private $borrowbook =[];

    public function __construct($name,$email)
    {
     $this-> name =$name;
     $this ->email =$email;
     $this -> isActive =true ;
    }
    public function isActive(){
        return $this -> isActive;
    }
    public function addBook($book){
        $this -> borrowbook[]=$book;
    }


    // supprimer un livre
    public function removeBook($book) {
        foreach ($this->borrowedBooks as $key => $b) {
            if ($b === $book) {
                unset($this->borrowedBooks[$key]);
            }
        }
    }

    // afficher livres
    public function getBorrowedBooks() {
        return $this->borrowedBooks;
    }

    

}


?>