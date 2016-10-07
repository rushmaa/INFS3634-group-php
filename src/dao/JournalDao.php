<?php
require_once("BaseDao.php");

class JournalDao extends BaseDAO {
    

    public static function getById($journalId) {
        $user = NULL;
        $sql = "SELECT * FROM Journal WHERE journalId=".$journalId;
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $user = $row;
        }
        $conn->close();
        return $user;
    }

    public static function getJournalsByUserId($userId) {
        $users = array();
        $sql = "SELECT * FROM Journal where userid='$userId'";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($users, $row);
            }
        }
        $conn->close();
        return $users;
    }

    public static function getJournals() {
        $users = array();
        $sql = "SELECT * FROM Journal";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($users, $row);
            }
        }
        $conn->close();
        return $users;
    }
    

}