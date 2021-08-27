<?php

/**
 * The brian
 */
class controller
{
	protected static $path = "";
    protected static $mainenancemode = false;
    //
    public static function setpath($pathname){
        self::$path = $pathname;
    }
    public function getTitle($input1 = "", $input2 = ""){
        return "$input1 | $input2";
    }
    public function getMeta(){
        require self::$path . "/content/mvc_meta.php";
    }
    //
    public function getHeader(){
        if (self::$mainenancemode === false) {
            require self::$path . "/content/header.php";
        }
    }
    //
    public function getFooter(){
        if (self::$mainenancemode === false) {
            require self::$path . "/content/footer.php";
        }
    }
    //
    public function getPage($pagename, $goDefault = false){
        if (self::$mainenancemode === false) {
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
        }else{
            require self::$path . "/content/mainenance.php";
        }
    }
}

?>