<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

?>
<div class="forumCat">
<h1>Posts pour le topic <?= htmlspecialchars($topic->getTopicName()) ?></h1>
<div id="listing">
<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <?php
            echo "<p class='paraLine'><a class='title' href=\"#\">" . $post->getPostContent() . "</a> publié par " . 
            $post->getMembre()->getPseudo() . " le " . 
            $topic->getTopicDateFormat() . "</p>";
        ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun post trouvé pour ce topic.</p>
<?php endif; ?>


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