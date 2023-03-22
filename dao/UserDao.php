<?php
namespace dao;

use ent1\User;
use PDO;

class UserDao
{
    public function login($email, $password): bool|User
    {
        $link = PDOutil::createMySQLConnection();
        $query = 'SELECT id, Name, email FROM user WHERE email = ? AND password = (?)';
        $stmt = $link ->prepare($query);
        $stmt->bindparam(1, $email);
        $stmt->bindparam(2, $password);
        $stmt->setFetchMode(PDO::FETCH_OBJ);
        $stmt->execute();
        $user = $stmt->fetchObject(User::class);
        $link = null;
        return $user;
    }
}

?>