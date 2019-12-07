<?php 
class News {
    #properties
    var $ID;
    var $title;
    var $subtitle;
    var $content;
    var $image;
    var $createdTime;
    var $categoryID;
    var $username;
    #endProperties

    #Construct function
    function __construct ($ID, $title, $subtitle, $content, $image, $createdTime, $categoryID, $username) {
        $this->ID = $ID;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->content = $content;
        $this->image = $image;
        $this->createdTime = $createdTime;
        $this->categoryID = $categoryID;
        $this->username = $username;
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
    static function getList($keyword=null) {
        $con = News::connect();
        $sql = "SELECT * FROM News
                WHERE Title LIKE '%$keyword%' OR Subtitle LIKE '%$keyword%' OR Content LIKE '%$keyword%'";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["NewsID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
                array_push($ls,$news);
            }
        }
        $con->close();
        return $ls;
    }

    static function getListByCategory($categoryID) {
        $con = News::connect();
        $sql = "SELECT * FROM News WHERE CategoryID = $categoryID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["NewsID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
                array_push($ls,$news);
            }
        }
        $con->close();
        return $ls;
    }

    static function getNewsByID($ID) {
        $con = News::connect();
        $sql = "SELECT * FROM News WHERE NewsID = $ID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["NewsID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
            }
        }
        $con->close();
        return $news;
    }
}
?>