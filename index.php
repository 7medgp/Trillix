<?php
if(isset($_POST["disconnect"])){
    if (isset($_SERVER['HTTP_COOKIE'])) {
        $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
        foreach($cookies as $cookie) {
            $parts = explode('=', $cookie);
            $name = trim($parts[0]);
            setcookie($name, '', time()-1000);
            setcookie($name, '', time()-1000, '/');
        }
    }
    session_destroy();
    header("location: index.php");   
}
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

$conn=mysqli_connect("localhost","root","","trillix");
     

    
    
        
            
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="css-sheets/stylegeneral.css">
        <link rel="stylesheet" href="css-sheets/styles.css">
        <link rel="icon" href="img/Untitled-1.png" type="image/png">
        <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
        <script src="https://code.jquery.com/jquery-2.1.1.min.js" type="text/javascript"></script>
        <script src="file-js/alert.js"></script>
        <title>Trillix</title>
        <script>
            function cartAction(action,code){
                var query="";
                if(action!=""){
                    query= 'action='+action+'&code='+code;
                }
                jQuery.ajax({
                    url: "add.php",
                    data:query,
                    type: "POST",
                    success:function(value){
                        let span=document.getElementById("span");
                        var data=value.split(',');
                        span.innerHTML=data[0];
                        if(action==="add"){
                            $("#add_"+code).hide();
                            $("#del_"+code).show();
                        }else{
                            $("#add_"+code).show();
                            $("#del_"+code).hide();
                        }
                        
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
                        <a href="shop.php">View More</a>
                    </div>
                </div>
                <div class="box">
                    <div class="text">
                        <h2>20% Discount <br>On Toys</h2>
                        <a href="shop.php">View More</a>
                    </div>
                    <img src="img\chess.png" alt="">
                </div>
            </div>
        </section>
        <section class="shop" id="shop">
            <div class="heading">
                <h2>Best <span>Sellers</span></h2>
            </div>
            <div class="shop-container container">
                <?php
                    $conn=mysqli_connect("localhost","root","","trillix");
                    $req_prod="SELECT * from produits;";
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            ?>
                            <div class='box'>
                                <form id="fromcart">
                                    <img src='<?php echo $row["urltsawer"]; ?>' alt=''>
                                    <h2><?php echo $row["label"];?></h2>
                                    <span><?php echo $row["prix"];?></span>
                                <?php
                                if(isset($_SESSION['id'])){
                                    $hid=$row['idprod'];
                                    $req="SELECT * FROM panier WHERE panier.idclient='$id' and panier.idprod='$hid';";
                                    if(mysqli_num_rows(mysqli_query($conn,$req))===0){
                                        ?>
                                        <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')" style="appearence: none;"><i class='bx bx-basket'></i></button>
                                        <button name="del" type="button" id="del_<?php echo $row['idprod'];?>"style="display: none;"><i class='bx bxs-trash cart-remove' onclick="cartAction('del',<?php echo $row['idprod'];?>)"></i></button>
                                        <?php
                                        }else{
                                            ?>
                                            <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')"style="display: none"><i class='bx bx-basket'></i></button>
                                            <button name="del" type="button" id="del_<?php echo $row['idprod'];?>"><i class='bx bxs-trash cart-remove' onclick="cartAction('del',<?php echo $row['idprod'];?>)"></i></button>
                                            <?php
                                    }
                                }else{
                                    ?>
                                    <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')"><i class='bx bx-basket'></i></button>
                                    <?php
                                    
                                }
                                
                                ?>
                            
                                </form>
                            </div>
                            <?php } ?> 
                            
                            <?php
                        }
                        mysqli_close($conn);
                ?>
            </div>
        </section>
        <section class="new" id="new">
            <div class="heading">
                <h2>New <span>Arrival</span></h2>
            </div>
            <div class="shop-container container">
            <?php
                    $conn=mysqli_connect("localhost","root","","trillix");
                    $req_prod="SELECT * from produits;";
                    if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                        foreach(mysqli_query($conn,$req_prod) as $row){
                            ?>
                            <div class='box'>
                                <form id="fromcart">
                                    <img src='<?php echo $row["urltsawer"]; ?>' alt=''>
                                    <h2><?php echo $row["label"];?></h2>
                                    <span><?php echo $row["prix"];?></span>
                                <?php
                                if(isset($_SESSION['id'])){
                                    $hid=$row['idprod'];
                                    $req="SELECT * FROM panier WHERE panier.idclient='$id' and panier.idprod='$hid';";
                                    if(mysqli_num_rows(mysqli_query($conn,$req))===0){
                                        ?>
                                        <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')" style="appearence: none;"><i class='bx bx-basket'></i></button>
                                        <button name="del" type="button" id="del_<?php echo $row['idprod'];?>"style="display: none;"><i class='bx bxs-trash cart-remove' onclick="cartAction('del',<?php echo $row['idprod'];?>)"></i></button>
                                        <?php
                                        }else{
                                            ?>
                                            <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')"style="display: none"><i class='bx bx-basket'></i></button>
                                            <button name="del" type="button" id="del_<?php echo $row['idprod'];?>"><i class='bx bxs-trash cart-remove' onclick="cartAction('del',<?php echo $row['idprod'];?>)"></i></button>
                                            <?php
                                    }
                                }else{
                                    ?>
                                    <button type="button" id="add_<?php echo $row['idprod'];?>"onclick="cartAction('add','<?php echo $row['idprod'];?>')"><i class='bx bx-basket'></i></button>
                                    <?php
                                    
                                }
                                
                                ?>
                            
                                </form>
                            </div>
                            <?php } ?> 
                            
                            <?php
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
                <a href="index.php">Home</a>
                <a href="shop.php">Shop</a>
                <a href="aboutus.php">About Us</a>
                <a href="">Contact Us</a>
                <a href="faq.html">FAQ's</a>
            </div> 
        </footer>
        <div class="copyright">
            <p>&#169; Ahmed Hamza Gwissem & Youssef Essid All Right Reserved.</p>
        </div>
        <script src="file-js/file.js"></script>

    </body>
</html>