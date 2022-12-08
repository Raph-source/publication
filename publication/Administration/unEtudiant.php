<?php
    session_start();
    if(count($_POST) == 0){
        //on ne fais rien
    }else{
        if(!empty($_POST['mat']) && !empty($_POST['promo'])){
            include_once("C:/xampp/htdocs/publication/Model/model.php");
            $operation = new Operation();
            if($_SESSION['option'] =='débloquerUnEtudiant'){
                $operation->debloquerUnEtudiant($_POST['mat'], $_POST['promo']);
            }else{
                $operation->bloquerUnEtudiant($_POST['mat'], $_POST['promo']);
            }
        }else{
            echo'Veuillez remplir tout les champs';
        }
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Un étudiant</title>
</head>
<body>
<form method="post">
    <label for="mat">Matricule</label><br>
    <input type="text" name="mat"><br>
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
    <button>Valider</button>
</form>
</body>
</html>