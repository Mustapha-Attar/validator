<?php
namespace rules;
require_once 'rule.php';
class email implements rule{
    public function __construct($argument){
        return;
    }
    public function check(string $value):bool{
        return filter_var($value, FILTER_VALIDATE_EMAIL) === $value;
    }
    public function msg():string{
        return 'is invalid';
    }
}