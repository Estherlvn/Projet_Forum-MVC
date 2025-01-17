<?php
$user = $result ["data"]["user"];
?>

<h1>Profil de <?php echo htmlspecialchars($user->getPseudo()); ?></h1>

    <div class='profileSection'>

            <h2>Informations du profil</h2>

            <div class='profileDetails'>
            <p class='details'><strong>Pseudo :</strong> <?php echo htmlspecialchars($user->getPseudo()); ?></p>
            <p class='details'><strong>Email :</strong> <?php echo htmlspecialchars($user->getEmail()); ?></p>
            <p class='details'><strong>Date d'inscription :</strong> <?php echo htmlspecialchars($user->getRegistrationDateFormat()); ?></p>
            <p class='details'><strong>Rôle :</strong> <?php echo htmlspecialchars($user->getRole()); ?></p>

 
        </div>
        
        <section class="profileLink">

            <?php if ($user->getRole() === 'ROLE_ADMIN'): ?>
        <a href="index.php?ctrl=admin&action=dashboard">Tableau de bord</a>
            <?php endif; ?>
        <a href="index.php?ctrl=security&action=logout">Se déconnecter</a>

            </section>
            
    </div>