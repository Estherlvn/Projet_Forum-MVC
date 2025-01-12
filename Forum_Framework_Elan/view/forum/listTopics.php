<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<div class="forumCat">
<h1>Liste des topics de la catégorie <?= htmlspecialchars($category->getCategoryName()) ?></h1>

<div id="listTopic">
<?php
foreach($topics as $topic) {
    $topicDate = new DateTime($topic->getTopicDate());
    echo "<p><a href=\"index.php?ctrl=forum&action=listPostsByTopic&id=" . $topic->getId() . "\">" . 
        htmlspecialchars($topic->getTopicName()) . "</a> créé par " . 
        htmlspecialchars($topic->getMembre()->getPseudo()) . 
        " le " . $topicDate->format('d/m/Y - H:i') . "</p>";
}
?>

<div class="forumForm">
<h2>Créer un nouveau topic</h2>

<form method="POST" action="index.php?ctrl=forum&action=createTopic">
    <label for="topicName">Nom du Topic :</label>
    <input type="text" id="topicName" name="topicName" required>
    
    <input type="hidden" name="category_id" value="<?= $category->getId(); ?>">

    <button type="submit">Créer le Topic</button>
</form>
</div>
</div>