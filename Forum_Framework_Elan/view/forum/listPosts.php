<?php
    $topic = $result["data"]['topic'];
    $posts = $result["data"]['posts'];

?>

<h1>Posts pour le topic <?= htmlspecialchars($topic->getTopicName()) ?></h1>

<?php
foreach($posts as $post ) {
   $postDate = new DateTime($post->getPostDate());
   echo "<p><a href=\"#\">" . $post->getPostContent() . "</a> publié par " . 
   $post->getMembre()->getPseudo() . " le " . 
   $postDate->format('d/m/Y - H:i') . "</p>";
}
?>

<h2>Ajouter un nouveau post</h2>
<form action="index.php?ctrl=forum&action=addPost" method="post">
    <textarea name="content" placeholder="Écrivez votre message ici..." required></textarea><br>
    <input type="hidden" name="topic_id" value="<?= htmlspecialchars($topic->getId()) ?>">
    <button type="submit">Poster</button>
</form>
