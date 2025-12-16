<?php

declare(strict_types=1);

use App\Controller\ContactController;

require_once dirname(__DIR__) . '/vendor/autoload.php';

$entityManager = require dirname(__DIR__) . '/config/doctrine.php';

$path = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH) ?? '/';

if ($path === '/') {
    header('Content-Type: text/html; charset=UTF-8');
    echo '<!doctype html><html lang="fr"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width, initial-scale=1">';
    echo '<title>Test technique</title><link rel="stylesheet" href="/assets/style.css"></head><body>';
    echo '<main class="wrap"><h1>Test technique – Gestion de contacts</h1>';
    echo '<p>Point d\'entrée : <a href="/contacts">/contacts</a></p>';
    echo '<p class="muted">Voir README. Aucun code applicatif n\'est fourni (niveau confirmé).</p>';
    echo '</main></body></html>';
    exit;
}

if ($path === '/contacts') {
    (new ContactController())->index();
    exit;
}

if ($path === '/contacts/list') {
    (new ContactController())->list();
    exit;
}

http_response_code(404);
header('Content-Type: text/plain; charset=UTF-8');
echo "404 Not Found";
