<?php if (empty($contacts)): ?>

    <p class="no-result">Aucun contact trouvé.</p>

<?php else: ?>

    <div class="table-wrapper">
        <table class="contact-table">
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
                        <td><?= htmlspecialchars($contact->getEmail()) ?></td>
                        <td><?= htmlspecialchars($contact->getTelephone()) ?></td>
                        <td class="muted">
                            <?= $contact->getCategorie()
                                ? htmlspecialchars($contact->getCategorie()->getLibelle())
                                : '—'
                            ?>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

<?php endif;

if (isset($totalPages) && $totalPages > 1): ?>
    <nav class="pagination">
        <?php if ($currentPage > 1): ?>
            <button data-page="<?= $currentPage - 1 ?>">‹ Précédent</button>
        <?php endif; ?>

        <?php for ($p = 1; $p <= $totalPages; $p++): ?>
            <button
                data-page="<?= $p ?>"
                class="<?= $p === $currentPage ? 'active' : '' ?>">
                <?= $p ?>
            </button>
        <?php endfor; ?>

        <?php if ($currentPage < $totalPages): ?>
            <button data-page="<?= $currentPage + 1 ?>">Suivant ›</button>
        <?php endif; ?>
    </nav>
<?php endif; ?>