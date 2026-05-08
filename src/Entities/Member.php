<?php

class Member extends User {

    private $type;
    private $isActive;
    private $borrowedBooks = [];

    public function __construct($name, $email, $type) {

        parent::__construct($name, $email);

        $this->type = $type;
        $this->isActive = true;
    }

    public function getType() {
        return $this->type;
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