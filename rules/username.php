<?php
namespace rules;
require_once 'rule.php';
class username implements rule{
    public function __construct($argument){
        return;
    }
    public function check($value){
        return !preg_match('/[^A-Za-z0-9._]+/', $value);
    }
    public function msg(){
        return 'should include only [letters, digits, _ .]';
    }
}