<?php

class Member {
    private $name;
    private $email;
    private $isActive;
    private $borrowedBooks = [];

    // constructeur
    public function __construct($name, $email) {
        $this->name = $name;
        $this->email = $email;
        $this->isActive = true; // membre actif par défaut
    }

    // getter isActive
    public function isActive() {
        return $this->isActive;
    }

    // ajouter un livre
    public function addBook($book) {
        $this->borrowedBooks[] = $book;
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