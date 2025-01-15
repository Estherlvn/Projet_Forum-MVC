<?php
$membres = $result["data"]["membres"];
$user = $_SESSION["user"]; // pour s'assurer que l'utilisateur connecté est stocké dans la session
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

                        <!-- si le membre connecté (user de la SESSION en cours) possede le même id, alors l'action 'supprimer' n'apparait pas -->
                        <?php if ($user->getId() !== $membre->getId()): ?>
                            <a href="index.php?ctrl=admin&action=deleteUser&id=<?= $membre->getId() ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce membre ?')">Supprimer</a>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</section>
