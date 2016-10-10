<?php
require_once("BaseDao.php");

class JournalDao extends BaseDAO {
    

    public static function getById($journalId) {
        $journal = NULL;
        $sql = "SELECT * FROM Journal WHERE journalId=".$journalId;
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            $row = $result->fetch_assoc();
            $journal = $row;
        }
        $conn->close();
        return $journal;
    }

    public static function getJournalsByUserId($journalId) {
        $journals = array();
        $sql = "SELECT * FROM Journal where userid='$journalId'";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($journals, $row);
            }
        }
        $conn->close();
        return $journals;
    }

    public static function getJournals() {
        $journals = array();
        $sql = "SELECT * FROM Journal";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                array_push($journals, $row);
            }
        }
        $conn->close();
        return $journals;
    }

    public static function saveOrUpdate($journal) {
        if ($journal['journalId']) {
            return JournalDao::update($journal);
        } else {
            return JournalDao::save($journal);
        }
    }

    public static function save($journal) {
        $sql = "INSERT INTO Journal(journalTitle, journalContent, userId) VALUES('{$journal['journalTitle']}', '{$journal['journalContent']}', '{$journal['userId']}');";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        if ($result) {
            $journal['journalId'] = $conn->insert_id;
        }
        $conn->close();
        return $journal;
    }

    public static function update($journal) {
        $sql = "UPDATE Journal set journalTitle = '{$journal['journalTitle']}', journalContent = '{$journal['journalContent']}' where journalId = '{$journal['journalId']}';";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        $conn->close();
        return $journal;
    }

    public static function delete($journalId) {
        $sql = "DELETE FROM Journal where journalId = $journalId";
        $conn = parent::getConnection();
        $result = $conn->query($sql);
        $conn->close();
    }

}