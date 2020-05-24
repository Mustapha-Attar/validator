<?php
namespace rules;
require_once 'rule.php';
class min implements rule{
    /*private properties*/
    private $minLength;
    private $defaultMinLength = 8;
    /*end private properties*/
    public function __construct($minLength){
        $this->minLength = intval($minLength) ?? $this->defaultMinLength;
    }
    public function check($value){
        return strlen($value) >= $this->minLength;
    }
    public function msg(){
        return 'can\'t be less than '.$this->minLength.' characters';
    }
}