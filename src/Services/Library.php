<?php

class Library {

    // emprunter
    public function borrowBook($member, $book) {

        if (!$member->isActive()) {
            echo "Membre non actif\n";
            return;
        }

        if (!$book->isAvailable()) {
            echo "Livre non disponible\n";
            return;
        }

        // action
        $book->setAvailable(false);
        $member->addBook($book);

        echo "Livre emprunté avec succès\n";
    }

    // rendre
    public function returnBook($member, $book) {

        $book->setAvailable(true);
        $member->removeBook($book);

        echo "Livre rendu avec succès\n";
    }
}