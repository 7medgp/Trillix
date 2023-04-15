<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $conn=mysqli_connect("localhost","root","","trillix");
        if(!($conn)){
            die("Connection failed ". mysqli_connect_error());
        }else{
            $nom= htmlspecialchars($_POST["nom"]) ;
            $prenom= htmlspecialchars($_POST["prenom"]) ;
            $ville= htmlspecialchars($_POST["ville"]) ;
            $tel= htmlspecialchars($_POST["tel"]) ;
            $mail= htmlspecialchars($_POST["email"]) ;
            $mdp= htmlspecialchars($_POST["password"]) ;
            $scp= htmlspecialchars($_POST["scp"]) ;
            if(empty($nom) || empty($prenom) ||empty($ville)||empty($tel)||empty($mail)|| empty($mdp)){
                exit();
                //header("Location: index.php");
            }
            if(password_verify($mdp, $scp)===FALSE){
                ?><script>alert('Please confirm the password');</script><?php
                exit();
                header("Location: signup.html");
            }
            $req="INSERT INTO clients (idclient, nom, prenom, mdp, tel, ville, mail) VALUES (NULL, '$nom', '$prenom', '$mdp', '$tel', '$ville', '$mail')";
            if(mysqli_query($conn,$req)){
                header("Location: index.php");
                
            }   else{
                echo "Error: " . $req . "<br>" . mysqli_error($conn);
            }
        }
        mysqli_close($conn);
    }else{
        header("Location: index.php");
    }
    
?>