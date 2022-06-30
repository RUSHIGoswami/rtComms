<?php

namespace MyApp;

use PDO;

class Database
{
    function connect()
    {
        $pdo = new PDO("mysql:host=127.0.0.1;dbname=webrtc", "root", "");
        return $pdo;
    }
}
