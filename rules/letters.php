<?php
namespace rules;
require_once 'rule.php';
class letters implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value){
        return ctype_alpha($value);
    }
    public function msg(){
        return 'should include only letters';
    }
}