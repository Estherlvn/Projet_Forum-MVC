<?php
    $category = $result["data"]['category']; 
    $topics = $result["data"]['topics']; 
?>

<h1>Liste des topics :</h1>


<?php
foreach($topics as $topic) {
    $topicDate = new DateTime($topic->getTopicDate());
    echo "<p><a href=\"#\">" . $topic->getTopicName() . "</a> par " . 
    $topic->getMembre()->getPseudo() . " créé le " . 
    $topicDate->format('d/m/Y H:i:s') . "</p>";
}
?>
