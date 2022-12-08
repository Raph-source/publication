<?php
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion</title>
</head>
<body>
    <?php
        if(count($_POST) == 0){
            //on ne fais rien
        }else{
            if(!empty($_POST['code']) && !empty($_POST['option'])){
                if($_POST['code'] == "1234"){
                    include_once("C:/xampp/htdocs/publication/Model/model.php");
                    $operation = new Operation();
                    if($_POST['option'] == 'débloquerToutEtudiant' || $_POST['option'] == 'bloquerToutEtudiant'){
                        if($_POST['option'] == 'débloquerToutEtudiant'){
                            $operation->debloquerToutEtudiant();
                            echo'<p>Tout les étudiants ont été débloquer</p>';
                        }
                        else if($_POST['option'] == 'bloquerToutEtudiant'){
                            $operation->bloquerToutEtudiant();
                            echo'<p>Tout les étudiants ont été bloquer</p>';
                        }
                    }else{
                        $_SESSION['option'] == $_POST['option'];
                        header('location: unEtudiant.php');
                    }
                }else{
                    echo'Mot de passe incorrecte';
                }
            }else{
                echo'Veulliez remplir tout les champs';
            }
        }
    ?>
</body>
</html>