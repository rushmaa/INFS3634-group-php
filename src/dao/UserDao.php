<?php
require_once("BaseDao.php");

class UserDAO extends BaseDAO {


    // Retrieves the corresponding row for the specified user ID.
    public static function getById($userId) {
        $user = NULL;
        $sql = "SELECT * FROM User WHERE userId=".$userId;
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

    public static function login($username, $password) {
        $user = NULL;
        $sql = "SELECT * FROM User WHERE username='$username' and password='$password'";
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

    // Retrieves all users currently in the database.
    public static function getUsers() {
        $users = array();
        $sql = "SELECT * FROM User";
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

    // Retrieves all users currently in the database.
    public static function getStudents() {
        $users = array();
        $sql = "SELECT * FROM User where isAdmin=0";
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

    public static function getAdmins() {
        $users = array();
        $sql = "SELECT * FROM User where isAdmin=1";
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

    public static function saveOrUpdate($user) {
        if ($user['userId']) {
            return UserDAO::update($user);
        } else {
            return UserDAO::save($user);
        }
    }

    public static function save($user) {
        $sql = "INSERT INTO User(username, password, name, isAdmin) VALUES('{$user['username']}', {$user['password']}, {$user['name']}, {$user['isAdmin']});";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result) {
            $id = $conn->insert_id;
        } else {
            $id = false;
        }
        $conn->close();
        return $id;
    }

    public static function update($user) {
        $sql = "UPDATE User set username = '{$user['username']}', password = '{$user['password']}', name = '{$user['name']}', isAdmin = '{$user['isAdmin']}' where userId = '{$user['userId']}';";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $result;
    }
}