<?php
class Database
{
    private $url;
    private $db;

    public function __construct($source, $userName = "root", $password = "")
    {
        $this->url = "mysql:host=localhost;dbname=$source;";
        $this->db = new PDO($this->url, $userName, $password);
    }

    public function insert($row, $tableName)
    {
        $values = implode("','", $row);
        $req = "INSERT INTO $tableName VALUES('" . $values . "')";
        echo ($req);
        return $this->db->exec($req);
    }
    public function loue($id_emp, $id_voiture, $date_deb, $date_fin)
    {

        $req = "insert into location (id_voiture,id_employe,date_debut,date_fin) values($id_voiture,$id_emp,'$date_deb','$date_fin')";
        return $this->db->exec($req);
    }
    public function releaseLocation($id)
    {
        $req = "delete from location where id_voiture= $id;";
        return $this->db->exec($req);
    }

    public function select($tableName, $key = "", $value = "")
    {
        $req = "SELECT * FROM $tableName";
        if ($key) {
            $req = $req . " WHERE $key = '$value'";
        }
        $ps = $this->db->query($req); // PDOStatement
        $data = array();
        foreach ($ps as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function executeSelect($req)
    {
        $ps = $this->db->query($req); // PDOStatement
        $data = array();
        foreach ($ps as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function selectTableHeader($tableName)
    {

        $req = "SHOW COLUMNS FROM $tableName;";

        $ps = $this->db->query($req); // PDOStatement
        $data = array();
        foreach ($ps as $row) {
            $data[] = $row;
        }
        return $data;
    }
    public function  delete($table, $key, $value)
    {
        $req = "delete  FROM $table where $key = $value";

        $res = $this->db->query($req); // PDOStatement

        return $res;
    }
    public function  update($req)
    {

        $res = $this->db->query($req); // PDOStatement

        return $res;
    }
    public function  executeQuery($req)
    {

        $res = $this->db->query($req); // PDOStatement

        return $res;
    }
    public function getLastInsertedId()
    {
        $last_id = $this->db->lastInsertId();
        return $last_id;
    }
}
