<?php
    // Récupérer les membres envoyés depuis le contrôleur
    $membres = $result["data"]['membres']; 
?>

<h1>Liste des membres</h1>

<table>
    <thead>
        <tr>
            <th>Pseudo</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Date d'inscription</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach($membres as $membre): ?>
            <tr>
                <td><?= $membre->getPseudo() ?></td>
                <td><?= $membre->getEmail() ?></td>
                <td><?= $membre->getRole() ?></td>
                <td><?= $membre->getRegistrationDate() ?></td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
