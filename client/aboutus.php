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
    $conn=mysqli_connect("localhost","root","","trillix");
    if(isset($_POST["upd"])){
        $id=$_SESSION['id'];
        $hid=$_POST['hid'];
        $qtte=$_POST['qtte'];
        $req_upd="UPDATE panier SET quantité='$qtte'  WHERE idprod='$hid' and idclient='$id';";
        //echo "<script>alert('".mysqli_num_rows(mysqli_query($conn,$req_rech))."');</script>";
        if(mysqli_query($conn,$req_upd)){
            echo "<script>alert('ok');</script>";
        }else{
            
                echo "<script>alert('ta7che up');</script>";
            }
        }
        if(isset($_POST["del"])){
            $id=$_SESSION['id'];
            $hid=$_POST['hid'];
            $req_del="DELETE FROM panier WHERE idprod='$hid' and idclient='$id';";
            //echo "<script>alert('".mysqli_num_rows(mysqli_query($conn,$req_rech))."');</script>";
            if(mysqli_query($conn,$req_del)){
                echo "<script>alert('tfassakh');</script>";
            }else{
                
                    echo "<script>alert('ta7che del');</script>";
                }
            }
            if(isset($_POST["disconnect"])){
                session_destroy();
            }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css-sheets/stylegeneral.css">
    <link rel="stylesheet" href="css-sheets/styleaboutus.css">
    <link rel="icon" href="img/Untitled-1.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <script src="file-js/alert.js"></script>
    <title>Trillix</title>
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
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#featured">Featured</a></li>
                    <li><a href="#shop">Shop</a></li>
                    <li><a href="#new">New</a></li>
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
                            <a href="account.php#signup-login"><i class='bx bxs-user'></i></a>
                            <?php
                        }else{
                            ?>
                            <a href="login-signup/login.php"><i class='bx bxs-user'></i></a>
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
                    </div>
                    <i class='bx bx-menu' id="menu-icon"></i>
                </div>
            </nav>
        </div>
    </header>
    <section class="about-us container">
        <div class="heading">
            <h2><span>About</span> Us</h2>
        </div>
          
          <p>We are a team of passionate professionals dedicated to providing the best service and solutions for our clients. Our mission is to deliver high-quality results while maintaining a focus on customer satisfaction and exceeding expectations.</p>
          <div class="values">
            
            <ul>
                <li><strong>Our Values: </strong></li>
                <li>Integrity</li>
                <li>Teamwork</li>
                <li>Innovation</li>
                <li>Excellence</li>
            </ul>
          </div>
          
          <p>Contact us today to learn more about how we can help you achieve your goals.</p>
      </section>
      <section class="contact-us container">
        <div class="heading">
            <h2><span>Contact</span> Us</h2>
        </div>
        <strong>Phone Numbers :</strong><p>+216 71 656 565</p>
                                        <p>+216 71 555 666</p> 
                                        <p>+216 71 245 698</p>           
        <strong>Location: </strong> <p>23-25 Av. Jean Jaurès, Tunis</p>
                                    <p>FP3P+Q7V, Farhat Hached St, Nabeul</p>
                                    <p>N°159, Avenue Farhat Hached, Angle Avenue Ali Ben Khelifa, Gabès</p>
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
            <a href="contactus.html">Contact Us</a>
            <a href="faq.html">FAQ's</a>
        </div> 
      </footer>
      <div class="copyright">
        <p>&#169; Ahmed Hamza Gwissem & Youssef Essid All Right Reserved.</p>
      </div>
    <script src="file-js/file1.js"></script>
</body>
</html>