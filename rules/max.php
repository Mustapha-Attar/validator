<?php
namespace rules;
require_once 'rule.php';
class max implements rule{
    /*private properties*/
    private int $maxLength;
    private int $defaultMaxLength = 8;
    /*end private properties*/
    public function __construct($maxLength){
        $this->maxLength = intval($maxLength) ?? $this->defaultMaxLength;
    }
    public function check(string $value):bool{
        return strlen($value) <= $this->maxLength;
    }
    public function msg():string{
        return 'can\'t be more than '.$this->maxLength.' characters';
    }
}