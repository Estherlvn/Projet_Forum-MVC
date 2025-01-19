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

        <img id="imgBrico" src="/Projet_Forum-MVC/Forum_Framework_Elan//public/img/bricolage.png" alt="Bricolage">

<?php }


  
