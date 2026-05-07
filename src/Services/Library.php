<?php

class Library {

    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    // SEARCH BOOKS (US5)
    public function searchBooks($keyword) {

        $stmt = $this->pdo->prepare("
            SELECT * FROM books
            WHERE title LIKE ? OR author LIKE ?
        ");

        $stmt->execute([
            "%$keyword%",
            "%$keyword%"
        ]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // BORROW BOOK (US6)
    public function borrowBook($book_id, $member_id) {

        $stmt = $this->pdo->prepare("SELECT * FROM books WHERE id=?");
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

        $this->pdo->prepare("
            INSERT INTO borrows (book_id, member_id, borrow_date)
            VALUES (?, ?, CURDATE())
        ")->execute([$book_id, $member_id]);

        $this->pdo->prepare("
            UPDATE books SET status='borrowed' WHERE id=?
        ")->execute([$book_id]);

        echo "Livre emprunté avec succès\n";
    }

    // RETURN BOOK (US7)
    public function returnBook($book_id, $member_id) {

        $stmt = $this->pdo->prepare("
            SELECT * FROM borrows
            WHERE book_id=? AND member_id=? AND status='borrowed'
        ");

        $stmt->execute([$book_id, $member_id]);
        $borrow = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$borrow) {
            echo "Aucun emprunt trouvé\n";
            return;
        }

        $this->pdo->prepare("
            UPDATE borrows
            SET status='returned', return_date=CURDATE()
            WHERE id=?
        ")->execute([$borrow['id']]);

        $this->pdo->prepare("
            UPDATE books SET status='available' WHERE id=?
        ")->execute([$book_id]);

        echo "Livre retourné avec succès\n";
    }

    // MY LOANS (US8)
    public function getMemberLoans($member_id) {

        $stmt = $this->pdo->prepare("
            SELECT books.id, books.title, books.author,
                   borrows.borrow_date, borrows.return_date
            FROM borrows
            JOIN books ON books.id = borrows.book_id
            WHERE borrows.member_id=?
            AND borrows.status='borrowed'
        ");

        $stmt->execute([$member_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}