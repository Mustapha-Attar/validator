<?php
namespace rules;
require_once 'rule.php';
use DateTime;
class date implements rule{
    private string $format;
    public function __construct($format){
        return $this->format = empty($format) ? 'Y-m-d': $format;
    }
    public function check(string $value):bool{
        $d = DateTime::createFromFormat($this->format, $value);
        return $d && $d->format($this->format) === $value;
    }
    public function msg():string{
        return 'is invalid date with format '.$this->format;
    }
}