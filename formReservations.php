<?php
$username ="adminM";
$password = "pass";

$bdd = null;
try{
    $bdd = new PDO("mysql:host=localhost;dbname=coiffure",$username,$password);
}catch(PDOException $error){
    echo "Erreur lors de la connexion.";
}
/////////////////////////////////////////////////////

// Recupération de toutes les coupes
$coupes = null;
try {
    $stmt = $bdd->query("SELECT * FROM coupe");
    $coupes = $stmt->fetchAll();
} catch (PDOException $e) {
}

// Recupération de tous les soins 
$soins = null;
try {
    $stmt = $bdd->query("SELECT * FROM soin");
    $soins = $stmt->fetchAll();
} catch (PDOException $e) {
}

// Récupération de tous les tarifs 

    $stmt = $bdd->query("SELECT * FROM coupe
    INNER JOIN tarif ON coupe.id_coupe = tarif.id_coupe");
    $coupes = $stmt->fetchAll();

  
    $stmt = $bdd->query("SELECT * FROM soin
    INNER JOIN tarif ON soin.id_soin = tarif.id_soin");
    $soins = $stmt->fetchAll();


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="./styles/global.css">
    <link rel="stylesheet" href="./styles/reservation.css">
    <title>Coiffeur - Réservation</title>
</head>
<body>
    <nav>
        <div class="topnav" id="mainNav">
            <a href="./index.html">Accueil</a>
            <a href="./formReservations.php" class="active">Réservation</a>
            <a href="./coiffure.html">Coiffures</a>
            <a href="#">Tarifs</a>
            <a href="#">Livre d’or</a>
            <a href="./contact.html">Contact</a>
        </div>
        <span id="navIndication"></span>
        <a href="index.html" id="burgerIcon" title="Retourner à l'accueil">
            <svg viewBox="0 0 500 500" xmlns="http://www.w3.org/2000/svg">
                <path d="M125 145.833H229.167C234.692 145.833 239.991 148.028 243.898 151.935C247.805 155.842 250 161.141 250 166.667C250 172.192 247.805 177.491 243.898 181.398C239.991 185.305 234.692 187.5 229.167 187.5H125C119.475 187.5 114.176 185.305 110.269 181.398C106.362 177.491 104.167 172.192 104.167 166.667C104.167 161.141 106.362 155.842 110.269 151.935C114.176 148.028 119.475 145.833 125 145.833V145.833ZM270.833 312.5H375C380.525 312.5 385.824 314.695 389.731 318.602C393.638 322.509 395.833 327.808 395.833 333.333C395.833 338.859 393.638 344.158 389.731 348.065C385.824 351.972 380.525 354.167 375 354.167H270.833C265.308 354.167 260.009 351.972 256.102 348.065C252.195 344.158 250 338.859 250 333.333C250 327.808 252.195 322.509 256.102 318.602C260.009 314.695 265.308 312.5 270.833 312.5ZM125 229.167H375C380.525 229.167 385.824 231.362 389.731 235.269C393.638 239.176 395.833 244.475 395.833 250C395.833 255.525 393.638 260.824 389.731 264.731C385.824 268.638 380.525 270.833 375 270.833H125C119.475 270.833 114.176 268.638 110.269 264.731C106.362 260.824 104.167 255.525 104.167 250C104.167 244.475 106.362 239.176 110.269 235.269C114.176 231.362 119.475 229.167 125 229.167V229.167Z"/>
            </svg>
        </a>
    </nav>
    <main>
        <div class="formSection">
            <div>
                <h2>Nos horaires<br>d'<span class="color">ouverture</span></h2>
                <h4>Ouverture 09:00 - Fermeture 18:30</h4>
            </div>
        <form method="POST" action="reservations.php">
            <div class="row">
                <div class="header">
                    <div class="mainIcon"><i class="fa-solid fa-user"></i></div>
                    <div>
                        <h3>Qui réserve ?</h3>
                        <h4>Remplissez tout les champs ci-dessous. Toutes les informations sont <span class="highlight">requises</span>.</h4>
                    </div>
                </div>
                <div class="inputs">
                    <input type="text" name="firstname" id="firstname" placeholder="Prénom">
                    <input type="text" name="lastname" id="lastname" placeholder="Nom">
                    <input type="tel" name="phone" id="phone" placeholder="Numéro de tel">
                </div>
            </div>
            <div class="row">
                <div class="header">
                    <div class="mainIcon"><i class="fa-solid fa-scissors"></i></div>
                    <div>
                        <h3>Pour quelle prestation ?</h3>
                        <h4>Sélectionnez la prestation souhaitée. La prestation est <span class="highlight">requise</span>.</h4>
                    </div>
                </div>
                <div class="inputs">
                    <div class="select-box">
                       
                        <div class="options-container">
                            <p class="optionTitle">Coupes</p>

                            <?php foreach ($coupes as $index => $coupe): ?>
                                <div class="option">
                                    <input type="radio" class="radio" id="coupe<?= $coupe["id_coupe"]?>" name="coupe" value="<?= $coupe["id_coupe"]?>" />
                                    <label for="coupe<?= $coupe["id_coupe"]?>"><p><?= $coupe["nom_coupe"] ?></p><p><?= $coupe["prix"] ?> €</p></label>
                                </div>
                            <?php endforeach; ?>
                            
                            <span class="separator"></span>
                            
                            <p class="optionTitle">Soins</p>

                            <?php foreach ($soins as $index=> $soin): ?>
                                <div class="option">
                                    <input type="radio" class="radio" id="soin <?= $soin["id_soin"]?>" name="soin" value="soin <?= $soin["id_soin"]?>"/>
                                    <label for="soin <?= $soin["id_soin"]?>"><p><?= $soin["nom_soin"] ?></p><p><?= $soin["prix"] ?> €</p></label>
                                </div>
                            <?php endforeach; ?>
                        </div>
                
                        <div class="selected">
                            <span>Prestations</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                      </div>
                    </div>
                </div>
    
            <div class="row">
                <div class="header">
                    <div class="mainIcon"><i class="fa-solid fa-scissors"></i></div>
                    <div>
                        <h3>Quand voulez-vous réserver ?</h3>
                        <h4>Sélectionnez la date que vous souhaitez. Cette date est <span class="highlight">requise</span>.</h4>
                    </div>
                </div>
                <div class="inputs">
                    <div class="select-box">
                        <div class="options-container">
                            <div class="option">
                                <input type="radio" class="radio" id="date1" name="dateSelect" value="1er Avril 2023, 11:00" />
                                <label for="date1"><p>1er Avril 2023</p><p>11:00</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date2" name="dateSelect" value="1er Avril 2023, 14:00" />
                                <label for="date2"><p>1er Avril 2023</p><p>14:00</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date3" name="dateSelect" value="1er Avril 2023, 16:00"/>
                                <label for="date3"><p>1er Avril 2023</p><p>16:00</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date4" name="dateSelect" value="2 Avril 2023, 11:30"/>
                                <label for="date4"><p>2 Avril 2023</p><p>11:30</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date5" name="dateSelect" value="2 Avril 2023, 15:00"/>
                                <label for="date5"><p>2 Avril 2023</p><p>15:00</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date6" name="dateSelect" value="3 Avril 2023, 09:00"/>
                                <label for="date6"><p>3 Avril 2023</p><p>09:00</p></label>
                            </div>
                            <div class="option">
                                <input type="radio" class="radio" id="date7" name="dateSelect" value="3 Avril 2023, 15:30"/>
                                <label for="date7"><p>3 Avril 2023</p><p>15:30</p></label>
                            </div>
                        </div>
                
                        <div class="selected">
                            <span>Date et heure</span>
                            <i class="fa-solid fa-caret-down"></i>
                        </div>
                      </div>
                    </div>
                </div>
            </div>
            <button  name="submit" type="submit"><i class="fa-solid fa-check"></i>Valider la réservation</button>
        </form>
        </div>
    </main>
    <footer>
        <p class="title">Salon de<br>coiffure</p>
        <div>
            <p>Suivez nous</p>
            <div>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
            </div>
        </div>
    </footer>
    <script src="./scripts/main.js"></script>
</body>
</html>