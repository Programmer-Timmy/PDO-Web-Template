<?php

class Database
{
    private $connection;
    private $host;
    private $user;
    private $password;
    private $database;
    function __construct()
    {
        global $database;
        $this->host = $database['host'];
        $this->user = $database['user'];
        $this->password = $database['password'];
        $this->database = $database['database'];

        self::connect($this->host, $this->user, $this->password, $this->database);
    }

    function connect($host, $user, $password, $database)
    {
        $this->connection = new PDO("mysql:host=$host;dbname=$database", $user, $password);
    }

    function prepare($sql)
    {
        return $this->connection->prepare($sql);
    }

    public static function insert(string $table, array $columns, array $values)
    {// use foreach use ani sql injection use ?
        $sql = "INSERT INTO $table (";
        foreach ($columns as $column) {
            $sql .= "$column,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ") VALUES (";
        foreach ($values as $value) {
            $sql .= "?,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= ")";
        $sql = htmlspecialchars($sql);
        $stmt = (new Database)->prepare($sql);
        $stmt->execute($values);

    }

    public static function getAll(string $table, array $columns = ['*'],$join = [], array $where = [], string $orderBy = '')
    {
        $sql = "SELECT ";
        foreach ($columns as $column) {
            $sql .= "$column,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM $table";
        foreach ($join as $joinTable => $joinOn) {
            $sql .= " JOIN $joinTable ON $joinOn";
        }
        if (!empty($where)) {
            $sql .= " WHERE ";
            foreach ($where as $column => $value) {
                $sql .= "$column = ? AND ";
            }
            $sql = substr($sql, 0, -5);
        }
        if (!empty($orderBy)) {
            $sql .= " ORDER BY $orderBy";
        }
        $stmt = (new Database)->prepare($sql);
        $stmt->execute(array_values($where));
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }

    public static function get(string $table, array $columns = ['*'],$join = [], array $where = [], string $orderBy = '')
    {
        $sql = "SELECT ";
        foreach ($columns as $column) {
            $sql .= "$column,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " FROM $table";
        foreach ($join as $joinTable => $joinOn) {
            $sql .= " JOIN $joinTable ON $joinOn";
        }
        if (!empty($where)) {
            $sql .= " WHERE ";
            foreach ($where as $column => $value) {
                $sql .= "$column = ? AND ";
            }
            $sql = substr($sql, 0, -5);
        }
        if (!empty($orderBy)) {
            $sql .= " ORDER BY $orderBy";
        }
        $stmt = (new Database)->prepare($sql);
        $stmt->execute(array_values($where));
        return $stmt->fetchobject();
    }

    public static function update(string $table, array $columns, array $values, array $where)
    {
        $sql = "UPDATE $table SET ";
        foreach ($columns as $column) {
            $sql .= "$column = ?,";
        }
        $sql = substr($sql, 0, -1);
        $sql .= " WHERE ";
        foreach ($where as $column => $value) {
            $sql .= "$column = ? AND ";
        }
        $sql = substr($sql, 0, -5);
        $sql = htmlspecialchars($sql);
        $stmt = (new Database)->prepare($sql);
        $stmt->execute(array_merge($values, array_values($where)));
    }

    public static function delete(string $table, array $where)
    {
        $sql = "DELETE FROM $table WHERE ";
        foreach ($where as $column => $value) {
            $sql .= "$column = ? AND ";
        }
        $sql = substr($sql, 0, -5);
        $sql = htmlspecialchars($sql);
        $stmt = (new Database)->prepare($sql);
        $stmt->execute(array_values($where));
    }

    public static function query(string $query, array $values = [])
    {
        $stmt = (new Database)->prepare($query);
        $stmt->execute($values);
        return $stmt->fetchAll(PDO::FETCH_OBJ);
    }
}