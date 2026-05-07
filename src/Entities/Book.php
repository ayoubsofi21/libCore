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

    public function getAuthor() {
        return $this->author;
    }
}