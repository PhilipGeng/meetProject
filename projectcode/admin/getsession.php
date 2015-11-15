<?php
    session_start();
    $location=$_SESSION['location'];
    $restid=$_SESSION['restid'];
    echo $location."-".$restid;
    ?>
