<?php

class BaseDAO {
    public static function getConnection(){
        $servername = "52.37.2.64";
        $username = "infs3634";
        $password = "infs3634";
        $dbname = "infs3634";

        $conn = new mysqli($servername, $username, $password, $dbname);
        return $conn;
    }
}