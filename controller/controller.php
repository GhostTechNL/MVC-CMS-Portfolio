<?php

/**
 * The brian of the MVC
 */
class controller
{
	protected static $path = "";
    protected static $maintenancemode = false;
    protected static $wwwpath = "";
    //
    public static function url_check($word = ""){
        $is_found = false;
        $url = explode("/", $_SERVER['REQUEST_URI']);
        foreach ($url as $key => $value) {
            if ($value == $word) {
                $is_found = true;
                break;
            }
        }
        return $is_found;
    }
    public static function setpath($pathname){
        self::$path = $pathname;
    }
    public static function getpath(){
        return self::$path;
    }
    public static function getTitle($input1 = "", $input2 = ""){
        if (self::$maintenancemode === false || controller::url_check("admin") == true) {
            return "$input1 | $input2";
        }else{
            return "Maintenance | $input2";
        }
    }
    public static function getMeta(){
        require self::$path . "/content/mvc_meta.php";
    }
    //
    public static function getHeader(){
        if (self::$maintenancemode === false) {
            if (isset($_SESSION['userid']) && controller::url_check("admin") == true ) {
                require self::$path . "/admin/header.php";
            }else{
                if (!controller::url_check("admin")) {
                require self::$path . "/content/header.php";
                }
            }
        }
    }
    //
    public static function getFooter(){
        if (self::$maintenancemode === false) {
            if (isset($_SESSION['userid']) && controller::url_check("admin") == true) {
                require self::$path . "/admin/footer.php";
            }else{
                require self::$path . "/content/footer.php";
            }
        }
    }
    //
    public static function getPage($pagename, $goDefault = false){
        $pagename = strtolower($pagename);
        if (empty($_SERVER['HTTPS']) || $_SERVER['HTTPS'] === "off" && self::$wwwpath !== "") {
            header("Location: " . self::$wwwpath);
        }
        if (controller::url_check("admin")) {
            if (controller::getURLValue(1,"short") == "Login" && !isset($_SESSION['userid'])) {
                $pagedir = self::$path . "/admin/content/login_page.php";
                $modeldir = self::$path . "/admin/model/login_model.php";
                require $modeldir;
                require $pagedir;
            }elseif(controller::getURLValue(1,"short") == "Login" && isset($_SESSION['userid'])){
                header("Location: " . self::$wwwpath . "admin/Home/");
            }elseif(empty($pagename) && $goDefault === true){
                header("Location: " . self::$wwwpath . "admin/Home/");
            }elseif (isset($_SESSION['userid'])) {
                $pagedir = self::$path . "/admin/content/". $pagename ."_page.php";
                if (file_exists($pagedir)) {
                    $modeldir = self::$path . "/admin/model/". $pagename ."_model.php";
                    if (file_exists($modeldir)) {
                        require $modeldir;
                    }
                    echo "<div class='content' id='content'>";
                    require $pagedir;
                    echo "</div>";
                }else{
                    echo "<div class='content' id='content'>";
                    require self::$path . "/content/404.php";
                    echo "</div>";
                }
            }else{
                header("Location: " . self::$wwwpath . "admin/Login/");
            }
        }elseif (self::$maintenancemode === false) {
            $pagedir = self::$path . "/content/". $pagename . "_page.php";
            if (file_exists($pagedir)) {
                $modeldir = self::$path . "/model/". $pagename . "_model.php";
                if (file_exists($modeldir)) {
                    require $modeldir;
                }
                echo "<div class='content' id='content'>";
                require $pagedir;
                echo "</div>";
            }elseif(empty($pagename) && $goDefault === true){
                if (self::$wwwpath !== "") {
                    header("Location: " . self::$wwwpath . "Home/");
                }else{
                    header("Location: " . $_SERVER['DOCUMENT_ROOT'] . "Home/");
                }
            }else{
                echo "<div class='content' id='content'>";
                require self::$path . "/content/404.php";
                echo "</div>";
            }
        }else{
            $dirMaintenace = self::$path . "/content/maintenance.php";
            if (file_exists($dirMaintenace)) {
                require $dirMaintenace;
            }
        }
    }
    public static function getURLValue($index = "",$type = ""){
        $type = strtolower($type);
        if ($type == "" || $type == "long") {
            $type = $_SERVER['REQUEST_URI'];
        }elseif ($type == "short" || $type == "param") {
            if (!empty($_GET['page'])) {
                $type = "/". $_GET['page'];
            }
        }elseif ($type == "count") {
            $type = $_GET['page'];
            $type = explode("/", $type);
            return count($type) -1;
        }
        $url = explode("/", $type);
        if (!empty($index)) {
            if (!empty($url[$index])) {
                return $url[$index];
            }
        }else{
            return $url;
        }
    }
    public static function Weblink($link = ""){
        if (!empty($link)) {
            self::$wwwpath = $link;
        }
        return self::$wwwpath;
    }
    public static function set_errorMessage($message = "", $multiple = false){
        if ($multiple === true) {
            $_SESSION['error'] .= $message;
        }else{
            $_SESSION['error'] = $message;
        }
    }
    public static function get_errorMessage($dothis = "",$whenclear = 1){
        $dothis = strtolower($dothis);
        if (isset($_SESSION['error'])) {
            $error = $_SESSION['error'];
            if ($dothis == "get" || $dothis == "") {
                return $error;
            }elseif ($dothis == "clear") {
                if (controller::getURLValue(1,'count') <= $whenclear) {
                    controller::clearMessage("error");
                }
                return $error;
            }
        }
    }
    public static function set_noteMessage($message = "", $multiple = false){
        if ($multiple === true) {
            $_SESSION['notifi'] .= $message;
        }else{
            $_SESSION['notifi'] = $message;
        }
    }
    public static function get_noteMessage($dothis = "",$whenclear = 1){
        $dothis = strtolower($dothis);
        if (isset($_SESSION['notifi'])) {
            $note = $_SESSION['notifi'];
            if ($dothis == "get" || $dothis == "") {
                return $note;
            }elseif ($dothis == "clear") {
                if (controller::getURLValue(1,'count') <= $whenclear) {
                    controller::clearMessage("notifi");
                }
                return $note;
            }
        }
    }
    public static function clearMessage($type = ""){
        if (isset($_SESSION['notifi']) && $type == "notifi") {
            unset($_SESSION['notifi']);
        }
        if (isset($_SESSION['error']) && $type == "error") {
            unset($_SESSION['error']);
        }
    }
    public static function maintenancemode(){
        if (!isset($_SESSION['userid'])) {
            self::$maintenancemode = true;
        }
        return true;
    }
}

?>