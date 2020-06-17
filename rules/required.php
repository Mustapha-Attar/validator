<?php
namespace rules;
require_once 'rule.php';
class required implements rule{
    public function __construct($argument){
        echo 'init required object <br />';
        return;
    }
    public function check($value):bool{
        return !empty($value);
    }
    public function msg():string{
        return 'is required';
    }
}