<?php
    session_start();
    $conn=mysqli_connect("localhost","root","","trillix");
    $hid=$_POST['code'];
    $id=$_SESSION['id'];
    $hint2=0;
    $hint=mysqli_num_rows(mysqli_query($conn,"SELECT panier.*, produits.* FROM panier, produits, clients WHERE clients.idclient=panier.idclient and panier.idclient=$id and panier.idprod=produits.idprod;"));
    if(!empty($_POST["action"])){
        switch($_POST['action']){
            case "add":
                $req_rech="SELECT * FROM panier WHERE idprod='$hid' and idclient ='$id'";
                if(mysqli_num_rows(mysqli_query($conn,$req_rech))===0){
                        $req_add="INSERT  INTO panier(idclient, idprod,quantité) values($id,$hid,'1');";
                        if(mysqli_query($conn,$req_add)){
                           $hint+=1;
                        }else{
                            echo "oba";
                        }
                }else{
                    echo "mawjoud";
                }
            break;
            case "del":
                $req_del="DELETE FROM panier WHERE idprod='$hid' and idclient='$id';";
                if(mysqli_query($conn,$req_del)){
                    $hint-=1;
                }
            break;
            case "upd":
                $qtte=intval($_POST['qtte']);
                $req_upd="UPDATE panier SET quantité=$qtte where idprod='$hid' and idclient='$id';" ;  
                if(mysqli_query($conn,$req_upd)){
                    $req="SELECT panier.*, label, prix, produits.idprod, urltsawer FROM panier, produits, clients WHERE clients.idclient=panier.idclient and panier.idclient='$id' and panier.idprod=produits.idprod;";
                    if(mysqli_num_rows(mysqli_query($conn,$req))>0){
                        $hint2=0;
                        foreach(mysqli_query($conn,$req) as $row ){
                            $hint2 +=$row['prix'] * $row['quantité'];
                        }
                    }else{
                        $hint2=0;
                    }
                }
        }   
    }
    echo $hint.','.$hint2;
?>
    
