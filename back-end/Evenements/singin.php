<?php
if($_POST){
    if($_POST["identifiant"] == "Jeep" && $_POST["inputPassword"] == "Paiste"){
        header('location: Dashboard.php');
    }
}else{
    header('location: index.php');
}