<?php
namespace dao;

use PDO;
use \dao\PDOutil;
use \ent1\Genre;

class GenreDao
{
    public function fetchGenreFromDb()
    {
        $link = PDOutil::createMySQLConnection();
        $query = 'SELECT Id, Nama_genre From genre';
        $stmt = $link -> prepare($query);
        $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, Genre::class);
        $stmt->execute();
        $results = $stmt->fetchAll();
        $link = null;
        return $results;
    }
    public function addGenretodb(Genre $genre){
        $result = 0;
        $link = PDOutil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'INSERT INTO genre(Nama_genre) VALUES(?)'; 
        $stmt = $link -> prepare($query);
        $stmt->bindValue(1, $genre->getName());
        if($stmt->execute()){
            $link->commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
            $link = null;
            return $result;
    }

    public function fetchOneGenreFromDb($Id){
        $link = PDOutil::createMySQLConnection();
        $query = 'SELECT Id, Nama_genre FROM genre WHERE Id = ?';
        $stmt = $link -> prepare($query);
        $stmt -> bindParam(1, $Id);
        $stmt ->setFetchMode(PDO::FETCH_OBJ);
        $stmt ->execute();
        $result = $stmt->fetchObject(Genre::class);
        $link = null;
        return $result;
    }

    public function updateGenreToDb(Genre $genre){
        $result = 0;
        $link = PDOutil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'UPDATE genre SET Nama_genre = ?, Id= ? WHERE Id = ?'; 
        $stmt = $link -> prepare($query);
        $stmt->bindValue(1, $genre ->getName());
        $stmt->bindValue(2, $genre ->getId());
        $stmt->bindValue(3, $genre ->getId());
        if($stmt -> execute()){
            $link->commit();
            $result = 1;
        }else{
            $link -> rollBack();
        }
        $link = null;
        return $result;
    }

    public function deleteGenre($Id)
    {
        $result = 0;
        $link = PDOutil::createMySQLConnection();
        $link -> beginTransaction();
        $query = 'DELETE FROM genre WHERE Id = ?';
        $stmt = $link -> prepare($query);
        $stmt -> bindParam(1, $Id);
        if ($stmt -> execute()) {
            $link -> commit();
            $result = 1;
        } else {
            $link -> rollBack();
        }
        $link = null;
        return $result;
        }
}
