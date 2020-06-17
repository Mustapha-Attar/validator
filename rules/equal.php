<?php
namespace valdiator\rules;
require_once 'rule.php';
class equal implements rule{
    private string $matchWith;
    public function __construct($matchWithValue){
        return $this->matchWith = $matchWithValue;
    }
    public function check(string $value):bool{
        return $value === $this->matchWith;
    }
    public function msg():string{
        return 'is incorrect';
    }
}