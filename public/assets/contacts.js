document.addEventListener("DOMContentLoaded", () => {
    const selectCategorie = document.getElementById("categorie");
    const searchInput = document.getElementById("search");
    const sortSelect = document.getElementById("sort");
    const contactList = document.getElementById("contact-list");

    if (!contactList) return;

    let timeout = null;

    function loadContacts(customParams = null) {
        const params = customParams || new URLSearchParams();

        if (!customParams) {
            if (selectCategorie && selectCategorie.value) {
                params.set('categorie', selectCategorie.value);
            }

            if (searchInput && searchInput.value.trim() !== '') {
                params.set('search', searchInput.value.trim());
            }

            if (sortSelect && sortSelect.value) {
                params.set('sort', sortSelect.value);
            }

            params.set('page', 1);
        }

        window.lastParams = params.toString();

        contactList.innerHTML = '<p class="loading">Chargement...</p>';

        fetch('/contacts/list?' + params.toString())
            .then(r => r.text())
            .then(html => contactList.innerHTML = html);
    }


    contactList.addEventListener("click", (e) => {
        if (e.target.matches(".pagination button")) {
            const page = e.target.dataset.page;
            if (!page) return;

            const params = new URLSearchParams(window.lastParams || "");
            params.set("page", page);

            loadContacts(params);
        }
    });

    if (selectCategorie) {
        selectCategorie.addEventListener("change", loadContacts);
    }

    if (searchInput) {
        searchInput.addEventListener("input", () => {
            clearTimeout(timeout);
            timeout = setTimeout(loadContacts, 300);
        });
    }

    if (sortSelect) {
        sortSelect.addEventListener("change", loadContacts);
    }

    loadContacts(1);
});
