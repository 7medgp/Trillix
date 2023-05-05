<?php
  session_start();
  $themeClass = '';
  if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
      $themeClass = 'dark-theme';
      $btnIcon="img/bxs-sun.png";
      $btntext="Light";
      $logo ="img/bl title.white.png";
      $logo1 ="img/bl title.white.png";
      
  }else{
      $btnIcon="img/bxs-moon (1).png";
      $btntext="Dark";
      $logo ="img/bl title.png";
      $logo1 ="img/bl title.png";
      
  }
  
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-sheets/stylesignup.css">
    <link rel="stylesheet" href="css-sheets/stylegeneral.css">
    <link rel="icon" href="img/Untitled-1.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Trillix</title>
    <script src="file-js/alert.js"></script>
    <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
      <script>
            function cartAction(action,code){
                var query="";
                if(action!=""){
                    query= 'action='+action+'&code='+code;
                }
                if(action=="upd"){
                  query+="&qtte="+document.getElementById('cart-qtte').value;
                }
                
                jQuery.ajax({
                    url: "add.php",
                    data:query,
                    type: "POST",
                    success:function(value){
                      var data=value.split(',');
                      let span=document.getElementById("span");
                      span.innerHTML=data[0];
                      let total=document.getElementById("total");
                      total.innerHTML=data[1];
                        },
                    error: function(){
                        alert("mch 9a3da takhtef");
                    }
                });
            }
        </script>
</head>
<body class="<?php echo $themeClass; ?>">
        <div class="toggle-btn" id="btn">
            <span id="btntext"><?php echo $btntext; ?></span>
            <img src="<?php echo $btnIcon; ?>" id="btnIcon" alt="">
        </div>
