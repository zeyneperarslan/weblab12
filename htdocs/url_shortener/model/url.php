<?php
class Url {
    private $db;

    public function __construct() {
        $this->db = Database::getInstance()->getConnection();
    }

    public function findUrlByShortCode($shortCode) {
        $stmt = $this->db->prepare('SELECT * FROM urls WHERE short_code = :short_code');
        $stmt->execute(['short_code' => $shortCode]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function findUrlByLongUrl($longUrl) {
        $stmt = $this->db->prepare('SELECT * FROM urls WHERE long_url = :long_url');
        $stmt->execute(['long_url' => $longUrl]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function insertUrl($longUrl, $shortCode) {
        $stmt = $this->db->prepare('INSERT INTO urls (long_url, short_code) VALUES (:long_url, :short_code)');
        $stmt->execute(['long_url' => $longUrl, 'short_code' => $shortCode]);
        return $this->db->lastInsertId();
    }
}
