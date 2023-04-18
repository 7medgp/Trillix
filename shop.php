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
    $_COOKIE['window']=false;
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
                    <li><a href="#home" class="active">Home</a></li>
                    <li><a href="#featured">Featured</a></li>
                    <li><a href="#shop">Shop</a></li>
                    <li><a href="#new">New</a></li>
                </ul>
                <div class="search-bar">
                    <form action="shop1.php" method="post">
                        <input type="text" placeholder="What are you looking for?" name="search">
                        <button type="submit" class="btnsubmit" style="background: var(--main-color);color: #F5F4F4;cursor: pointer;transition: 0.4s;border:0;"><i class='bx bx-search'></i></button>
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
        <div class="side-bar" style="width:15%; position:relative; left:20px;">
            <h3 style="margin-bottom: 10px;">Categories</h3>
            
            <form aciton="shop.php" id="check" method="get">
                <label style="display: block;"><input type="checkbox" name="card" value="card" form="check"  id="cat">Cards</label>
                <label style="display: block;"><input type="checkbox" name="board" value="board game" form="check"  id="cat">Board Game</label>
                <label style="display: block;"><input type="checkbox" name="console" value="console" form="check" id="cat">Console</label>
                
                <button type="submit" style="border: 0px; width: 60px;border-radius: 20px; background: #E21D12; color: #f4f5f5;">let's see</button>
            </form>
        </div>
        <div class="shop-container container">
            <?php
                $conn=mysqli_connect("localhost","root","","trillix");
                if(($_SERVER['HTTP_REFERER']=="http://127.0.0.1/projetfed/index.php")||($_SERVER['HTTP_REFERER']=="http://127.0.0.1/projetfed/aboutus.php")||($_SERVER['HTTP_REFERER']=="http://127.0.0.1/projetfed/shop1.php")||(($_SERVER['HTTP_REFERER']=="http://127.0.0.1/projetfed/shop.php")&&(extract($_GET)===0))){
                    $req_prod="SELECT label, prix, urltsawer from produits;";
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            echo "<div class='box'><img src='".$row["urltsawer"]."' alt=''><h2>".$row["label"]."</h2><span>".$row["prix"]."</span><a href='#'><i class='bx bx-basket'></i></a></div>";
                        }
                    }
                }
                                
                if($_SERVER["REQUEST_METHOD"]=="GET"){
                    $card='';
                    $board='';
                    $console='';
                    extract($_GET);
                    
                    $req_prod="SELECT label, prix, urltsawer from produits where  categorie='$card' or categorie='$board' or categorie='$console';";
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            
                            echo "<div class='box'><img src='".$row["urltsawer"]."' alt=''><h2>".$row["label"]."</h2><span>".$row["prix"]."</span><a href='#'><i class='bx bx-basket'></i></a></div>";
                        };
                    
                    }
                }
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