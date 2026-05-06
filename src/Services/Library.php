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

?>