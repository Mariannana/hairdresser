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
    
    if(isset($_POST["submit"])){
        
        $nom = $_POST["nom"];
        $email= $_POST["email"];   
        $telephone= $_POST["telephone"];   
        $message= $_POST["message"];   
     
        //prepare
        $sql = "INSERT INTO contact (id_contact, nom_contact, email_contact, telephone_contact, message_contact) VALUES (NULL, :nom_contact, :email_contact, :telephone_contact, :message_contact)";
        $stmt = $bdd->prepare($sql);
        //bindParam
        $stmt->bindParam(":nom_contact",$nom);
        $stmt->bindParam(":email_contact",$email);
        $stmt->bindParam(":telephone_contact",$telephone);
        $stmt->bindParam(":message_contact",$message);
        //execute
        $stmt->execute();
        echo "<script>alert(\"Message bien envoyé!\")</script>";
        exit();
    }