<?php
    session_start();
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
            if(empty($nom) || empty($prenom) ||empty($ville)||empty($tel)||empty($mail)|| empty($mdp)){
                exit();
                //header("Location: index.php");
            }
            $id_client=$_SESSION['id'];
            $req_up="UPDATE clients SET nom='$nom', prenom='$prenom', mail='$mail', ville='$ville', tel='$tel', mdp='$mdp'  WHERE idclient='$id_client'";
            if(mysqli_query($conn,$req_up)){
                ?>  
                <script>alert("Saved");</script>
                <?php
                $req_se="SELECT * FROM clients WHERE idclient='$id_client'";
                $res=mysqli_fetch_assoc(mysqli_query($conn,$req_se));
                session_unset();
                $_SESSION['id']=$res['idclient'];
                $_SESSION['prenom']=$res['prenom'];
                $_SESSION['mail']=$res['mail'];
                $_SESSION['mdp']=$res['mdp'];
                $_SESSION['ville']=$res['ville'];
                $_SESSION['tel']=$res['tel'];
                header("Location: index.php");
            }
        }
        mysqli_close($conn);
    }else{
        header("Location: index.php");
    }  
?>