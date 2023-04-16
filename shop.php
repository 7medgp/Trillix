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
        <link rel="stylesheet" href="stylegeneral.css">
        <link rel="stylesheet" href="styleshop.css">
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
                    <li><a href="index.php" class="active">Home</a></li>
                    <li><a href="shop.php">Featured</a></li>
                    <li><a href="shop.php">Shop</a></li>
                    <li><a href="shop.php">New</a></li>
                </ul>
                <div class="search-bar">
                    <form action="shop.php" method="post">
                        <input type="text" placeholder="What are you looking for?" name="search">
                        <button type="submit" class="btnsubmit" style="background: var(--main-color);color: #F5F4F4;cursor: pointer;transition: 0.4s;border:0;"><i class='bx bx-search'></i></button>
                    </form>
                </div>
                <div class="nav-icons">
                    <a href="#" class="user"><i class='bx bxs-user'></i></a>
                    
                    <a href="#" class="basket"><i class='bx bxs-basket'></i><span>0</span></a>
                    <i class='bx bx-menu' id="menu-icon"></i>
                </div>
            </nav>
        </div>
    </header>
    <section class="shop" id="shop">
        <div class="heading">
            <h2><span>Shop</span> Now</h2>
        </div>
        <div class="shop-container container">
            <?php
                    $conn=mysqli_connect("localhost","root","","trillix");
                    if($_SERVER["REQUEST_METHOD"]=="POST"){
                    $search=htmlspecialchars($_POST['search']);
                    
                    if($search==""){
                        
                        $req_prod="SELECT label, prix, urltsawer from produits;";
                    }else{
                        $req_prod="SELECT label, prix, urltsawer from produits where label='$search';";
                    }
                    
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            
                            echo "<div class='box'><img src='".$row["urltsawer"]."' alt=''><h2>".$row["label"]."</h2><span>".$row["prix"]."</span><a href='#'><i class='bx bx-basket'></i></a></div>";
                        };
                    
                    }}else{echo "ta7che";}
                    mysqli_close($conn);
            ?>
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