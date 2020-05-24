<?php
namespace rules;
require_once 'rule.php';
class min implements rule{
    /*private properties*/
    private int $minLength;
    private int $defaultMinLength = 8;
    /*end private properties*/
    public function __construct($minLength){
        $this->minLength = intval($minLength) ?? $this->defaultMinLength;
    }
    public function check($value):bool{
        return strlen($value) >= $this->minLength;
    }
    public function msg():string{
        return 'can\'t be less than '.$this->minLength.' characters';
    }
}