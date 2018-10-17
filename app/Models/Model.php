<?php
/// Basic ORM Model
class Model
{
    private function __constructor(){}
    public static function con ()
    {
        global $con;
        return $con;
    }
    public static function insert ($tableName, $columns = array(), $values = array())
    {
        $cArray = array();
        foreach ($columns as $column) {
            $cArray[] = $column;
        }
        $cIm = "(" . implode(", ", $cArray) . ")";
        $vArray = array();
        for ($i = 0;$i < count($cArray);$i++) {
            $vArray[] = "?";
        }
        $vIm = "(" . implode(", ", $vArray) . ")";
        $query = "INSERT INTO " . $tableName . " " . $cIm . " VALUES " . $vIm;
        $stmt = self::con()->prepare($query);
        $stmt->execute($values);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function update($tableName, $columns = array(), $values = array())
    {
        $cArray = array();
        foreach ($columns as $column) {
            $cArray[] = $column . "=?";
        }
        $cIm = implode(", ", $cArray);
        $query = "UPDATE " . $tableName . " SET " . $cIm;
        echo $query;
        $stmt = self::con()->prepare($query);
        $stmt->execute($values);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function delete($tableName, $col, $val)
    {
        $query = "DELETE FROM " . $tableName . " WHERE " . $col . "=?";
        $stmt = self::con()->prepare($query);
        $stmt->execute(array($val));
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function readAll($select, $tableName, $limit = 0)
    {
        if ($limit === 0) {
            $query = "SELECT " . $select . " FROM " . $tableName;
        } else {
            $query = "SELECT " . $select . " FROM " . $tableName . " LIMIT " . $limit;
        }
        $stmt = self::con()->prepare($query);
        $stmt->execute();
        $row = $stmt->fetchAll();
        return $row;
    }
    public static function read($select, $tableName, $col, $val, $limit = 0)
    {
        if ($limit === 0) {
            if (count($col) === 1) {
                $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $col[0] . "=?";
            } else {
                $cArray = array();
                foreach ($col as $coll) {
                    $cArray[] = $coll . "=?";
                }
                $cIm = implode(" AND ", $cArray);
                $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $cIm;
            }
        } else {
            if (count($col) === 1) {
                $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $col[0] . "=?" . " LIMIT " . $limit;
            } else {
                $cArray = array();
                foreach ($col as $coll) {
                    $cArray[] = $coll . "=?";
                }
                $cIm = implode(" AND ", $cArray);
                $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $cIm . " LIMIT " . $limit;
            }
        }
        $stmt = self::con()->prepare($query);
        $stmt->execute($val);
        $row = $stmt->fetchAll();
        return $row;
    }
    public static function checkDb($select, $tableName, $col, $val)
    {
        if (count($col) === 1) {
            $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $col[0] . "=?";
        } else {
            $cArray = array();
            foreach ($col as $coll) {
                $cArray[] = $coll . "=?";
            }
            $cIm = implode(" AND ", $cArray);
            $query = "SELECT " . $select . " FROM " . $tableName . " WHERE " . $cIm;
        }
        $stmt = self::con()->prepare($query);
        $stmt->execute($val);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return 1;
        } else {
            return 0;
        }
    }
    public static function sql($query, $value = array())
    {
        $stmt = self::con()->prepare($query);
        $stmt->execute($value);
        $count = $stmt->rowCount();
        if ($count > 0) {
            return true;
        } else {
            return false;
        }
    }
    public static function custom($query,  $value = array())
    {
        $stmt = self::con()->prepare($query);
        $stmt->execute($value);
        $row = $stmt->fetchAll();
        return $row;
    }
}
?>