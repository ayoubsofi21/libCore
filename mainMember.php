<?php
require_once "src/Entities/User.php";
require_once "src/Entities/Book.php";
require_once "src/Entities/Member.php";
require_once "src/Entities/Librarian.php";
require_once "src/Services/Library.php";

$library = new Library($pdo);
$member_id = 1;

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

            foreach ($books as $b) {
                echo $b['id'] . " - " . $b['title'] . " - " . $b['author'] . "\n";
            }
            break;

        case 2:
            $book_id = readline("ID livre: ");
            $library->borrowBook($book_id, $member_id);
            break;

        case 3:
            $book_id = readline("ID livre: ");
            $library->returnBook($book_id, $member_id);
            break;

        case 4:
            $loans = $library->getMemberLoans($member_id);

            foreach ($loans as $l) {
                echo $l['title'] . " | " . $l['borrow_date'] . "\n";
            }
            break;

        case 0:
            exit("bye\n");
    }
}