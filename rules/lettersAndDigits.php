<?php
namespace rules;
require_once 'rule.php';
class lettersAndDigits implements rule{
    public function __construct($ruleAsStr){
        return;
    }
    public function check($value){
        return ctype_alnum($value);
    }
    public function msg(){
        return 'should include only letters and digits';
    }
}