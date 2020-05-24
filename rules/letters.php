<?php
namespace rules;
require_once 'rule.php';
class letters implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value):bool{
        return ctype_alpha($value);
    }
    public function msg():string{
        return 'should include only letters';
    }
}