<?php

require "config/database.php";

require "src/Entities/User.php";
require "src/Entities/Book.php";
require "src/Entities/Member.php";

require "src/Services/Library.php";

$library = new Library($pdo);

$member_id = 1;

while (true) {

    echo "\n===== MEMBER MENU =====\n";

    echo "1. Search\n";
    echo "2. Borrow\n";
    echo "3. Return\n";
    echo "4. My books\n";
    echo "0. Exit\n";

    $choice = readline("Choice: ");

    switch ($choice) {

        case 1:

            $keyword = readline("Keyword: ");

            print_r(
                $library->searchBooks($keyword)
            );

            break;

        case 2:

            $id = readline("Book ID: ");

            $library->borrowBook($id, $member_id);

            break;

        case 3:

            $id = readline("Book ID: ");

            $library->returnBook($id, $member_id);

            break;

        case 4:

            print_r(
                $library->getMemberLoans($member_id)
            );

            break;

        case 0:
            exit;
    }
}