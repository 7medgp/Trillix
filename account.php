<?php
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylesignup.css">
    <link rel="icon" href="/img/Untitled-1.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Trillix</title>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
</head>
<body>
    <section class="signup-login">
        <div class="container">
          <div class="line">
            <div class="half-space">
              <h2>Your account</h2>
              <form action="changement.php" method="post">
                <div class="form-elements">
                  <label for="signup-email">Email address</label>
                  <?php
                    $mail=$_SESSION['mail'];
                    echo "<input type='email' class='form-control' name='email' id='signup-email' placeholder='Enter email' value='$mail'>";
                  ?> 
                </div>
                <div class="form-elements">
                  <label for="signup-name">First Name</label>
                  <?php
                    $prenom=$_SESSION['prenom'];
                    echo "<input type='text' class='form-control' name='prenom' id='signup-email' value='$prenom'>";
                  ?> 
                </div>
                <div class="form-elements">
                  <label for="signup-name">Last Name</label>
                  <?php
                    $nom=$_SESSION['nom'];
                    echo "<input type='text' class='form-control' name='nom' id='signup-email'  value='$nom'>";
                  ?> 
                </div>
                <div class="form-elements">
                  <label for="signup-city">City</label>
                  <?php
                    $ville=$_SESSION['ville'];
                    echo "<input type='text' class='form-control' name='ville' id='signup-email'  value='$ville'>";
                  ?> 
                </div>
                <div class="form-elements">
                  <label for="signup-email">Phone Number</label>
                  <?php
                    $tel=$_SESSION['tel'];
                    echo "<input type='text' class='form-control' name='tel' id='signup-email' value='$tel'>";
                  ?> 
                </div>
                <div class="form-elements">
                  <label for="signup-password">Password</label>
                  <?php
                    $mdp=$_SESSION['mdp'];
                    echo "<input type='password' class='form-control' name='password' id='signup-password' value='$mdp'>";
                  ?> 
                  <input type="checkbox" onclick="myFunction()">Show Password
                  <script>
                    function myFunction() {
                      var x = document.getElementById("signup-password");
                      if (x.type === "password") {
                          x.type = "text";
                      } else {
                          x.type = "password";
                      }
                    }
                  </script>
                </div>
                <button type="submit" class="btn first-btn">Save changes</button>
                <a href="disconnect.php"><button class="btn first-btn">Disconnect</button></a>
              </form>
              
              <a href="index.php">< back to home page</a>
            </div>
            
      </section>
</body>
</html>