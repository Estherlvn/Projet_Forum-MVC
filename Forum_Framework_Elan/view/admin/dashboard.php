<?php
$membres = $result ["data"]["membres"];
?>

<section class="dashboard">
        <h1>Tableau de bord de l'Admin</h1>
        <h2>Liste des membres</h2>

    <!-- Tableau des membres -->
        <table>
            <thead>
                <tr>
                    <th>Pseudo</th>
                    <th>Email</th>
                    <th>Date d'inscription</th>
                    <th>Rôle</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($membres as $membre): ?>
                    <tr>
                        <td><?= htmlspecialchars($membre->getPseudo()) ?></td>
                        <td><?= htmlspecialchars($membre->getEmail()) ?></td>
                        <td><?= htmlspecialchars($membre->getRegistrationDateformat()) ?></td>
                        <td><?= htmlspecialchars($membre->getRole()) ?></td>
                        <td>
                            <!-- Ajouter des actions comme modifier ou supprimer un membre -->
                            <a href="index.php?ctrl=admin&action=deleteUser&id=<?= $membre->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
