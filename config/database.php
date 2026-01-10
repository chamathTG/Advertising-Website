<?php
     $con = mysqli_connect("localhost", "root", "1234", "ad_system");
     if (!$con) {
         die("Connection failed: " . mysqli_connect_error());
     }
?>