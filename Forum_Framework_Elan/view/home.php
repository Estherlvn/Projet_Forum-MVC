<?php
    $topics = $result["data"]['topics']; 
    $categories = $result["data"]['categories']; 
?>

<main>

    <section class="homeS1">

        <h1>eQuotidien</h1>
        <h2>Un forum pour tous, qui facilite la vie de chacun</h2>
        <img id="imgVoiture" src="/Projet_Forum-MVC/Forum_Framework_Elan/public/img/voiture.png" alt="Voiture">

     
        <?php if (empty($_SESSION['user'])): ?>
    <div id="login">
       <a class="homeButton" href="index.php?ctrl=security&action=login">Connexion</a> 
       <a class="homeButton" href="index.php?ctrl=security&action=register">Inscription</a>
    </div>
<?php else: ?>
    <div id="login">
       <p id="bienvenue">Bienvenue, <?= htmlspecialchars($_SESSION['user']->getPseudo()) ?> !</p>
    </div>
<?php endif; ?>




    </section>

    <section class="sectionCat">
    
        <?php
        foreach($categories as $category ){ ?>
        <a class= "homeCat" href="index.php?ctrl=forum&action=listTopicsByCategory&id=<?= $category->getId() ?>">
            <?= $category->getCategoryName() ?></a>

        <?php }
         ?>

    </section>


    <section class="homeS1">    
    <h3>Les derniers topics</h3><br>

    <div class="forumCat">
        <div id="listing">

            <?php foreach ($topics as $topic): ?>
                <div class="topicLine">
                    <a class="title" href="index.php?ctrl=forum&action=listPostsByTopic&id=<?= $topic->getId() ?>">
                        <?= htmlspecialchars($topic->getTopicName()) ?>
                    </a>
                    <p class="details">
                        <?= htmlspecialchars($topic->getCategory()->getCategoryName()) ?> |
                        <?= htmlspecialchars($topic->getTopicDateFormat()) ?> |
                        <?= htmlspecialchars($topic->getMembre()->getPseudo()) ?> |

                        <!-- Condition pour afficher un cadenas si le topic est fermé -->
                        <?php if (!$topic->isOpen()): ?>
                            <img src="public/img/locked.png" alt="Topic fermé" class="locked-icon" />
                        <?php endif; ?>

                    </p>
                </div>
            <?php endforeach; ?>

        </div>
    </div>
</section>





</main>