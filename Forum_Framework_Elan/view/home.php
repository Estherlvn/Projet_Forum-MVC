<?php
    $topics = $result["data"]['topics']; 
?>

<main>

    <section class="homeS1">

        <h1>eQuotidien</h1>
        <h2>Un forum pour tous, qui facilite la vie de chacun</h2>
     
        <?php if (empty($_SESSION['user'])): ?>
        <div id="login">
           <a class="homeButton" href="index.php?ctrl=security&action=login">Connexion</a> 
           <a class="homeButton" href="index.php?ctrl=security&action=register">Inscription</a>
        </div>
        <?php endif; ?>
    </section>




    <section class=homeS1>    
  
    <h3>Liste des derniers topics</h3><br>
    <div class="forumCat">
    <div id="listing">
        <?php if (!empty($topics)) { ?>
            
        <table>
            <thead>
                <tr>
                    <th>Nom du Topic</th>
                    <th>Catégorie</th>
                    <th>Date de Création</th>
                    <th>Auteur</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($topics as $topic) {
                ?>
                    <tr>
                        <td><a href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>"><?= htmlspecialchars($topic->getTopicName()) ?></a></td>
                        <td><?= htmlspecialchars($topic->getCategory()->getCategoryName()) ?></td>
                        <td><?= htmlspecialchars($topic->getTopicDateFormat()) ?></td>
                        <td><?= htmlspecialchars($topic->getMembre()->getPseudo()) ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    <?php } else { ?>
        <p>Aucun topic n'a été trouvé.</p>
    <?php } ?>

        </tbody>
    </table>
    </div>
    </div>
        </section>

</main>