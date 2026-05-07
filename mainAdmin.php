<?php

require "config/database.php";
require "src/Entities/User.php";
require "src/Entities/Book.php";
require "src/Entities/Member.php";
require "src/Services/Library.php";

$library = new Library($pdo);
while (true) {
    echo "\n===== MENU =====\n";
    echo "1. Ajouter livre\n";
    echo "2. Ajouter membre\n";
    echo "3. Voir livres\n";
    echo "4. Supprimer livre\n";
    echo "5. Réparer livre\n";
    echo "0. Quitter\n";
    $choice = readline("Choix: ");
    switch ($choice) {
        case 1:
            $library->addBook(new Book(
                readline("Titre: "),
                readline("Auteur: "),
                readline("ISBN: ")
            ));
            echo "Livre ajouté\n";
            break;
        case 2:
            $library->addMember(new Member(
                readline("Nom: "),
                readline("Email: "),
                readline("Type (student/teacher): ")
            ));
            echo "Membre ajouté\n";
            break;
        case 3:
            $library->displayBooks();
            break;
        case 4:
            $id = readline("ID à supprimer: ");
            $library->removeBook($id);
            break;
        case 5:
            $id = readline("ID à réparer: ");
            $library->repairBook($id);
            break;
        case 0:
            exit("vous ete quiter\n");
        default:
            echo "Choix invalide\n";
    }
}