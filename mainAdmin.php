<?php

require "config/database.php";

require "src/Entities/User.php";
require "src/Entities/Book.php";
require "src/Entities/Member.php";
require "src/Services/Library.php";

$library = new Library($pdo);

while (true) {

    echo "\n===== ADMIN MENU =====\n";

    echo "1. Ajouter livre\n";
    echo "2. Ajouter membre\n";
    echo "3. Voir livres\n";
    echo "4. Supprimer livre\n";
    echo "5. Réparer livre\n";
    echo "0. Quitter\n";

    $choice = readline("Choix: ");

    switch ($choice) {

        case 1:

            $title = readline("Titre: ");
            $author = readline("Auteur: ");
            $isbn = readline("ISBN: ");

            $book = new Book(
                $title,
                $author,
                $isbn
            );

            $library->addBook($book);

            break;

        case 2:

            $name = readline("Nom: ");
            $email = readline("Email: ");
            $type = readline("Type(student/teacher): ");

            $library->registerMember(
                $name,
                $email,
                $type
            );

            break;

        case 3:

            print_r(
                $library->getAllBooks()
            );

            break;

        case 4:

            $id = readline("ID Livre: ");

            $library->removeBook($id);

            break;

        case 5:

            $id = readline("ID Livre: ");

            $library->repairBook($id);

            break;

        case 0:

            exit("Bye\n");

        default:

            echo "Choix invalide\n";
            break;
    }
}