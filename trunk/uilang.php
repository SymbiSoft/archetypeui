<?php

class UILang {
    private $ini;
    private $defolt;
    private $de;

    function __construct($ini) {
        $this->ini = $ini;
    }
    
    function get() {
        echo '1';
    }
    
//find existing language packages    
    function find() {
        $dir = opendir('uilang');
        $llist = array();
        while ($i = readdir($dir)) {
            if ($i != '.' && $i != '..' && is_dir('uilang/'.$i)) {
                if (is_file('uilang/'.$i.'/init.ini')) {
                    $p = parse_ini_file('uilang/'.$i.'/init.ini');
                    if (isset($p['language'])) {
                        $llist[] = array($i, $p['language']);
                    }
                }
            }
        }
        if (count($llist)) {
            sort($llist);
            return $llist;
        }
        else {
            return;
        }
    }

//check session status    
    function session() {
        if (isset($_SESSION['lang'])) {
            return parse_ini_file('uilang/'.$_SESSION['lang'].'/'.$this->ini);
        }
        else {
            return;
        }
    }

}

?>
