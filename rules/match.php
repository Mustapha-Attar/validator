<?php
namespace valdiator\rules;
require_once 'rule.php';
class match implements rule{
    private string $matchWith;
    public function __construct($matchWithValue){
        return $this->matchWith = $matchWithValue;
    }
    public function check(string $value):bool{
        return $value === $this->matchWith;
    }
    public function msg():string{
        return 'does\'t match the original one';
    }
}