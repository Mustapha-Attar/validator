<?php
namespace rules;
require_once 'rule.php';
class letter implements rule{
    private array $acceptableAlphabets;
    public function __construct($argument){
        $argument = trim($argument);
        $this->acceptableAlphabets = empty($argument)? []: explode('|', $argument);
    }
    public function check(string $value):bool{
        if(!empty($this->acceptableAlphabets)):
            return in_array($value,$this->acceptableAlphabets);
        else:
            return strlen($value) === 1 && ctype_alpha($value);
        endif;
    }
    public function msg():string{
        if(!empty($this->acceptableAlphabets)):
            $letters = implode($this->acceptableAlphabets, ', ');
            return 'should be one of these letters ('.$letters.')';
        else:
            return 'should be one letter';
        endif;
    }
}