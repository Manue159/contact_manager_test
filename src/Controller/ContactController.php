<?php

namespace App\Controller;

use App\Repository\ContactRepository;
use App\Repository\CategorieRepository;

class ContactController
{
    private ContactRepository $contactRepository;
    private CategorieRepository $categorieRepository;

    public function __construct()
    {
        $this->contactRepository = new ContactRepository();
        $this->categorieRepository = new CategorieRepository();
    }

    /**
     * Affiche la page principale /contacts
     */
    public function index(): void
    {
        // Récupération de toutes les catégories
        $categories = $this->categorieRepository->findAll();

        // Récupération de tous les contacts (sans filtre)
        $contacts = $this->contactRepository->findAllOrdered();

        // Inclusion du template principal
        require __DIR__ . '/../../templates/contacts/index.php';
    }

    /**
     * Endpoint AJAX : /contacts/list?categorie=<id>
     */
    public function list(): void
    {
        $categorieId = filter_input(INPUT_GET, 'categorie', FILTER_VALIDATE_INT);
        $categorieId = $categorieId !== false ? $categorieId : null;

        $search = filter_input(INPUT_GET, 'search');
        $search = is_string($search) ? trim($search) : null;
        $search = $search !== '' ? $search : null;

        $sort = filter_input(INPUT_GET, 'sort');
        $sort = $sort === 'desc' ? 'DESC' : 'ASC';

        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $page = ($page && $page > 0) ? $page : 1;

        $limit = 10;
        $offset = ($page - 1) * $limit;

        $result = $this->contactRepository->searchPaginated(
            $categorieId,
            $search,
            $sort,
            $limit,
            $offset
        );

        $contacts = $result['data'];

        $total = $result['total'];
        
        $totalPages = (int) ceil($total / $limit);

        $currentPage = $page;

        http_response_code(200);
        header('Content-Type: text/html; charset=utf-8');

        require __DIR__ . '/../../templates/contacts/list.php';
    }
}
