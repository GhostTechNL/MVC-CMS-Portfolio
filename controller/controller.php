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
    public static function setpath($pathname){
        self::$path = $pathname;
    }
    public static function getpath(){
        return self::$path;
    }
    public function getTitle($input1 = "", $input2 = ""){
        return "$input1 | $input2";
    }
    public function getMeta(){
        require self::$path . "/content/mvc_meta.php";
    }
    //
    public function getHeader(){
        if (self::$maintenancemode === false) {
            require self::$path . "/content/header.php";
        }
    }
    //
    public function getFooter(){
        if (self::$maintenancemode === false) {
            require self::$path . "/content/footer.php";
        }
    }
    //
    public function getPage($pagename, $goDefault = false){
        if (self::$maintenancemode === false) {
            $pagedir = self::$path . "/content/". $pagename . "_page.php";
            if (file_exists($pagedir)) {
                $modeldir = self::$path . "/model/". $pagename . "_model.php";
                if (file_exists($modeldir)) {
                    require $modeldir;
                }
                require $pagedir;
            }elseif(empty($pagename) && $goDefault === true){
                if (self::$wwwpath !== "") {
                    header("Location: " . self::$wwwpath . "Home/");
                    die();
                }
                //header("Location: "."https://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI'] . "Home/");
            }else{
                require self::$path . "/content/404.php";
            }
        }else{
            $dirMaintenace = self::$path . "/content/maintenance.php";
            if (file_exists($dirMaintenace)) {
                require $dirMaintenace;
            }
        }
    }
    public function filePushBack(){
        $backdircount = count(controller::getURLValue()) -3;
        $backcsspath = "";
        for ($i=0; $i <= $backdircount; $i++) { 
            $backcsspath .= "../";
        }
        return $backcsspath;
    }
    public function getURLValue($index = ""){
        $url = explode("/", $_SERVER['REQUEST_URI']);
        unset($url[0]);
        if (!empty($index)) {
            if (!empty($url[$index])) {
                return $url[$index];
            }
        }else{
            return $url;
        }
    }
    public function setWWW($link = ""){
        self::$wwwpath = $link;
    }
    public function maintenancemode(){
        $login = $_SESSION['userid'];
        if (empty($login)) {
            self::$maintenancemode = true;
        }
    }
}

?>