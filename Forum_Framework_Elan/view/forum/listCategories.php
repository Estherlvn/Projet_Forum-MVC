<?php
    $categories = $result["data"]['categories']; 

?>

<div id="ListCat">
<h1>Liste des catégories</h1>
</div>

<?php
foreach($categories as $category ){ ?>
    <a class= "categoryItem" href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
        <?= $category->getCategoryName() ?></a>

<?php }


  
