<?php
  session_start();
  $themeClass = '';
  if (!empty($_COOKIE['theme']) && $_COOKIE['theme'] === 'dark') {
      $themeClass = 'dark-theme';
      $btnIcon="img/bxs-sun.png";
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

    <section class="signup-login" id="signup-login">
        <div class="container">
          <div class="line">
            <div class="half-space">
              <h2>Confirm Purchace</h2>
              <form action="" method="post">
                <div class="form-elements">
                  <label for="signup-email">payment:    </label>
                  <input type='radio' class='form-control' name='pay' id='signup-email' value='online'>Online   
                  <input type='radio' class='form-control' name='pay' id='signup-email' value='espece'>Cash
                </div>
                
                <button type="submit" class="btn first-btn" name="achat">Confirm</button>
                
                
              </form>
              
                <button class="btn first-btn" name="" onclick="cancel()">cancel</button>
                <script>
                    function fun(){
                        setTimeout(function(){window.location.href = "account.php";},1500);
                    }
                </script>
              
              <a href="index.php">Back to Home page</a>
            </div>
            <script src="file-js/file2.js"></script>
            </body>
</html>
<?php
    if(isset($_POST["achat"])){
        $conn=mysqli_connect("localhost","root","","trillix");
        $id=$_SESSION['id'];
        $pay=$_POST['pay'];
        $req_confirm="UPDATE panier as a INNER JOIN clients as b on a.idclient=b.idclient SET  Confirmation='oui' WHERE a.idclient=$id;";
        $req_pay="UPDATE panier as a INNER JOIN clients as b on a.idclient=b.idclient SET  payement='$pay' WHERE a.idclient=$id;";
        if((mysqli_query($conn,$req_confirm))and(mysqli_query($conn,$req_pay))){
            
            

            ?>
            <script>
                Swal.fire("Your command will be with you after 2 weeks","success","success");
                function ab3th(){
                            window.location.href = "index.php";
                        }
                        window.setTimeout(ab3th,1500);
            </script>
            <?php
        }else{
            echo "fama mochkla";
        }

    }
?>