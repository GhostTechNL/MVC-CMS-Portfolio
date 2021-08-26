<?php

/**
 * The brian
 */
class controller
{
	protected static $path = "";
    //
    public static function setpath($pathname){
        self::$path = $pathname;
    }
    public function getMeta(){
        require self::$path . "/content/mvc_meta.php";
    }
    //
    public function getHeader(){
        require self::$path . "/content/header.php";
    }
    //
    public function getFooter(){
        require self::$path . "/content/footer.php";
    }
    //
    public function getPage($pagename, $goDefault = false){
        $pagedir = self::$path . "/content/". $pagename . "_page.php";
        if (file_exists($pagedir)) {
            $modeldir = self::$path . "/model/". $pagename . "_model.php";
            if (file_exists($modeldir)) {
                require $modeldir;
            }
            require $pagedir;
        }elseif(empty($pagename) && $goDefault === true){
            header("Location: ?page=Home");
        }else{
            require self::$path . "/content/404.php";
        }
    }
}

?>