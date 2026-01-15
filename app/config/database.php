<?php
class Database {

    public static function connect() {
        $con = mysqli_connect("localhost", "root", "1234", "ad_sysytem");

        if (!$con) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $con;
    }
}
