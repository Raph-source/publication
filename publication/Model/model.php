<?php
    //cette classe permet d'affcher le bulletin d'un étudiant et vérifier qu'il est en ordre ou pas
    class Etudiant{
        private $mat;
        private $promo;
        private $code;

        public function __construct($mat, $promo, $code){
            $this->mat = $mat;
            $this->promo = $promo;
            $this->code = $code;
        }

        //cette méthode permet verifier si un étudiant est en ordre
        public function verification(){
            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }
            $requette = $base->prepare('SELECT * FROM t_etudiant WHERE matEtd = ? AND promoEtd = ? AND code = ?');
            $requette->execute(array($this->mat, $this->promo, $this->code));

            return $requette->fetch();
        }

        //cette méthode permet d'afficher le bulletin d'un étudiant
        public function showBulletin(){
            //ces variables permetront d'afficher le footer du bulletin
            $uniteNonValides = 0;
            $uniteDefaillantes = 0;
            $totauxUnite = 0;
            $totalPonderation = 0;
            $mention;

            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }

            //affichage du header du bulletin
            $requette = $base->prepare('SELECT nomEtd, postNomEtd, prenomEtd FROM t_etudiant WHERE matEtd = ? AND
            promoEtd = ? AND code = ?');
            $requette->execute(array($this->mat, $this->promo, $this->code));

            $donnee = $requette->fetch();
            echo'<table>
                    <thead>
                        <tr>
                            <td>'.$donnee['nomEtd']. ' '. $donnee['postNomEtd'].' '.$donnee['prenomEtd'].'<br'.
                            $this->mat.'</td>
                        </tr>
                        <tr>
                            <th>Cours</th>
                            <th>Credit horaire</th>
                            <th>Ponderation</th>
                            <th>Moyenne</th>
                            <th>Session</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>';
            //affichage du body du bulletin
            for($i = 1; $i <= 8; $i++){
                if($i == 1){$unite = 'unite';}
                if($i == 2){$unite = 'unite';}
                if($i == 3){$unite = 'unite';}
                if($i == 4){$unite = 'unite';}
                if($i == 5){$unite = 'unite';}
                if($i == 6){$unite = 'unite';}
                if($i == 7){$unite = 'unite';}
                if($i == 8){$unite = 'unite';}

                $requette = $base->prepare('SELECT * FROM t_etudiants AS e INNER JOIN t_bulletin AS b ON
                e.idBull = b.idBull INNER JOIN t_cours AS c ON b.idBull = c.idBull WHERE matEtd = ? AND promoEtd = ?
                AND unite = ?');
                $requette->execute(array($this->mat, $this->promo, $unite));

                $ponderationUnite = 0;
                $creditUnite = 0;
                $totalUnite = 0;
                while($donnee = $requette->fetch()){
                    //recherche des unités défaillantes
                    if($donnee['session'] === NULL || $donnee['moyenne'] === NULL){
                        $uniteDefaillantes += 1;
                    }

                    echo'<tr>
                            <td>'.$donnee['cours'].'</td>
                            <td>'.$donnee['credit'].'</td>
                            <td>'.$donnee['ponderation'].'</td>
                            <td>'.$donnee['moyenne'].'</td>
                            <td>'.$donnee['session'].'</td>
                            <td>'.$donnee['moyenne'] + $donnee['session'].'</td>
                        </tr>';

                    $totalUnite += ($donnee['moyenne'] + $donnee['session']) / $donnee['ponderation'];
                }

                $totauxUnite += $totalUnite;
                $totalPonderation += $ponderationUnite;
                //recherche des unités non valides
                if($totalUnite < 10){
                    $uniteNonValides += 1;
                }
                
            }

            //atribution de la mention
            if(($totauxUnite / $totalPonderation) >= 16){
                $mention = 'TB';
            }
            else if(($totauxUnite / $totalPonderation) >= 14 && ($totauxUnite / $totalPonderation) >= 15.9){
                $mention = 'B';
            }
            else if(($totauxUnite / $totalPonderation) >= 12 && ($totauxUnite / $totalPonderation) >= 13.9){
                $mention = 'AB';
            }
            else if(($totauxUnite / $totalPonderation) >= 10 && ($totauxUnite / $totalPonderation) >= 11.9){
                $mention = 'P';
            }
            else{
                $mention = 'E';
            }

            //affichage du footer du bulletin
            echo            '<tr>
                                <td>Unités défaillantes</td>
                                <td> </td>
                                <td> </td>
                                <td>'.$uniteDefaillantes.'</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td>Unités non valides</td>
                                <td> </td>
                                <td> </td>
                                <td>'.$uniteNonValides.'</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td>Points obtenus</td>
                                <td> </td>
                                <td> </td>
                                <td>'.$totauxUnite / $totalPonderation.'</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                            <tr>
                                <td>Mention</td>
                                <td> </td>
                                <td> </td>
                                <td>'.$mention.'</td>
                                <td> </td>
                                <td> </td>
                            </tr>
                    </tbody>
                </table>';
        }
    }

    //cette classe permet de bloquer ou de débloquer les étudiants
    class Operation{
        //cette méthode permet de débloquer un étudiant
        public function debloquerUnEtudiant($mat, $promo){
            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }

            $requette = $base->prepare('UPDATE t_etudiant SET etatEtd = "en ordre" WHERE matEtd = ? AND promoEtd = ?');
            $requette->execute(array($mat, $promo));
        }

        //cette méthode permet de bloquer un étudiant
        public function bloquerUnEtudiant($mat, $promo){
            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }
            
            $requette = $base->prepare('UPDATE t_etudiant SET etatEtd = "non en ordre" WHERE matEtd = ? AND
            promoEtd = ?');
            $requette->execute(array($mat, $promo));
        }

        //cette méthode permet de débloquer tout les étudiants
        public function debloquerToutEtudiant(){
            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }
            
            $requette = $base->query('UPDATE t_etudiant SET etatEtd = "en ordre" WHERE
            matETd REGEXP "^[0-9]{2}[a-zA-Z]{2}[0-9]{3}$" ');
         
        }

        //cette méthode permet de bloquer tout les étudiants
        public function bloquerToutEtudiant(){
            try{
                $base = new PDO('mysql:host=localhost;dbname=publication;', 'root', '');
            }catch(Exeception $e){
                echo'Erreur de la connexion à la base des données'.$e->getMessage();
            }
            
            $requette = $base->query('UPDATE t_etudiant SET etatEtd = "non en ordre" WHERE
            matETd REGEXP "^[0-9]{2}[a-zA-Z]{2}[0-9]{3}$" ');
         
        }
    }