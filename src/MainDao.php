<?php

namespace App;

use PDO;

class MainDao
{
    private $conn;

    public function __construct(PDO $conn)
    {
        $this->conn = $conn;
    }

    public function getPageContent()
    {
        $sql = 'SELECT * FROM page_content';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function createPageContent($title, $content)
    {
        $sql = 'INSERT INTO page_content (title,content) VALUE (?,?)';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $content]);
    }

    public function deletePageContent($id)
    {
        $sql = 'DELETE FROM page_content WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
    }

    public function updatePageContent($id, $title, $content)
    {
        $sql = 'UPDATE page_content SET title = ?, content = ? WHERE id = ?';
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$title, $content, $id]);
    }

}