<header>
            <div class="background-nav">
                <nav class="nav container">
                    <a href="index.php" class="logo">
                        <img src="<?php echo $logo; ?>" id="logo">
                    </a>
                    <ul class="navbar">
                        <li><a href="#" class="active">Your Account</a></li>
                        <li><a href="shop.php">Shop</a></li>
                        <li><a href="#panier">Cart</a></li>
                    </ul>
                    <div class="search-bar">
                        <form action="shop.php" method="post">
                            <input type="text" placeholder="What are you looking for?" name="search">
                            <button type="submit" class="btnsubmit" name="ba7th"style="background: var(--main-color);color: #F5F4F4;cursor: pointer;transition: 0.4s;border:0;"><i class='bx bx-search'></i></button>
                        </form>
                    </div>
                    <div class="nav-icons">
                        <?php
                            if(array_key_exists('nom',$_SESSION)){
                                ?>
                                <a href="#signup-login"><i class='bx bxs-user'></i></a>
                                <?php
                            }else{
                                ?>
                                <a href="login.php"><i class='bx bxs-user'></i></a>
                                <?php
                            }
                        ?>
                        
                        <div class="basket">
                            <?php
                            if(isset($_SESSION['id'])){
                                ?><a href="account.php#panier"><i class='bx bxs-basket' id="basketIcon"></i></a><?php
                            }else{
                                ?><i class='bx bxs-basket' id="basketIcon" onclick="redirect()"></i><?php
                            }
                            ?>
                            
                            <span id="span">
                                <?php
                                if(isset($_SESSION['id'])){
                                  $conn=mysqli_connect("localhost",'root','','trillix');
                                    $id=$_SESSION['id'];
                                    $req="SELECT panier.*, produits.* FROM panier, produits, clients WHERE clients.idclient=panier.idclient and panier.idclient=$id and panier.idprod=produits.idprod;";
                                    if(mysqli_query($conn,$req)){
                                        echo mysqli_num_rows(mysqli_query($conn,$req));
                                    }
                                }else{
                                    echo 0;
                                }
                                
                                ?>
                            </span>
                        </div>
                        
                        <i class='bx bx-menu' id="menu-icon"></i>
                    </div>
                </nav>
            </div>
        </header>
    <section class="signup-login" id="signup-login">
        <div class="container">
          <div class="line">
            <div class="half-space">
              <h2>Your account</h2>
              <form action="" method="post">
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
                <button type="submit" class="btn first-btn" name="save">Save changes</button>
                
                
              </form>
              <form action="index.php" name="disconnect" method="post">
                  <button class="btn first-btn" name="disconnect">Disconnect</button>
                </form>
              
              <a href="index.php">< back to home page</a>
            </div>
            
      </section>
      <section id="panier">
      
    <h2 class="cart-title">Your cart</h2>
    <div class="cart-content">
      <?php
        $conn=mysqli_connect("localhost","root","","trillix");
        $id=$_SESSION['id'];
        $req="SELECT panier.*, label, prix, produits.idprod, urltsawer FROM panier, produits, clients WHERE clients.idclient=panier.idclient and panier.idclient=$id and panier.idprod=produits.idprod;";
        if(mysqli_query($conn,$req)){
          $total=0;
          foreach(mysqli_query($conn,$req) as $row){
            ?>
        <div class="cart-box">
          <img src="<?php echo $row['urltsawer'];?>" alt="" class="cart-img">
          <div class="detail-box">
              <div class="cart-product-title"><?php echo $row['label'];?></div>
              <div class="cart-price"><?php echo $row['prix'];?></div>
              <input type="number" name="qtte" class="cart-qtte" id="cart-qtte"value="<?php echo $row['quantité'];?>" min="1" max="5" onclick="cartAction('upd',<?php echo $row['idprod'];?>)">   
          </div>
          <form>
              
              <button name="del" type="button" class="delete" onclick="cartAction('del',<?php echo $row['idprod'];?>)"><i class='bx bxs-trash cart-remove'></i></button>
          </form>
        </div>
      <?php
          $total+=$row['prix']*$row['quantité'];}
        }
      
           ?>                               
    </div>
    <div class="total">
        <div class="total-title">Total</div>
        <div class="total-price" id="total"><?php echo $total;?></div>
    </div>
    <button type="button" class="btn-buy">buy Now</button>
      </section>
      <footer class="container">
            <div class="footer-box">
                <a href="#" class="logo">
                    <img src="<?php echo $logo1; ?>" id="logo2">
                </a>
                <div class="social">
                    <a href="#"><i class='bx bxl-facebook' ></i></a>
                    <a href="#"><i class='bx bxl-instagram' ></i></a>
                    <a href="#"><i class='bx bxl-youtube' ></i></a>
                    <a href="#"><i class='bx bxl-twitter' ></i></a>
                </div>
            </div>
            <div class="footer-box">
                <h3>Branches</h3>
                <p>Tunis</p>
                <p>Nabeul</p>
                <p>Gabes</p>
            </div>
            <div class="footer-box">
                <h3>Pages</h3>
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="aboutus.php">About Us</a>
                <a href="">Contact Us</a>
                <a href="">FAQ's</a>
            </div> 
        </footer>
        <div class="copyright">
            <p>&#169; Ahmed Hamza Gwissem & Youssef Essid All Right Reserved.</p>
        </div>
        <script src="file-js/file1.js"></script>
</body>
</html>
<?php

    if(isset($_POST['save'])){
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
                $req_se="SELECT * FROM clients WHERE idclient='$id_client'";
                $res=mysqli_fetch_assoc(mysqli_query($conn,$req_se));
                session_unset();
                $_SESSION['id']=$res['idclient'];
                $_SESSION['nom']=$res['nom'];
                $_SESSION['prenom']=$res['prenom'];
                $_SESSION['mail']=$res['mail'];
                $_SESSION['mdp']=$res['mdp'];
                $_SESSION['ville']=$res['ville'];
                $_SESSION['tel']=$res['tel'];
                mysqli_close($conn);
                ?>  
                <script>
                  Swal.fire("Saved","success",'success');
                  function ab3th(){
                        window.location.href = "index.php";
                    }
                    window.setTimeout(ab3th,1000);
                </script>
                <?php
              }
            }      
    }
    
  
?>