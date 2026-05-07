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

   

    public function removeBook($id) {
        $stmt = $this->pdo->prepare("DELETE FROM books WHERE id=?");
        $stmt->execute([$id]);
    }

    public function repairBook($id) {
        $stmt = $this->pdo->prepare("UPDATE books SET status='repair' WHERE id=?");
        $stmt->execute([$id]);
    }

     // US5 - Search Book
    // =========================
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

    // =========================
    // US6 - Borrow Book
    // =========================
    public function borrowBook($book_id, $member_id) {

        // check book
        $stmt = $this->pdo->prepare(
            "SELECT * FROM books WHERE id=?"
        );
        $stmt->execute([$book_id]);
        $book = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$book || $book['status'] !== 'available') {
            echo "Livre non disponible\n";
            return;
        }

        // insert borrow
        $stmt = $this->pdo->prepare(
            "INSERT INTO borrows (book_id, member_id, borrow_date)
             VALUES (?, ?, CURDATE())"
        );
        $stmt->execute([$book_id, $member_id]);

        // update book
        $stmt = $this->pdo->prepare(
            "UPDATE books SET status='borrowed' WHERE id=?"
        );
        $stmt->execute([$book_id]);

        echo "Livre emprunté\n";
    }

    // =========================
    // US7 - Return Book
    // =========================
    public function returnBook($book_id, $member_id) {

        $stmt = $this->pdo->prepare(
            "UPDATE borrows 
             SET status='returned', return_date=CURDATE()
             WHERE book_id=? AND member_id=? AND status='borrowed'"
        );
        $stmt->execute([$book_id, $member_id]);

        $stmt = $this->pdo->prepare(
            "UPDATE books SET status='available' WHERE id=?"
        );
        $stmt->execute([$book_id]);

        echo "Livre retourné\n";
    }

    // =========================
    // US8 - Member Loans
    // =========================
    public function getMemberLoans($member_id) {

        $stmt = $this->pdo->prepare(
            "SELECT books.title, books.author, borrows.borrow_date
             FROM borrows
             JOIN books ON books.id = borrows.book_id
             WHERE borrows.member_id=? 
             AND borrows.status='borrowed'"
        );

        $stmt->execute([$member_id]);

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

?>