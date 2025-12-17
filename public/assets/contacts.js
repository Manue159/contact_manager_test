document.addEventListener("DOMContentLoaded", () => {
    // Récupération des éléments du DOM
    const selectCategorie = document.getElementById("categorie");
    const searchInput = document.getElementById("search");
    const sortSelect = document.getElementById("sort");
    const contactList = document.getElementById("contact-list");

    if (!contactList) return;

    let timeout = null;

    //chargement des contacts selon la demande: filtre sur catégorie, tri ou recherche
    function loadContacts(customParams = null) {
        const params = new URLSearchParams();

        // Filtre catégorie
        if (selectCategorie && selectCategorie.value) {
            params.set('categorie', selectCategorie.value);
        }

        // Recherche
        if (searchInput && searchInput.value.trim() !== '') {
            params.set('search', searchInput.value.trim());
        }

        // Tri
        if (sortSelect && sortSelect.value) {
            params.set('sort', sortSelect.value);
        }

        // Pagination
        if (customParams instanceof URLSearchParams && customParams.get('page')) {
            params.set('page', customParams.get('page'));
        } else {
            params.set('page', 1);
        }

        window.lastParams = params.toString();

        contactList.innerHTML = '<p class="loading">Chargement...</p>';

        fetch('/contacts/list?' + params.toString())
            .then(r => r.text())
            .then(html => contactList.innerHTML = html);
    }


    //gestion des clics de la pagination
    contactList.addEventListener("click", (e) => {
        if (e.target.matches(".pagination button")) {
            const page = e.target.dataset.page;
            if (!page) return;

            const params = new URLSearchParams(window.lastParams || "");
            params.set("page", page);

            loadContacts(params);
        }
    });

    //Ecoute du changement de catégorie
    if (selectCategorie) {
        selectCategorie.addEventListener("change", loadContacts);
    }

    //Ecoute du changement de critère de recherche
    if (searchInput) {
        searchInput.addEventListener("input", () => {
            clearTimeout(timeout);
            timeout = setTimeout(loadContacts, 300);
        });
    }

    //Ecoute du changement d'ordre de tri
    if (sortSelect) {
        sortSelect.addEventListener("change", loadContacts);
    }

    //Chargement initial de la liste au chargement de la page
    loadContacts();
});
