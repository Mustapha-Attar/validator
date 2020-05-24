<?php
namespace rules;
require_once 'rule.php';
class digits implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value){
        return ctype_digit($value);
    }
    public function msg(){
        return 'should include only digits';
    }
}