<?php

class Member extends User {

    private $isActive;
    private $borrowedBooks = [];

    public function __construct($name, $email) {
        parent::__construct($name, $email);
        $this->isActive = true;
    }

    public function isActive() {
        return $this->isActive;
    }

    public function addBook($book) {
        $this->borrowedBooks[] = $book;
    }

    public function removeBook($book) {
        foreach ($this->borrowedBooks as $key => $b) {
            if ($b === $book) {
                unset($this->borrowedBooks[$key]);
            }
        }
    }

    public function getBorrowedBooks() {
        return $this->borrowedBooks;
    }
}