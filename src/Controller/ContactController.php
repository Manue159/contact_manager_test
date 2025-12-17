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

        // Inclusion du template principal
        require __DIR__ . '/../../templates/contacts/index.php';
    }

    /**
     * Endpoint AJAX : /contacts/list?categorie=<id>
     */
    public function list(): void
    {
        // Filtre par catégorie
        $categorieId = filter_input(INPUT_GET, 'categorie', FILTER_VALIDATE_INT);
        $categorieId = $categorieId !== false ? $categorieId : null;

        // Recherche texte
        $search = filter_input(INPUT_GET, 'search');
        $search = is_string($search) ? trim($search) : null;
        $search = $search !== '' ? $search : null;

        // Tri
        $sort = filter_input(INPUT_GET, 'sort');
        $sort = $sort === 'desc' ? 'DESC' : 'ASC';

        $page = filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT);
        $page = ($page && $page > 0) ? $page : 1;

        //nombre d'éléments maximum par page
        $limit = 8;
        $offset = ($page - 1) * $limit;

        //appel au repository
        $result = $this->contactRepository->searchPaginated(
            $categorieId,
            $search,
            $sort,
            $limit,
            $offset
        );

        //données envoyées à la vue
        $contacts = $result['data'];

        $total = $result['total'];
        
        $totalPages = (int) ceil($total / $limit);

        $currentPage = $page;

        http_response_code(200);
        header('Content-Type: text/html; charset=utf-8');

        require __DIR__ . '/../../templates/contacts/list.php';
    }
}
