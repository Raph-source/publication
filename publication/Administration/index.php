<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <form action="gestion.php" method="post">
        <label for="code">Code de l'administrateur</label><br>
        <input type="password" name="code"><br>
        <select name="option" name="option">
            <option value=""></option>
            <optgroup label="Débloquer">
            <option value="débloquerUnEtudiant">Débloquer un étudiant</option>
            <option value="débloquerToutEtudiant">Débloquer tout les étudiant</option>
            <optgroup label="Bloquer">
            <option value="bloquerUnEtudiant">Bloquer un étudiant</option>
            <option value="bloquerToutEtudiant">Bloquer tout les étudiant</option>
        </select><br>
        <button>Valider</button>
    </form>
</body>
</html>