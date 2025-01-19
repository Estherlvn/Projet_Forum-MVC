<?php
    $topics = $result["data"]['topics']; 

?>

<h1 id="titleTopic">Liste des Topics</h1>

<div class="forumCat">
    <div id="listing">
        <?php foreach ($topics as $topic): ?>
            <div class="topicLine">
                <a class="title" href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                    <?= htmlspecialchars($topic->getTopicName()) ?>
                </a>
                <p class="details">
                    Créé par 
                    <?= $topic->getMembre() ? htmlspecialchars($topic->getMembre()->getPseudo()) : 'Utilisateur inconnu' ?> 
                    le <?= htmlspecialchars($topic->getTopicDateFormat()) ?>

                    <!-- Condition pour afficher le cadenas si le topic est fermé -->
                    <?php if ($topic->getTopicStatus() == 1): ?> <!-- Si le topic est fermé -->
                        <img src="public/img/locked.png" alt="Topic fermé" class="locked-icon" />
                    <?php endif; ?>
                </p>
            </div>
        <?php endforeach; ?>
    </div>
</div>

