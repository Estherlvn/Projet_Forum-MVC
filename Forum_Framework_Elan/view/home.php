<main>
    <section class=homeS1>

    <h1>eQuotidien</h1>
    <h2>Un forum pour tous, qui facilite la vie de chacun</h2>

    <div id="login">
       <a class="homeButton" href="index.php?ctrl=security&action=login">Connexion</a> 
       <a class="homeButton" href="index.php?ctrl=security&action=register">Inscription</a>
    </div>

    </section>

    <section class=homeS1>
    <h3>Liste des Topics récents</h3>

    <table>
        <thead>
            <tr>
                <th>Nom du Topic</th>
                <th>Catégorie</th>
                <th>Date de Création</th>
                <th>Auteur</th>
            </tr>
        </thead>
    
    <?php foreach ($topics as $topic): ?>
    <tr>
        <!-- Lien vers les posts du topic avec l'ID du topic -->
        <td><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= htmlspecialchars($topic->getTopicName()) ?></a></td>
        <td><?= htmlspecialchars($topic->getCategory()->getName()) ?></td>
        <td><?= htmlspecialchars($topic->getCreationDate()->format('Y-m-d H:i')) ?></td>
        <td><?= htmlspecialchars($topic->getMembre()->getPseudo()) ?></td>
    </tr>
<?php endforeach; ?>




        </tbody>
    </table>

    </section>

</main>