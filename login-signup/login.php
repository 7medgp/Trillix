<?php
     $themeClass = '';
     if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
         $themeClass = 'dark-theme';
         $btnIcon="../img/bxs-sun.png";
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
    <link rel="icon" href="../img/Untitled-1.png" type="image/png">
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
            <h2>Login</h2>
            <form action="" method="post" name="login">
              <div class="form-elements">
                <label for="login-email">Email address</label>
                <input type="email" class="form-control" id="login-email" placeholder="Enter email" name="email">
              </div>
              <div class="form-elements">
                <label for="login-password">Password</label>
                <input type="password" class="form-control" id="login-password" placeholder="Password" name="password">
              </div>
              <button type="submit" class="btn first-btn">Login</button>
            </form>
            <a href="signup.php">If you don't an account, here you can register</a>
          </div>
        </div>
      </div>
    </section>
    <script src="../file-js/file2.js"></script>
  </body>
</html>
<?php
    if($_POST){
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
                    
                    Swal.fire('You are now connected','success','success');
                    function ab3th(){
                        window.location.href = "../index.php";
                    }
                    window.setTimeout(ab3th,2500);
                </script>
                <?php
                
            }else{
                
                    ?>
                    <script type="text/javascript">
                        
                        Swal.fire('wrong password or email','error','error'); 
                        function ab3th(){
                            window.location.href = "login.php";
                        }
                        window.setTimeout(ab3th,2500);
                    </script>
                    <?php
               

                
            }
        }
        mysqli_close($conn);
    } 
?>
