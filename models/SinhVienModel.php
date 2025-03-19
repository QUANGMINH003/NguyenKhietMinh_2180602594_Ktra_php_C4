<?php
class SinhVienModel
{
    private $conn;

    public function __construct($db)
    {
        $this->conn = $db;
    }

    public function getAllSinhVien()
    {
        $query = "SELECT sv.*, nh.TenNganh FROM SinhVien sv JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getSinhVienByMaSV($maSV)
    {
        $query = "SELECT sv.*, nh.TenNganh 
                  FROM SinhVien sv 
                  LEFT JOIN NganhHoc nh ON sv.MaNganh = nh.MaNganh 
                  WHERE sv.MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        $stmt->execute(['maSV' => $maSV]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function createSinhVien($data)
    {
        $query = "INSERT INTO SinhVien (MaSV, HoTen, GioiTinh, NgaySinh, Hinh, MaNganh) 
                  VALUES (:maSV, :hoTen, :gioiTinh, :ngaySinh, :hinh, :maNganh)";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function updateSinhVien($maSV, $data)
    {
        $query = "UPDATE SinhVien 
                  SET HoTen = :hoTen, GioiTinh = :gioiTinh, NgaySinh = :ngaySinh, Hinh = :hinh, MaNganh = :maNganh 
                  WHERE MaSV = :maSV";
        $data['maSV'] = $maSV;
        $stmt = $this->conn->prepare($query);
        return $stmt->execute($data);
    }

    public function deleteSinhVien($maSV)
    {
        $query = "DELETE FROM SinhVien WHERE MaSV = :maSV";
        $stmt = $this->conn->prepare($query);
        return $stmt->execute(['maSV' => $maSV]);
    }
}
