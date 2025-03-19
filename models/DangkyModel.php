<?php
class DangkyModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function createDangky($maSV)
    {
        $ngayDK = date('Y-m-d');
        $query = "INSERT INTO Dangky (NgayDK, MaSV) VALUES (:ngayDK, :maSV)";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['ngayDK' => $ngayDK, 'maSV' => $maSV]);
        return $this->conn->lastInsertId();
    }
}
