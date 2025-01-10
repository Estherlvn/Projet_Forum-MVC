<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics de la catégorie <?= htmlspecialchars($category->getCategoryName()) ?></h1>

<?php
foreach($topics as $topic) {
    $topicDate = new DateTime($topic->getTopicDate());
    echo "<p><a href=\"index.php?ctrl=forum&action=listPostsByTopic&id=" . $topic->getId() . "\">" . 
        htmlspecialchars($topic->getTopicName()) . "</a> créé par " . 
        htmlspecialchars($topic->getMembre()->getPseudo()) . 
        " le " . $topicDate->format('d F Y - H:i') . "</p>";
}
?>
