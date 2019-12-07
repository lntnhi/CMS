<?php 
class Category {
    #properties
    var $ID;
    var $name;
    #endProperties

    #Construct function
    function __construct ($ID, $name) {
        $this->ID = $ID;
        $this->name = $name;
    }

    static function connect () {
        $con = new mysqli("localhost","root","","CMS");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }

    /**
     * Lấy dữ liệu
     */
    static function getList() {
        $con = Category::connect();
        $sql = "SELECT * FROM Category";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $category = new Category($row["CategoryID"],$row["CategoryName"]);
                array_push($ls,$category);
            }
        }
        $con->close();
        return $ls;
    }
    static function getCategoryByID($ID) {
        $con = Category::connect();
        $sql = "SELECT * FROM Category WHERE CategoryID = $ID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $category = new Category($row["CategoryID"],$row["CategoryName"]);
            }
        }
        $con->close();
        return $category;
    }
}
?>