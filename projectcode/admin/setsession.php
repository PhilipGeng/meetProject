<?php
    session_start();
    if(isset($_SESSION['location'])){
        unset($_SESSION['location']);
        unset($_SESSION['restid']);
    }
    $loc=$_GET['location'];
    $id=$_GET['restid'];
    $_SESSION['location']=$loc;
    $_SESSION['restid']=$id;
    echo $id;
    ?>