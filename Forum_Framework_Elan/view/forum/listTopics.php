<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>


<h1>Liste des topics <br> Catégorie : <?= htmlspecialchars($category->getCategoryName()) ?></h1>

<div class="forumCat">
    <div id="listing">
        <?php
        foreach ($topics as $topic) {
            // Inclure la logique : 0 = ouvert, 1 = fermé
            $isClosed = $topic->getTopicStatus() == 1; // Supposant 0 = ouvert, 1 = fermé
            
            echo "<div class='topicLine'>
                    <a class='title' href=\"index.php?ctrl=forum&action=listPostsByTopic&id=" . $topic->getId() . "\">
                        " . htmlspecialchars($topic->getTopicName()) . "
                    </a>
                    <p class='details'>
                        Créé par " . htmlspecialchars($topic->getMembre()->getPseudo()) . 
                        " le " . $topic->getTopicDateFormat();
            if ($isClosed) {
                echo " <img src='public/img/locked.png' alt='Fermé' title='Ce topic est fermé' class= 'locked-icon'>";
            }
            echo "</p></div>";
        }
        ?>
    </div>
</div>






<div class="forumForm">
    <h2>Créer un nouveau topic</h2>

    <form method="POST" action="index.php?ctrl=forum&action=createTopic">
        <label for="topicName">Nom du Topic</label>
        <input type="text" class="fieldForm" name="topicName" required>
        
        <label for="postContent">Message initial</label>
        <textarea class="areaForm" name="postContent" placeholder="Entrez le contenu du premier message..." required></textarea>
        
        <input type="hidden" name="category_id" value="<?= $category->getId(); ?>">
        <button class='sendButton' type="submit">Créer</button>
    </form>
</div>

</div>