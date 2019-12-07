<?php
class Admin {
    var $username;
    var $password;
    var $fullname;

    function Admin($username, $password, $fullname) {
        $this->username = $username;
        $this->password = $password;
        $this->fullname = $fullname;
    }

    static function connect () {
        $con = new mysqli("localhost","root","","CMS");
        $con->set_charset("utf8");
        if ($con->connect_error)
            die("Kết nối thất bại. Chi tiết: " . $con->connect_error);
        return $con;
    }

    static function getList() {
        $con = Admin::connect();
        $sql = "SELECT * FROM Admin";
        $res = $con->query($sql);
        $ls = [];
        if ($res->num_rows > 0) {
            while($row = $res->fetch_assoc()) {
                $tag = new User($row["Username"],$row["Password"],$row["Fullname"]);
                array_push($ls,$tag);
            }
        }
        $con->close();
        return $ls;
    }

    /**
     * Xác thực user
     * @param $username string Tên đăng nhập
     * @param $username string Mật khẩu
     * @return User hoặc null nếu không tồn tại
     */
    static function authentication ($username, $password, $list) {
        foreach ($list as $key => $value) {
            if ($value->username==$username && $value->password==$password)
                return new Admin($username, $password, $value->fullname);
        }
        return null;
    }
}
?>