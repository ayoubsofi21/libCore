<?php

class Library {

    private $books = [];
    private $members = [];

    public function addBook($book) {
        $this->books[] = $book;
        echo "Livre ajouté\n";
    }

    public function addMember($member) {
        $this->members[] = $member;
        echo "Membre ajouté\n";
    }

    public function listBooks() {

        if (!$this->books) {
            echo "Aucun livre\n";
            return;
        }

        foreach ($this->books as $i => $book) {
            echo ($i + 1) . " - "
                . $book->getTitle() . " | "
                . $book->getAuthor() . " | "
                . $book->getStatus() . "\n";
        }
    }

    public function removeBook($i) {

        if (isset($this->books[$i])) {
            unset($this->books[$i]);
            $this->books = array_values($this->books);
            echo "Livre supprimé\n";
        } else {
            echo "Introuvable\n";
        }
    }

    public function repairBook($i) {

        if (isset($this->books[$i])) {
            $this->books[$i]->setStatus("repair");
            echo "Livre en réparation\n";
        } else {
            echo "Introuvable\n";
        }
    }
}