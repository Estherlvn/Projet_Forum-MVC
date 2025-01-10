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
   $postDate->format('d F Y - H:i') . "</p>";
}
?>

