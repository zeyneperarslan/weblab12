<?php
class UrlController {
    private $urlModel;

    public function __construct() {
        $this->urlModel = new Url();
    }

    public function index() {
        require __DIR__ . '/../view/index.php';
    }

    public function createShortUrl() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['long_url'])) {
            $longUrl = trim($_POST['long_url']);
            if ($this->validateUrl($longUrl)) {
                $existingUrl = $this->urlModel->findUrlByLongUrl($longUrl);
                if ($existingUrl) {
                    $shortUrl = $this->generateShortUrl($existingUrl['short_code']);
                } else {
                    $shortCode = $this->generateUniqueShortCode();
                    $this->urlModel->insertUrl($longUrl, $shortCode);
                    $shortUrl = $this->generateShortUrl($shortCode);
                }
                require __DIR__ . '/../view/short_url.php';
            } else {
                $error = 'Invalid URL format.';
                require __DIR__ . '/../view/error.php';
            }
        } else {
            $this->index();
        }
    }

    public function redirect($shortCode) {
        $urlData = $this->urlModel->findUrlByShortCode($shortCode);
        if ($urlData) {
            header('Location: ' . $urlData['long_url']);
            exit;
        } else {
            $error = 'Short URL not found.';
            require __DIR__ . '/../view/error.php';
        }
    }

    private function validateUrl($url) {
        return filter_var($url, FILTER_VALIDATE_URL);
    }

    private function generateShortUrl($shortCode) {
        $config = require __DIR__ . '/../config/config.php';
        return $config['base_url'] . '/' . $shortCode;
    }

    private function generateUniqueShortCode() {
        do {
            $shortCode = $this->generateRandomString();
        } while ($this->urlModel->findUrlByShortCode($shortCode));

        return $shortCode;
    }

    private function generateRandomString($length = 12) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ-_';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[random_int(0, $charactersLength - 1)];
        }
        return $randomString;
    }
}
