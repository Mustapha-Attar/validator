<?php
namespace rules;
interface rule{
    function __construct($argument);
    function check($value);
    function msg();
}