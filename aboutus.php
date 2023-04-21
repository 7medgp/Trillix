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
    <link rel="stylesheet" href="stylegeneral.css">
    <link rel="stylesheet" href="styleaboutus.css">
    <link rel="icon" href="img/Untitled-1.png" type="image/png">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
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
                            <a href="account.php"><i class='bx bxs-user'></i></a>
                            <?php
                        }else{
                            ?>
                            <a href="login.html"><i class='bx bxs-user'></i></a>
                            <?php
                        }
                    ?>
                    
                    <div class="basket"><i class='bx bxs-basket' id="basketIcon"></i><span>0</span></div>
                    <div class="cart">
                        <h2 class="cart-title">Your cart</h2>
                        <div class="cart-content">
                            <div class="cart-box">
                                <?php 
                                    $conn=mysqli_connect("localhost","root","","trillix");
                                    if(isset($_SESSION['id'])){
                                        $id=$_SESSION['id'];
                                            $req_pan="SELECT urltsawer,label,prix,panier.idclient,panier.idprod,panier.quantité FROM panier, produits, clients WHERE panier.idprod=produits.idprod and panier.idclient=clients.idclient and panier.idclient='$id';";
                                        if(mysqli_num_rows(mysqli_query($conn,$req_pan))>0){
                                            foreach(mysqli_query($conn,$req_pan) as $row){
                                                ?>
                                                <img src="<?php echo $row['urltsawer'];?>" alt="" class="cart-img">
                                                <div class="detail-box">
                                                    <div class="cart-product-title"><?php echo $row['label'];?></div>
                                                    <div class="cart-price"><?php echo $row['prix'];?></div>
                                                    <form action="aboutus.php?action=upd&id=<?php echo $row["idclient"]; ?>" method="post">
                                                        <input type="number" name="qtte" class="cart-qtte" value="<?php echo $row['quantité'];?>" min="1" max="5">
                                                        <input type="hidden" name="hid" value="<?php echo $row['idprod'];?>">
                                                        <button name="upd" type="submit">confirm qtte</button>
                                                    </form>
                                                </div>
                                                <form action="aboutus.php?action=sup&id=<?php echo $row["idclient"]; ?>" method="post">
                                                    <input type="hidden" name="hid" value="<?php echo $row['idprod'];?>">
                                                    <button name="del" type="submit" style="width:25px;background:red;"><i class='bx bxs-trash cart-remove'></i></button>
                                                </form>
                                                <?php
                                            }
                                        }
                                    }
                                    else{
                                        echo "ther's noting";
                                    }
                                ?>
                            </div>
                        </div>
                        <div class="total">
                            <div class="total-title">Total</div>
                            <div class="total-price">0</div>
                        </div>
                        <button type="button" class="btn-buy">buy Now</button>
                        <i class='bx bx-x' id="close-cart"></i>
                        <style>
                            .cart{
                                position: fixed;
                                top: 0;
                                right: -100%;
                                min-height: 100vh;
                                width: 20%;
                                padding: 20px;
                                background: var(--bg-color);
                                box-shadow: -2px 0 4px hsl(0 4% 15% / 10%);
                                transition: 0.4s;
                                z-index: 100;
                            }
                            .cart.active{
                                right: 0;
                            }
                            .cart-title{
                                text-align: center;
                                font-size: 1.5rem;
                                font-weight: 600;
                                margin-top: 2rem;
                            }
                            .cart-content{
                                position: relative;
                                display: block;
                                padding: 10px;
	                            border-radius: 0.5rem;
	                            box-shadow: 1px 2px 4px rgb(15 54 55 / 10%);
                            }
                            .cart-box{
                                display: grid;
                                grid-template-columns: 32% 50% 18%;
                                align-items: center;
                                gap: 1rem;
                                margin-top: 1rem;
                               
                            }
                            .cart-img{
                                width: 100px;
                                height: 100px;
                                object-fit: contain;
                                object-position: center;
                                background-color: var(--blue-color);
                                border-radius: 0.5rem;
                                position: relative;
                            }
                            .detail-box{
                                display: grid;
                                row-gap: 0.5rem;
                                margin-left: 10px;
                            }
                            .cart-product-title{
                                font-size: 1rem;
                                text-transform: uppercase;
                            }
                            .cart-price{
                                font-weight: 500;
                            }
                            .cart-qtte{
                                border: 1px solid var(--text-color);
                                outline-color: var(--main-color);
                                width: 2.4rem;
                                text-align: center;
                                font-size: 1rem;
                            }
                            .total{
                                display: flex;
                                justify-content: flex-end;
                                margin-top: 1.5rem;
                                border-top: 1px solid var(--text-color);
                            }
                            .total-title{
                                font-size: 1rem;
                                font-weight: 600;
                            }
                            .total-price{
                               margin-left: 0.5rem; 
                            }
                            .btn-buy{
                                display: flex;
                                margin: 1.5rem auto 0 auto;
                                padding: 12px 20px ;
                                border: none;
                                border-radius: 20px;
                                background: var(--main-color);
                                color: #F5F4F4;
                                font-size: 1rem;
                                font-weight: 500;
                                cursor: pointer;
                                transition: 0.4s;
                            }
                            .btn-buy:hover{
                                background: var(--main-light-color);
                            }
                            #close-cart{
                                position: absolute;
                                top: 1rem;
                                right: 0.8rem;
                                font-size: 2rem;
                                color: var(--text-color);
                                cursor: pointer;
                            }
                        </style>
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
    <script src="file1.js"></script>
</body>
</html>