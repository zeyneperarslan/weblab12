<?php
class Router {
    public function direct($uri) {
        if ($uri === '/') {
            (new UrlController())->index();
        } elseif ($_SERVER['REQUEST_METHOD'] === 'POST' && $uri === '/create') {
            (new UrlController())->createShortUrl();
        } else {
            $shortCode = ltrim($uri, '/');
            (new UrlController())->redirect($shortCode);
        }
    }
}
