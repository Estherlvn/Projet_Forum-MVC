<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

?>

<h1>TOPIC "<?= htmlspecialchars($topic->getTopicName()) ?>"</h1>

<div class="forumCat">

    <div id="listingPost">
        <?php
        $isFirstPost = true; // Utilisé pour détecter le premier post
        foreach ($posts as $post) {
            echo "<div class='postLine'>
                    <a class='title' href=\"#\">" .
                htmlspecialchars($post->getPostContent()) . "
                    </a>
                <p class='detailPost'>publié par " .
                htmlspecialchars($post->getMembre()->getPseudo()) . " le " .
                $post->getPostDateFormat() . "</p>
            </div>";

            // Afficher le titre après le premier post
            if ($isFirstPost) {
                echo "<h2>Réponses au post initial</h2>";
                $isFirstPost = false; // Ne plus afficher le titre pour les suivants
            }
        }
        ?>
    </div>


    <div class="forumForm">
    <h2>Ajouter un nouveau post</h2>

    <form method="POST" action="index.php?ctrl=forum&action=createPost&topicId=<?= $topic->getId() ?>">

        
        <textarea class="areaForm" name="postContent" placeholder="Écrivez votre message ici..." required></textarea>

        <!-- On passe l'ID du topic comme champ caché -->
        <input type="hidden" name="topic_id" value="<?= $topic->getId() ?>">


        <button class='sendButton' type="submit">Publier</button>
    </form>
    </div>

</div>