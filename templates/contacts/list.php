<?php if (empty($contacts)): ?>

    <p class="no-result">Aucun contact trouvé.</p>

<?php else: ?>

    <table class="contacts-table">
        <thead>
            <tr>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Email</th>
                <th>Téléphone</th>
                <th>Catégorie</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contacts as $contact): ?>
                <tr>
                    <td><?= htmlspecialchars($contact->getNom()) ?></td>
                    <td><?= htmlspecialchars($contact->getPrenom()) ?></td>
                    <td>
                        <a href="mailto:<?= htmlspecialchars($contact->getEmail()) ?>">
                            <?= htmlspecialchars($contact->getEmail()) ?>
                        </a>
                    </td>
                    <td><?= htmlspecialchars($contact->getTelephone()) ?></td>
                    <td>
                        <?= $contact->getCategorie()
                            ? htmlspecialchars($contact->getCategorie()->getLibelle())
                            : '<em>-</em>' ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

<?php endif;

if (isset($totalPages) && $totalPages > 1): ?>
<nav class="pagination">
    <?php if ($currentPage > 1): ?>
        <button data-page="<?= $currentPage - 1 ?>">‹ Précédent</button>
    <?php endif; ?>

    <?php for ($p = 1; $p <= $totalPages; $p++): ?>
        <button
            data-page="<?= $p ?>"
            class="<?= $p === $currentPage ? 'active' : '' ?>"
        >
            <?= $p ?>
        </button>
    <?php endfor; ?>

    <?php if ($currentPage < $totalPages): ?>
        <button data-page="<?= $currentPage + 1 ?>">Suivant ›</button>
    <?php endif; ?>
</nav>
<?php endif; ?>
