<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

?>

<h1>Posts pour le topic <?= htmlspecialchars($topic->getTopicName()) ?></h1>

<?php if (!empty($posts)): ?>
    <?php foreach ($posts as $post): ?>
        <?php
            $postDate = new DateTime($post->getPostDate());
            echo "<p><a href=\"#\">" . $post->getPostContent() . "</a> publié par " . 
            $post->getMembre()->getPseudo() . " le " . 
            $postDate->format('d/m/Y - H:i') . "</p>";
        ?>
    <?php endforeach; ?>
<?php else: ?>
    <p>Aucun post trouvé pour ce topic.</p>
<?php endif; ?>


<h2>Ajouter un nouveau post</h2>

<form method="POST" action="index.php?ctrl=forum&action=createPost&topicId=<?= $topic->getId() ?>">

    
    <textarea name="postContent" placeholder="Écrivez votre message ici..." required></textarea>

    <!-- On passe l'ID du topic comme champ caché -->
    <input type="hidden" name="topic_id" value="<?= $topic->getId() ?>">


    <button type="submit">Créer le post</button>
</form>

