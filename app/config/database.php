<?php

    class Database
    {
        public static function connect()
        {
            $con = mysqli_connect("localhost", "root", "", "ad_system");
            
            if (!$con)
            {
                die("Connection failed: " . mysqli_connect_error());
            }
                
            return $con;
        }
    }
