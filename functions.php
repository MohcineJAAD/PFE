<?php
define('DBINFO', 'mysql:host=localhost;dbname=notf');
define('DBUSER', 'root');
define('DBPASS', '');

function getConnection() {
    try {
        $conn = new PDO(DBINFO, DBUSER, DBPASS);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
      
        echo "Connection failed: " . $e->getMessage();
        return null;
    }
}

function fetchAll($query) {
    $conn = getConnection();
    if ($conn) {
        $stmt = $conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    return null;
}

function performQuery($query, $params = array()) {
    $conn = getConnection();
    if ($conn) {
        $stmt = $conn->prepare($query);
        try {
            if ($stmt->execute($params)) {
                return true;
            } else {
                return false;
            }
        } catch (PDOException $e) {
           
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
    return false;
}
?>
