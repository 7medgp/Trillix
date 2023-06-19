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
  $conn=mysqli_connect("localhost","root","","trillix");
    
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css-sheets/stylegeneral.css">
        <link rel="stylesheet" href="css-sheets/styleshop.css">
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
                        <button type="submit" class="btnsubmit" name="ba7th" style="background: var(--main-color);color: #F5F4F4;cursor: pointer;transition: 0.4s;border:0;"><i class='bx bx-search'></i></button>
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
    <section class="shop" id="shop">
        <div class="heading">
            <h2><span>Shop</span> Now</h2>
        </div>
        
        <div class="shop-container container">
            <?php
                 $conn=mysqli_connect("localhost","root","","trillix");
                 if(isset($_POST["ba7th"])){
                     $search=htmlspecialchars($_POST['search']);
                     if($search==""){
                         $req_prod="SELECT * from produits;";
                     }else{
                         $req_prod="SELECT * from produits where label='$search' or categorie='$search';";
                     }
                     
                     if(mysqli_num_rows(mysqli_query($conn,$req_prod))> 0){
                         foreach(mysqli_query($conn,$req_prod) as $row){
                             ?> <div class='box'>
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
                         <?php
                         }
                     }else{
                             echo "</div><div style='position: relative;top: 20% ;left :20%;'>no result for '".$search."'<br>";
                             echo "<h3><strong><a href='shop.php' style='color:var(--text-color);'>Perhaps you find this intressting</a></strong></h3></div>";
                             $req_prod="SELECT * from produits;";
                             echo "<div class='shop-container container'>";
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
                                    <?php
                                };
                            
                            }
                         }
                 }else if(isset($_POST['tasnif'])){
                     $card='';
                     $board='';
                     $console='';
                     $boy='';
                     $girl='';
                     $lego='';
                     $tri='';
                     extract($_POST);

                     if(!($tri=='')){
                         $sort=" ORDER BY prix $tri";
                     }else{
                         $sort="";
                     }
                     if(($card=='')&&($board=='')&&($console=='')&&($boy=='')&&($girl=='')&&($lego=='')){
                         $condition="";
                     }else{
                         $condition="where  categorie='$card' or categorie='$board' or categorie='$console'or categorie='$boy' or categorie='$girl' or categorie='$lego'";
                     }
                     $req_prod="SELECT * from produits $condition $sort;";

                     $res=mysqli_query($conn,$req_prod);
                     //echo "<br>".mysqli_num_rows($res);
                     if(mysqli_num_rows($res)> 0){
                        foreach($res as $row){
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
                            <?php
                        };
                    
                    }
                 }else{
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
                            <?php
                        };
                    
                    }
                 }
                 mysqli_close($conn);
            ?>
        <div class="side-bar" style="width:15%; position:absolute; left:20px; top:20%;">
            
            <form aciton="shop.php" id="check" method="post">
                    <fieldset style="margin: 0 10px 10px 0;border-radius: 20px;">
                        <legend style="margin: 0 0 10px 0;"><h3 style="margin: 0 0 0 10px;">Categories </h3></legend>
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="card" value="card" form="check"  id="cat">Cards</label>
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="board" value="board game" form="check"  id="cat">Board Game</label>
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="console" value="console" form="check" id="cat">Console</label>
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="boy" value="garçon" form="check" id="cat">Boy Games</label>
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="girl" value="fille" form="check" id="cat">Girl Games</label>   
                        <label style="display: block; margin-left:20px;"><input type="checkbox" name="lego" value="lego" form="check" id="cat">lego</label>  
                    </fieldset>
                    <fieldset style="margin: 0 10px 10px 0;border-radius: 20px;">
                        <legend style="margin: 0 0 10px 0;"><h3 style="margin: 0 0 0 10px;">Sort by </h3></legend>
                        <label style="display: block; margin-left:20px;"><input type="radio" name="tri" value="ASC" form="check"  id="cat">lowest price</label>
                        <label style="display: block; margin-left:20px;"><input type="radio" name="tri" value="DESC" form="check"  id="cat">highest price</label>
                    </fieldset>
                    
                    <button type="submit" name="tasnif" style="border: 0px; width: 60px;border-radius: 20px; background: #E21D12; color: #f4f5f5;">let's see</button>
            </form>
        </div>
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