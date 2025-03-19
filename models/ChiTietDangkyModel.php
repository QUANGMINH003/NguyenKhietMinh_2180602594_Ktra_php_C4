<?php
class ChiTietDangkyModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function addChiTietDangky($maDK, $maHP)
    {
        $query = "INSERT INTO ChiTietDangky (MaDK, MaHP) VALUES (:maDK, :maHP)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['maDK' => $maDK, 'maHP' => $maHP]);
    }
}
