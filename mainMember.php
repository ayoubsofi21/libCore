<?php
while (true) {
    echo "\n===== MEMBER MENU =====\n";
    echo "1. Rechercher livre\n";
    echo "2. Emprunter livre\n";
    echo "3. Retourner livre\n";
    echo "4. Mes emprunts\n";
    echo "0. Quitter\n";

    $choice = readline("Choix: ");

    switch ($choice) {

        case 1:
            $keyword = readline("Mot clé: ");
            $books = $library->searchBooks($keyword);
            print_r($books);
            break;

        case 2:
            $book_id = readline("ID livre: ");
            $library->borrowBook($book_id, 1);
            break;

        case 3:
            $book_id = readline("ID livre: ");
            $library->returnBook($book_id, 1);
            break;

        case 4:
            $loans = $library->getMemberLoans(1);
            print_r($loans);
            break;

        case 0:
            exit("bye\n");
    }
}

?>