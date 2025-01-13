<h1>Inscription</h1>

<form method="POST" action="index.php?ctrl=security&action=register">
    <label for="pseudo">Nom d'utilisateur :</label>
    <input type="text" id="pseudo" name="pseudo" required>

    <label for="email">Email :</label>
    <input type="email" id="email" name="email" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <label for="confirm_password">Confirmer le mot de passe :</label>
    <input type="password" id="confirm_password" name="confirm_password" required>

    <button type="submit">S'inscrire</button>

</form>
