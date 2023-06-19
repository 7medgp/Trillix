<?php
    session_start();
    echo "welcome ".$_SESSION["nom"];
    if(array_key_exists("mail",$_SESSION)){
        echo "<br>mawjoud";
    }else{
        echo "<br>no";
    }
    ?>
            