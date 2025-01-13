<h1>Connexion</h1>
<form method="POST" action="index.php?ctrl=security&action=login">
    <label for="pseudo">Nom d'utilisateur :</label>
    <input type="text" id="pseudo" name="pseudo" required>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required>

    <button type="submit">Se connecter</button>
</form>
