<?php

namespace MyApp;

use PDO;

class User
{
    public $pdo, $sessionId, $userId;
    public function __construct()
    {
        $db = new \MyApp\Database();
        $this->pdo = $db->connect();
        $this->userId = $this->Id();
        $this->sessionId = $this->getSessionId();
    }

    public function Id()
    {
        if (isset($_SESSION['user_id'])) {
            return $_SESSION['user_id'];
        }
    }

    public function getSessionId()
    {
        return session_id();
    }

    public function getUserbySessionId($sessionId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE session_id=:sid");
        $stmt->bindParam(":sid", $sessionId, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }

    public function getUserbyUsername($username)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE uname=:un");
        $stmt->bindParam(":un", $username, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }


    public function getConnectedPeers()
    {
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE uid!=:uid AND `onlineStatus`='Online' LIMIT 4");
        $stmt->bindParam(":uid", $this->userId, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public function updateSession()
    {
        $stmt = $this->pdo->prepare("UPDATE `users` set `session_id`=:sessionId WHERE uid=:uid");
        $stmt->bindParam(":sessionId", $this->sessionId, PDO::PARAM_STR);
        $stmt->bindParam(":uid", $this->userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function updateConnection($connectionId, $status, $userId)
    {
        $stmt = $this->pdo->prepare("UPDATE `users` set `connection_id`=:conId,`onlineStatus`=:status WHERE uid=:uid");
        $stmt->bindParam(":conId", $connectionId, PDO::PARAM_INT);
        $stmt->bindParam(":status", $status, PDO::PARAM_STR);
        $stmt->bindParam(":uid", $userId, PDO::PARAM_INT);
        $stmt->execute();
    }

    public function userData($userid = '')
    {
        $userId = (!empty($userid) ? $userid : $this->userId);
        $stmt = $this->pdo->prepare("SELECT * FROM `users` WHERE uid=:uid");
        $stmt->bindParam(":uid", $userId, PDO::PARAM_INT);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_OBJ);
        return $user;
    }
}
