<?php
     $themeClass = '';
     if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
         $themeClass = 'dark-theme';
         $btnIcon="img/bxs-sun.png";
         $btntext="Light";
        
     }else{
         $btnIcon="img/bxs-moon (1).png";
         $btntext="Dark";
         
     }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../css-sheets/stylesignup.css">
    <link rel="stylesheet" href="../css-sheets/stylegeneral.css">
    <link rel="icon" href="img/Untitled-1.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="../file-js/alert.js"></script>
    <title>Trillix</title>
</head>
<body class="<?php echo $themeClass; ?>">
    <div class="toggle-btn" id="btn">
        <span id="btntext"><?php echo $btntext; ?></span>
        <img src="<?php echo $btnIcon; ?>" id="btnIcon" alt="">
    </div>
 
    <section class="signup-login">
      <div class="container">
        <div class="line">
          <div class="half-space">
            <h2>Sign up</h2>
            <form action="signup.php" method="post">
              <div class="form-elements">
                <label for="signup-email">Email address</label>
                <input type="email" class="form-control" name="email" id="signup-email" placeholder="Enter email">
              </div>
              <div class="form-elements">
                <label for="signup-name">First Name</label>
                <input type="text" class="form-control" name="nom" id="signup-email" placeholder="Enter email">
              </div>
              <div class="form-elements">
                <label for="signup-name">Last Name</label>
                <input type="text" class="form-control" name="prenom" id="signup-email" placeholder="Enter email">
              </div>
              <div class="form-elements">
                <label for="signup-city">City</label>
                <input type="text" class="form-control" name="ville" id="signup-email" placeholder="Enter email">
              </div>
              <div class="form-elements">
                <label for="signup-email">Phone Number</label>
                <input type="text" class="form-control" name="tel" id="signup-email" placeholder="Enter email">
              </div>
              <div class="form-elements">
                <label for="signup-password">Password</label>
                <input type="password" class="form-control" name="password" id="signup-password" placeholder="Password">
              </div>
              <div class="form-elements">
                <label for="signup-confirm-password">Confirm Password</label>
                <input type="password" class="form-control" id="signup-confirm-password" name="scp" placeholder="Confirm Password">
              </div>
              <button type="submit" class="btn first-btn" name="sign">Sign up</button>
            </form>
            <a href="login.php">If you have already an account, sign in here</a>
          </div>
          
    </section>
    <script src="../file-js/file2.js"></script>
  </body>

</html>


<?php
    if(isset($_POST['sign'])){
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
            $req_verif="SELECT * from clients where mail='$mail';";
            if(mysqli_num_rows(mysqli_query($conn,$req_verif))>0)
            {
                ?>
                <script>
                    Swal.fire('Already regesitred','error','error')
                    setTimeout(wa9et, 2500);
                    function wa9et(){
                        window.location.href = "login.php";
                    }
                </script>
                <?php
                exit();
            }else{
                if(password_verify($mdp, $scp)===FALSE){
                    ?>
                    <script>
                        Swal.fire('Please confirm your password','error','error')
                        setTimeout(wa9et, 2500);
                        function wa9et(){
                            window.location.href = "signup.php";
                        }
                    </script>
                    <?php
                    
                }
                $req="INSERT INTO clients (idclient, nom, prenom, mdp, tel, ville, mail) VALUES (NULL, '$nom', '$prenom', '$mdp', '$tel', '$ville', '$mail')";
                if(mysqli_query($conn,$req)){
                    $req_rech="SELECT * from clients where mail='$mail' and mdp='$mdp'";
                    $res1=mysqli_query($conn,$req_rech);
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
                            Swal.fire('Welcom to Trillix','Hoping you enjoy your visit','success')
                            setTimeout(wa9et, 2500);
                            function wa9et(){
                                window.location.href = "../index.php";
                            }
                        </script>
                        <?php
                
                     }
                    
                }   else{
                    echo "Error: " . $req . "<br>" . mysqli_error($conn);
                }
            }
            
        }
        mysqli_close($conn);
    }
    
?>