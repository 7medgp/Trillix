<?php
    if($_SERVER["REQUEST_METHOD"]=="POST"){
        $conn=mysqli_connect("localhost","root","","trillix");
        if(!($conn)){
            die("Connection failed ". mysqli_connect_error());
        }else{
            $mail= htmlspecialchars($_POST["email"]) ;
            $mdp= htmlspecialchars($_POST["password"]) ;
            
            if(empty($mail)|| empty($mdp)){
                exit();
                //header("Location: index.php");
            }
            $req="SELECT * from clients where mail='$mail' and mdp='$mdp'";
            $res1=mysqli_query($conn,$req);
            if(mysqli_num_rows($res1)===1){
                $res=mysqli_fetch_assoc($res1);
                session_start();
                $_SESSION['nom']=$res['nom'];
                $_SESSION['id']=$res['idclient'];
                $_SESSION['prenom']=$res['prenom'];
                $_SESSION['mail']=$res['mail'];
                $_SESSION['mdp']=$res['mdp'];
                $_SESSION['ville']=$res['ville'];
                $_SESSION['tel']=$res['tel'];
                ?>
                <script>
                    alert('You are now connected');
                    window.location.href = "index.php";
                </script>
                <?php
                
            }else{
                $reqmail="SELECT * from clients where mail='$mail'";
                if(mysqli_num_rows(mysqli_query($conn,$reqmail))===1){
                    ?>
                    <script type="text/javascript"> 
                        alert('wrong password'); 
                        window.location.href = "login.html";
                    </script>
                    <?php
                }else{
                    
                    ?>
                    <script type="text/javascript"> 
                        alert('You are not registred'); 
                        window.location.href = "signup.html";
                    </script>
                    <?php
                }

                
            }
        }
        mysqli_close($conn);
    }else{
        header("Location: index.php");
    }  
?>
