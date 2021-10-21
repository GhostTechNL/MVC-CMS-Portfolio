<?php
/**
 * 
 */
class Functions
{
    protected static $connection;
    public static $error = "";

    public static function getConnectionToDatabase($server, $username, $password, $database){
        try {
            $connection = new PDO("mysql:host=$server;dbname=$database;charset=utf8", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $connection; 
        } catch (Exception $e) {
            //echo "Connection: failed <br>";
            self::$error = "Error: " . $e->getMessage();
        }
    }
    //Get the data in a simple version. Can only do simple querys
    public static function select($table = "", $value = "", $conditions = "", $conditionarray = array()){
        //example: 
        if (!is_array($value)) {
            $query = "SELECT '".$value."' FROM $table";
            $pdoQuery->bindParam(":$value". $value);
            //conditions like id = 1
            if (!empty($conditions)) {
                $query .= " WHERE $conditions";
            }
            $pdoQuery = self::$connection->prepare($query);
            $pdoQuery->execute();
        }else{
            //We are using a array
            $arraysize = count($value) -1;
            $query = "SELECT ";
            for ($i=0; $i <= $arraysize; $i++) {
                if ($i == $arraysize) {
                    $query .= "`$value[$i]`";
                }else{
                    $query .= "`$value[$i]`, ";
                }
            }
            $query .= " FROM `$table`";
            if (!empty($conditions)) {
                $query .= " WHERE $conditions";
            }
            $pdoQuery = self::$connection->prepare($query);
            if (!empty($conditions)) {
                foreach ($conditionarray as $key => $data) {
                    $key = ':'.$key;
                    $pdoQuery->bindParam($key,$data);
                }
            }
            $pdoQuery->execute();
            $pdoQuery = $pdoQuery->fetchAll(PDO::FETCH_ASSOC);
        }
        /*
        if (count($pdoQuery) == 1) {
            $newarray = array();
            foreach ($pdoQuery[0] as $key => $value) {
                $newarray[$key] = $value;
            }
            return $newarray;
        } */
            return $pdoQuery;
        
    }
    //simple version of the query function. Can only do simple querys
    public static function simpleQuery($type, $table, $value = array(), $conditions = "", $conditionarray = array()){
        //example: $type | `value` = :value | WHERE $conditions
        $type = strtolower($type);
        $arraylength = "";
        $count = 0;
        $query = "";
        if (is_array($value)) {
            $arraylength = count($value) -1;
        }
        switch ($type) {
            case 'insert':
                $query = "INSERT INTO `$table` (";
                $insertdata = "";
                foreach ($value as $key => $data) {
                    if ($arraylength == $count) {
                        $query .= "`$key`) VALUES ( ";
                        $insertdata .= ":$key)";
                    }else{
                        $query .= "`$key`, ";
                        $insertdata .= ":$key, ";
                    }
                    $count++;
                }
                $query .= $insertdata;
            break;
            case 'update':
                $query = "UPDATE `$table` SET ";
                foreach ($value as $key => $data) {
                    if ($arraylength == $count) {
                        $query .= "`$key` = :$key";
                    }else{
                        $query .= "`$key` = :$key , ";
                    }
                    $count++;
                }
            break;
            case 'delete':
                $query = "DELETE FROM `$table` ";
            break;
            default:
                $query = "";
            break;
        }
        if (!empty($conditions)) {
            $query .= " WHERE $conditions";
        }
        $pdoQuery = self::$connection->prepare($query);
        if ($type !== "delete") {
            foreach ($value as $key => $data) {
                $key = ':'.$key;
                $pdoQuery->bindValue($key,$data);
            }
        }
        if (!empty($conditions)) {
            foreach ($conditionarray as $key => $data) {
                $key = ':'.$key;
                $pdoQuery->bindParam($key,$data);
            }
        }
        $pdoQuery->execute();
        return $pdoQuery;
    }
    //More complexs version of the simpleQuery function. Can do more complex or bigger querys
    public static function query($query, $value = array()){
        $pdo = self::$connection->prepare($query);
        foreach ($value as $key => $data) {
            $pdo->bindParam($key, $data);
        }
        $pdo->execute();
        return $pdo;
    }
    //lastinsertid doestn't work work as allways
    public static function getLastid(){
        $insertedID = self::$connection->lastInsertId();
        return $insertedID;
    }
    //
    public static function closeConnection(){
        self::$connection = null;
    }
}

?>