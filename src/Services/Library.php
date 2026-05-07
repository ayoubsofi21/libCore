<<<<<<< HEAD
<?php 

class Library{

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addBook(Book $book) {
        $sql = "INSERT INTO books (title, author, isbn, status) VALUES (?, ?, ?, ?)";
        $stmt = $this->pdo->prepare($sql);
        $stmt->execute([
            $book->getTitle(),
            $book->getAuthor(),
            $book->getIsbn(),
            $book->getStatus()
        ]);
    }

   

    public function getBooks() {
        $stmt = $this->pdo->query("SELECT * FROM books");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } 
    public function displayBooks() {
        $books = $this->getBooks();
        if (empty($books)) {
            echo "Aucun livre\n";
            return;
        }

        foreach ($books as $b) {
            echo $b['id'] . ". "
                . $b['title'] . " - "
                . $b['author'] . " ("
                . $b['status'] . ")\n";
        }
    }

    public function removeBook($id) {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id=?");
        $stmt->execute([$id]);
    }

    public function repairBook($id) {
        $stmt = $this->pdo->prepare("UPDATE books SET status='repair' WHERE id=?");
        $stmt->execute([$id]);
    }
}

=======
<?php

public function searchBooks($keyword) {
    $stmt = $this->pdo->prepare(
        "SELECT * FROM books 
         WHERE title LIKE ? OR author LIKE ?"
    );
    $stmt->execute([
        "%$keyword%",
        "%$keyword%"
    ]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
public function borrowBook($book_id, $member_id) {

    // 1. Vérifier si le livre existe et disponible
    $stmt = $this->pdo->prepare(
        "SELECT * FROM books WHERE id=?"
    );
    $stmt->execute([$book_id]);
    $book = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$book) {
        echo "Livre introuvable\n";
        return;
    }

    if ($book['status'] !== 'available') {
        echo "Livre non disponible\n";
        return;
    }

    // 2. Ajouter emprunt
    $stmt = $this->pdo->prepare(
        "INSERT INTO borrows (book_id, member_id, borrow_date)
         VALUES (?, ?, CURDATE())"
    );
    $stmt->execute([$book_id, $member_id]);

    // 3. Mettre à jour le statut du livre
    $stmt = $this->pdo->prepare(
        "UPDATE books SET status='borrowed' WHERE id=?"
    );
    $stmt->execute([$book_id]);

    echo "Livre emprunté avec succès\n";
}
public function returnBook($book_id, $member_id) {

    // 1. Vérifier s'il y a un emprunt actif
    $stmt = $this->pdo->prepare(
        "SELECT * FROM borrows 
         WHERE book_id=? AND member_id=? AND status='borrowed'"
    );
    $stmt->execute([$book_id, $member_id]);
    $borrow = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$borrow) {
        echo "Aucun emprunt trouvé\n";
        return;
    }

    // 2. Mettre à jour l'emprunt
    $stmt = $this->pdo->prepare(
        "UPDATE borrows 
         SET status='returned', return_date=CURDATE()
         WHERE id=?"
    );
    $stmt->execute([$borrow['id']]);

    // 3. Rendre le livre disponible
    $stmt = $this->pdo->prepare(
        "UPDATE books SET status='available' WHERE id=?"
    );
    $stmt->execute([$book_id]);

    echo "Livre retourné avec succès\n";
}
public function getMemberLoans($member_id) {

    $stmt = $this->pdo->prepare(
        "SELECT 
            books.id,
            books.title,
            books.author,
            borrows.borrow_date,
            borrows.return_date
         FROM borrows
         JOIN books ON books.id = borrows.book_id
         WHERE borrows.member_id=? 
         AND borrows.status='borrowed'"
    );

    $stmt->execute([$member_id]);

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
>>>>>>> origin/member
?>