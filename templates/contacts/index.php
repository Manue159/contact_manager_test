<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <title>Contacts Manager</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- CSS -->
    <link rel="stylesheet" href="/assets/style.css">
</head>

<body>

    <main class="container">
        <h1>Gestion des contacts</h1>

        <section class="filter">

            <!-- Trier par ordre alphabétique -->
            <label for="sort">Trier par :</label>
            <select id="sort" name="sort">
                <option value="asc">Nom A → Z</option>
                <option value="desc">Nom Z → A</option>
            </select>

            <!-- Rechercher par nom, prenom ou email -->
            <label for="search">Rechercher :</label>
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Nom, prénom ou email">

            <!-- Filtre par catégorie -->
            <label for="categorie">Filtrer par catégorie :</label>
            <select id="categorie" name="categorie">
                <option value="">Toutes les catégories</option>
                <?php foreach ($categories as $categorie): ?>
                    <option value="<?= htmlspecialchars($categorie->getId()) ?>">
                        <?= htmlspecialchars($categorie->getLibelle()) ?>
                    </option>
                <?php endforeach; ?>
            </select>
        </section>

        <!-- Liste des contacts -->
        <section id="contact-list">
            <?php require __DIR__ . '/list.php'; ?>
        </section>
    </main>

    <!-- JavaScript -->
    <script src="/assets/contacts.js"></script>

</body>

</html>