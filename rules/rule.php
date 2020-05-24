<?php
namespace rules;
interface rule{
    function __construct($argument);
    function check(string $value):bool;
    function msg():string;
}