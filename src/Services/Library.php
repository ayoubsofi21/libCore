<?php

class Library {
    private $books = [];
    private $members = [];

    // US1: Ajouter livre
    public function addBook($book) {
        $this->books[] = $book;
    }

    // US2: Ajouter membre
    public function addMember($member) {
        $this->members[] = $member;
    }

    // US3: Voir livres
    public function listBooks() {
        if (empty($this->books)) {
            echo "Aucun livre disponible.\n";
            return;
        }

        foreach ($this->books as $index => $book) {
            echo ($index + 1) . ". "
                . $book->getTitle() . " - "
                . $book->getAuthor() . " ("
                . $book->getStatus() . ")\n";
        }
    }

    // US4: Supprimer livre
    public function removeBook($index) {
        if (isset($this->books[$index])) {
            unset($this->books[$index]);
            $this->books = array_values($this->books);
            echo "Livre supprimé.\n";
        } else {
            echo "Livre introuvable.\n";
        }
    }

    // US4: Mettre en réparation
    public function repairBook($index) {
        if (isset($this->books[$index])) {
            $this->books[$index]->setStatus("repair");
            echo "Livre mis en réparation.\n";
        } else {
            echo "Livre introuvable.\n";
        }
    }
}