<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>

    <style>
        .formulaire{
            padding-top: 20%;
            padding-left: 20%;
        }
    </style>
</head>
<body>
    <form action="bulletin.php" method="post" class="formulaire">
        <p>Formulaire de connexion</p>
        <input type="text" name="mat" placeholder="Matriclule"><br>
        <select name="promo">
            <option value=""></option>
            <optgroup label="Préparaoire">
            <option value="PREPA">PREPA</option>
            <optgroup label="Première licence">
            <option value="L1">L1</option>
            <optgroup label="Deuxième licence">
            <option value="L2 SI">L2 SI</option>
            <option value="L2 MSI">L2 MSI</option>
            <option value="L2 DSG"> L2 DSG</option>
            <option value="L2 AS">L2 AS</option>
            <option value="L2 TLC">L2 TLC</option>
            <optgroup label="Troisième licence">
            <option value="L3 SI">L3 SI</option>
            <option value="L3 MSI">L3 MSI</option>
            <option value="L3 DSG"> L3 DSG</option>
            <option value="L3 AS">L3 AS</option>
            <option value="L3 TLC">L3 TLC</option>
        </select><br>
        <input type="password" name="code" placeholder="Code de sécurité" ><br>
        <button>Valider</button>
    </form>
</body>
</html>