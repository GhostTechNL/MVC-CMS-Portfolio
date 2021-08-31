<?php
/**
 * 
 */
class Functions
{
    protected static $connection;

    public static function getConnectionToDatabase($server, $username, $password, $database){
        try {
            $connection = new PDO("mysql:host=$server,db=$database", $username, $password);
            $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            self::$connection = $connection; 
        } catch (Exception $e) {
            
        }
    }
    //Get the data in a simple version.
    public function select($table, $value = array(), $conditions = "")
    {
        if (!is_array($value)) {

            $query = "SELECT :'".$value."' FROM $table";
            $pdoQuery->bindParam(":". $value, $value);
            //conditions like id = 1
            if (empty($conditions)) {
                $query .= "WHERE $conditions";
            }
            $pdoQuery = self::$connection->prepare($query);
            $pdoQuery->execute();
        }else{
            $query = "SELECT ";
            for ($i=0; $i <= count($value) -1; $i++) { 
                if ($i == count($value) -1) {
                    $query .= "`$value[$i]`";
                }else{
                    $query .= "`$value[$i]`, ";
                }
            }
            $query += "FROM $table";
            $pdoQuery = self::$connection->prepare($query);
            foreach ($value as $key => $input) {
                $pdoQuery->bindParam($key, $input);
            }
            $pdoQuery->execute();
        }
        return $pdoQuery;
    }
    //simple version of the query function.
    public function simpleQuery($type, $table, $value = array(), $conditions = ""){
        // $type | `value` = :value | WHERE $conditions
        $arraylength = count($value);
        $count = 0;
        $query = "";
        switch ($type) {
            case 'insert':
                $query = "INSERT INTO `$table`";
            break;
            case 'update':
                $query = "UPDATE $table SET";
            break;
            case 'delete':
                $query = "DELETE FROM $table";
            break;
            default:
                $query = "";
            break;
        }
        foreach ($value as $key => $data) {
            if (($arraylength -1) == $count) {
                $query .= "`$key` = :$key";
            }else{
                $query .= "`$key` = :$key , ";
            }
            $count++;
        }
        $query .= $conditions;
        $pdo = self::$connection->prepare($query);
        foreach ($value as $key => $data) {
            $pdo->bindParam(":".$key, $data);
        }
        $pdo->execute();
        return $pdo;
    }
    //More complexs version of the simpleQuery function.
    public function query($query, $value = array()){
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