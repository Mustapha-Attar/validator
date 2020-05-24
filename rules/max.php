<?php
namespace rules;
require_once 'rule.php';
class max implements rule{
    /*private properties*/
    private $maxLength;
    private $defaultMaxLength = 8;
    /*end private properties*/
    public function __construct($maxLength){
        $this->maxLength = intval($maxLength) ?? $this->defaultMaxLength;
    }
    public function check($value){
        return strlen($value) <= $this->maxLength;
    }
    public function msg(){
        return 'can\'t be more than '.$this->maxLength.' characters';
    }
}