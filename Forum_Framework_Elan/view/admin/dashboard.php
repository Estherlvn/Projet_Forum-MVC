<?php
$users = $result ["data"]["users"];
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
                <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= htmlspecialchars($user->getPseudo()) ?></td>
                        <td><?= htmlspecialchars($user->getEmail()) ?></td>
                        <td><?= htmlspecialchars($user->getRegistrationDateformat()->format) ?></td>
                        <td><?= htmlspecialchars($user->getRole()) ?></td>
                        <td>
                            <!-- Ajouter des actions comme modifier ou supprimer un membre -->
                            <a href="index.php?ctrl=admin&action=deleteUser&id=<?= $user->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">Supprimer</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </section>
</main>
