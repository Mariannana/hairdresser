<?php
$username ="adminM";
$password = "pass";


//Connexion
$bdd = null;
try{
    $bdd = new PDO("mysql:host=localhost;dbname=coiffure",$username,$password);
}catch(PDOException $error){
    echo "Erreur lors de la connexion.";
}


// Recupération de toutes les coupes

// $stmt = $bdd->query("SELECT reservation.*, nom_coiffure, prix
// FROM reservation
// JOIN proposer ON reservation.id_reservation = proposer.id_reservation
// JOIN coiffure ON proposer.id_coupe = coupe.id_coupe
// JOIN tarif ON coiffure.id_tarif = prix.id_
// WHERE reservation.id_reservation = :id_reservation")


// $stmt = $bdd->query("SELECT coupe.nom_coupe, tarif.prix FROM coupe
// INNER JOIN tarif ON coupe.id_coupe = tarif.id_coupe");
// $coupes = $stmt->fetchAll();


// $stmt = $bdd->query("SELECT soin.nom_soin, tarif.prix FROM soin
// INNER JOIN tarif ON soin.id_soin = tarif.id_soin");
// $soins = $stmt->fetchAll();



// // Jointure entre les tables "reservation" et "proposer" sur la clé étrangère "id_reservation"
// $stmt = $bdd->query("SELECT reservation.*, proposer.id_coupe
//                      FROM reservation
//                      INNER JOIN proposer ON reservation.id_reservation = proposer.id_reservation");
// $reservations = $stmt->fetchAll();

// // Jointure entre les tables "proposer" et "coupe" sur la clé étrangère "id_coupe"
// $stmt = $bdd->query("SELECT proposer.*, coupe.nom_coupe, coupe.id_tarif
//                      FROM proposer
//                      INNER JOIN coupe ON proposer.id_coupe = coupe.id_coupe");
// $proposers = $stmt->fetchAll();

// // Jointure entre les tables "coupe" et "tarif" sur la clé étrangère "id_tarif"
// $stmt = $bdd->query("SELECT coupe.*, tarif.prix
//                      FROM coupe
//                      INNER JOIN tarif ON coupe.id_tarif = tarif.id_tarif");
// $coupes = $stmt->fetchAll();


// $stmt = $bdd->query("SELECT proposer.*, coupe.nom_coupe, tarif.prix
//                     FROM proposer
//                     INNER JOIN coupe ON proposer.id_coupe = coupe.id_coupe
//                     INNER JOIN tarif ON coupe.id_tarif = tarif.id_tarif");
//             $coupes = $stmt->fetchAll();


$stmt = $bdd->prepare("SELECT reservation.*, nom_coupe, prix
FROM reservation
JOIN proposer ON reservation.id_reservation = proposer.id_reservation
JOIN coupe ON proposer.id_coupe = coupe.id_coupe
JOIN tarif ON coupe.id_tarif = tarif.id_tarif
WHERE reservation.id_reservation = :id_reservation ");





// $id_reservation = 1;
// $stmt = $bdd->prepare("SELECT reservation.*, nom_coupe, prix
// FROM reservation
// JOIN proposer ON reservation.id_reservation = proposer.id_reservation
// JOIN coupe ON proposer.id_coupe = coupe.id_coupe
// JOIN tarif ON coupe.id_tarif = tarif.id_tarif
// WHERE reservation.id_reservation = :id_reservation");
// $stmt->bindValue(":id_reservation", $id_reservation, PDO::PARAM_INT);
// $stmt->execute();

 
    //Connexion----------------------------//
    // $username = "adminM";
    // $password = "pass";
    // $bdd = null;
    // $iserror_bdd = false;
    // try{
    //     $bdd = new PDO("mysql:host=localhost;dbname=coiffure",$username,$password);
    // }catch(PDOException $error){
    // }
    // //-------------------------------------//
    // // Jointures entre les tables...
    // $stmt = $bdd->prepare("SELECT reservation.*, nom_coupe, prix
    //     FROM reservation
    //     JOIN proposer ON reservation.id_reservation = proposer.id_reservation
    //     JOIN coupe ON proposer.id_coupe = coupe.id_coupe
    //     JOIN tarif ON coupe.id_tarif = tarif.id_tarif
    //     WHERE reservation.id_reservation = :id_reservation ");


    // // if (isset($_POST["lastname"], $_POST["firstname"] && isset($_POST["submit"]))) {
    //     if (isset($_POST["submit"])) {
    //     // Récupérer les données du formulaire
    //     $nom = $_POST["lastname"];
    //     $prenom = $_POST["firstname"];
    //     $telephone = $_POST["phone"];
    //     $coupe = $_POST["coupe"];
    //     $dateHeure = $_POST["dateSelect"]
      
    //     //prepare
    //     $sql = "INSERT INTO reservation (id_reservation, nom, prenom, telephone, id_coupe, date_heure) VALUES (NULL, :nom, :prenom, :telephone, :id_coupe, :date_heure)"; 
    //     $stmt = $bdd->prepare($sql);
    //     //bindParam
    //     $stmt->bindParam(":nom",$nom);
    //     $stmt->bindParam(":prenom",$prenom);
    //     $stmt->bindParam(":telephone",$telephone);
    //     $stmt->bindParam(":id_coupe",$coupe);
    //     $stmt->bindParam(":date_heure",$dateHeure);
      
   
    //     //execute
    //     $stmt->execute();
    
    //     header("Location: http://localhost/coiffure/contactsuccess.html");
    //     exit;
    // }
?>

