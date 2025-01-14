<h1>Profil de <?php echo htmlspecialchars($user->getPseudo()); ?></h1>

        <section class="profile-info">

            <h2>Informations du profil</h2>

            <p><strong>Pseudo :</strong> <?php echo htmlspecialchars($user->getPseudo()); ?></p>
            <p><strong>Email :</strong> <?php echo htmlspecialchars($user->getEmail()); ?></p>
            <p><strong>Date d'inscription :</strong> <?php echo htmlspecialchars($user->getRegistrationDate()->format('d/m/Y')); ?></p>
            <p><strong>Rôle :</strong> <?php echo htmlspecialchars($user->getRole()); ?></p>

        </section>

        <section class="profile-actions">
            <a href="index.php?ctrl=security&action=editProfile">Modifier le profil</a>
            <a href="index.php?ctrl=security&action=logout">Se déconnecter</a>
        </section>