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



    <section class="homeS1">    
    <h3>Liste des derniers topics</h3><br>

    <div class="forumCat">
        <div id="listing">

            <?php foreach ($topics as $topic): ?>
                <div class="topicLine">
                    <a class="title" href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                        <?= htmlspecialchars($topic->getTopicName()) ?>
                    </a>
                    <p class="details">
                        <?= htmlspecialchars($topic->getCategory()->getCategoryName()) ?> |
                        <?= htmlspecialchars($topic->getTopicDateFormat()) ?> |
                        <?= htmlspecialchars($topic->getMembre()->getPseudo()) ?>
                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>


</main>