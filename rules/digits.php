<?php
namespace rules;
require_once 'rule.php';
class digits implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value):bool{
        return ctype_digit($value);
    }
    public function msg():string{
        return 'should include only digits';
    }
}