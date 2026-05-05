<?php

require_once 'src/Entities/Book.php';
require_once 'src/Entities/Member.php';
require_once 'src/Services/Library.php';

// créer objets
$book1 = new Book("PHP Basics", "John");
$member1 = new Member("Samira", "samira@gmail.com");

$library = new Library();

// emprunter
$library->borrowBook($member1, $book1);

// afficher livres
echo "Livres empruntés :\n";
foreach ($member1->getBorrowedBooks() as $book) {
    echo $book->getTitle() . "\n";
}

// rendre
$library->returnBook($member1, $book1);