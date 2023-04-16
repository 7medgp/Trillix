<?php
  session_start();
  $themeClass = '';
    if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
        $themeClass = 'dark-theme';
        $btnIcon="img/bxs-sun.png";
        $btntext="Light";
        $logo ="img/bl title.white.png";
        $logo1 ="img/bl title.white.png";
        $tile ="img/tile.white.png";
    }else{
        $btnIcon="img/bxs-moon (1).png";
        $btntext="Dark";
        $logo ="img/bl title.png";
        $logo1 ="img/bl title.png";
        $tile ="img/tile.png";
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="stylegeneral.css">
    <link rel="stylesheet" href="styles.css">
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
                <a href="index.html" class="logo">
                    <img src="<?php echo $logo; ?>" id="logo">
                </a>
                <ul class="navbar">
                    <li><a href="index.html" class="active">Home</a></li>
                    <li><a href="shop.html">Featured</a></li>
                    <li><a href="#">Shop</a></li>
                    <li><a href="shop.html">New</a></li>
                </ul>
                <div class="search-bar">
                    <input type="text" placeholder="What are you looking for?">
                    <a href="shop.html"><i class='bx bx-search'></i></a>
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
                    
                    <a href="#" class="basket"><i class='bx bxs-basket'></i><span>0</span></a>
                    <i class='bx bx-menu' id="menu-icon"></i>
                </div>
            </nav>
        </div>
    </header>
    
    <section class="home" id="home">
        <div class="home-container container">
            <div class="home-text">
                <h1>The best Toy Store in Tunisia</h1>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                <a href="#" class="btn">Buy now</a>
            </div>
            <div class="home-img">
                <img src="<?php echo $tile; ?>" id="tile">
            </div>
        </div>
    </section>
    <section class="featured" id="featured">
        <div class="heading">
            <h2>Featured <span>Items</span></h2>
        </div>
        <div class="featured-container container">
            <div class="box">
                <img src="img\chess.png" alt="">
                <div class="text">
                    <h2>New Collection <br>Of Toys</h2>
                    <a href="#">View More</a>
                </div>
            </div>
            <div class="box">
                <div class="text">
                    <h2>20% Discount <br>On Toys</h2>
                    <a href="#">View More</a>
                </div>
                <img src="img\chess.png" alt="">
            </div>
        </div>
    </section>
    <section class="shop" id="shop">
        <div class="heading">
            <h2><span>Shop</span> Now</h2>
        </div>
        <div class="shop-container container">
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
            <div class="box">
                <img src="img/chess.png" alt="">
                <h2>Chess</h2>
                <span>50.99$</span>
                <a href="#"><i class='bx bx-basket'></i></a>
            </div>
        </div>
    </section>
    <section class="new" id="new">
        <div class="heading">
            <h2>New <span>Arrival</span></h2>
        </div>
        <div class="shop-container container">
            <?php
                    $conn=mysqli_connect("localhost","root","","trillix");
                    $req_prod="SELECT label, prix, urltsawer from produits;";
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            
                            echo "<div class='box'><img src='".$row["urltsawer"]."' alt=''><h2>".$row["label"]."</h2><span>".$row["prix"]."</span><a href='panier.php'><i class='bx bx-basket'></i></a></div>";
                        };
                    
                    }
                    mysqli_close($conn);
            ?>
        </div>
    </section>
      <footer class="container">
        <div class="footer-box">
            <a href="#" class="logo">
                <img src="<?php echo $logo1; ?>" id="logo1">
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
            <a href="index.html">Home</a>
            <a href="shop.php">Shop</a>
            <a href="aboutus.html">About Us</a>
            <a href="fuck.php">Contact Us</a>
            <a href="faq.html">FAQ's</a>
        </div> 
      </footer>
      <div class="copyright">
        <p>&#169; Ahmed Hamza Gwissem & Youssef Essid All Right Reserved.</p>
      </div>
    <script src="file.js"></script>
</body>
</html>