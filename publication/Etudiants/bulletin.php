<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bulletin</title>
</head>
<body>
    <?php
        if(!empty($_POST['mat']) && !empty($_POST['promo']) && !empty($_POST['code'])){
            if(preg_match('#^[0-9]{2}[a-zA-Z]{2}[0-9]{3}$#', $_POST['mat'])){
                include_once("C:/xampp/htdocs/publication/Model/model.php");
                $etudiant = new Etudiant($_POST['mat'], $_POST['promo'], $_POST['code']);
                
                if($etudiant->verification()){
                    $etudiant->showBulletin();
                }else{
                    echo"<p>Veuillez revoir le matricule ou le code de sécurité introduit <br>
                            S'ils sont correctent, ressurez vous d'avoir payé tout le frais acdemiques afin d'acceder aux resultat!!!<br>
                            Merci 
                        </p><br>
                        <a href='index.php'><button>Retour</buttom></a>";
                }
            }else{
                echo'Verifier votre matriculce';
            }
            
        }else{
            echo'Veuillez remplir tout les champs';
        }
    ?>
</body>
</html>