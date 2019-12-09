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

    static function getListAdmin($username, $keyword=null) {
        $con = News::connect();
        $sql = "SELECT * FROM News
                WHERE Username = '$username' AND (Title LIKE '%$keyword%' OR Subtitle LIKE '%$keyword%')";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["ID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
                array_push($ls,$news);
            }
        }
        $con->close();
        return $ls;
    }

    static function getListByCategoryAdmin($username, $categoryID) {
        $con = News::connect();
        $sql = "SELECT * FROM News WHERE Username = '$username' AND CategoryID = $categoryID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["ID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
                array_push($ls,$news);
            }
        }
        $con->close();
        return $ls;
    }

    static function getList($keyword=null) {
        $con = News::connect();
        $sql = "SELECT * FROM News
                WHERE Title LIKE '%$keyword%' OR Subtitle LIKE '%$keyword%'";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["ID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
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
                $news = new News($row["ID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
                array_push($ls,$news);
            }
        }
        $con->close();
        return $ls;
    }

    static function getNewsByID($ID) {
        $con = News::connect();
        $sql = "SELECT * FROM News WHERE ID = $ID";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $news = new News($row["ID"],$row["Title"],$row["Subtitle"],$row["Content"],$row["Image"],$row["CreatedTime"],$row["CategoryID"],$row["Username"]);
            }
        }
        $con->close();
        return $news;
    }

    static function add ($title, $subtitle, $content, $image, $categoryID, $username) {
        $con = News::connect();
        $sql = "INSERT INTO News(Title, Subtitle, Content, Image, CategoryID, Username) 
                        VALUES ('$title', '$subtitle', '$content', '$image', $categoryID, '$username')";
        $res = $con->query($sql);
        $con->close();
    }

    static function edit ($ID, $title, $subtitle, $content, $image, $categoryID) {
        $con = News::connect();
        if(strlen($image) > 0) {
            $sql = "UPDATE News 
                    SET Title = '$title', Subtitle = '$subtitle', Content = '$content', Image = '$image', CategoryID = $categoryID
                    WHERE ID = $ID";
        }
        else {
            $sql = "UPDATE News 
                    SET Title = '$title', Subtitle = '$subtitle', Content = '$content', CategoryID = $categoryID
                    WHERE ID = $ID";
        }        
        $res = $con->query($sql);
        $con->close();
    }

    static function delete($ID) {
        $con = News::connect();
        $sql = "DELETE FROM News WHERE ID = $ID";
        $res = $con->query($sql);
        $con->close();
    }
}
?>