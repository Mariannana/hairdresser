<?php
    //Connexion----------------------------//
    $username = "adminM";
    $password = "pass";
    $bdd = null;
    $iserror_bdd = false;
    try{
        $bdd = new PDO("mysql:host=localhost;dbname=coiffure",$username,$password);
    }catch(PDOException $error){
    }
    //-------------------------------------//
    // Jointures entre les tables...
    $stmt_join = $bdd->prepare("SELECT reservation.*, nom_coupe, prix
        FROM reservation
        JOIN proposer ON reservation.id_reservation = proposer.id_reservation
        JOIN coupe ON proposer.id_coupe = coupe.id_coupe
        JOIN tarif ON coupe.id_tarif = tarif.id_tarif
        WHERE reservation.id_reservation = :id_reservation ");

    // Vérifier si le formulaire a été soumis
    if (isset($_POST["submit"])) {
        // Récupérer les données du formulaire

        $nom = $_POST["lastname"];
        $prenom = $_POST["firstname"];
        $telephone = $_POST["phone"];
        $coupe = $_POST["coupe"];
        $dateHeure = $_POST["dateSelect"];
        
    
        // // Convertir la date et l'heure en format DATETIME
        $dateTime = date('Y-m-d H:i:s', strtotime($dateHeure));

        // Préparer la requête d'insertion de données
        $sql = "INSERT INTO reservation (nom, prenom, telephone, id_coupe, date_heure) VALUES (:nom, :prenom, :telephone, :id_coupe, :date_heure)"; 
        $stmt = $bdd->prepare($sql);

        // Associer les valeurs aux paramètres
        $stmt->bindParam(":nom",$nom);
        $stmt->bindParam(":prenom",$prenom);
        $stmt->bindParam(":telephone",$telephone);
        $stmt->bindParam(":id_coupe",$coupe);
        $stmt->bindParam(":date_heure",$dateTime);

        // Exécuter la requête
        $stmt->execute();
        header("Location: http://localhost/coiffure/contactsuccess.html");
        echo "<script>alert(\"La réservation est confirmée!\")</script>";
        exit;
    }
?>

 

