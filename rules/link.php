<?php
namespace rules;
require_once 'rule.php';
class link implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value){
        return filter_var($value, FILTER_VALIDATE_URL) === $value;
    }
    public function msg(){
        return 'is invalid';
    }
}