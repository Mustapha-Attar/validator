<?php
namespace rules;
require_once 'rules/rule.php';
class validator{
    /*Properties*/
    public $failed = 0;
    private $dataIndex = 'validatorData';
    private $errors = [];
    private $availableRules = [
        'required','digits', 'email', 'max', 'min',
        'letters', 'lettersAndDigits', 'username',
        'date', 'letter', 'link'
    ];
    private $data = [];
    /*End properties*/
    /*Public methods*/
    public function __construct(array $data){
        $this->data = $data;
    }
    public function validate(array $validationArr){
        foreach($validationArr as $field => $rules):
            if(is_string($rules)):
                //if it's a string then put it as
                // an element in an array with the same name
                // (converting to array)
                $rules = [$rules];
            endif;
            if(in_array('required', $rules) || $this->exists($field)):
                foreach($rules as $ruleName):
                    $ruleObj = null;
                    $ruleNameArr = $this->ruleAsArr($ruleName);
                    $ruleClassName = $ruleNameArr[0];
                    $ruleArgument = $ruleNameArr[1] ?? '';
                    $ruleArgument = trim($ruleArgument);
                    if(in_array($ruleClassName, $this->availableRules)):
                        $this->requireRuleClass($ruleClassName);
                        $className = "rules\\".$ruleClassName;
                        $ruleObj = new $className($ruleArgument);
                    endif;
                    if($ruleObj !== null):
                        if(!$this->check($ruleObj, $field)):
                            $this->addError($field, $ruleObj->msg(), $ruleClassName);
                            $this->fail();
                            break;
                        endif;
                    endif;
                endforeach;
            endif;
        endforeach;
    }
    public function getErrors(){
        return $this->errors;
    }
    public function getError($field){
        return $this->errors[$field] ?? null;
    }
    public function hasError($field){
        return isset($this->errors[$field]);
    }
    public function dataValid(){
        return empty($this->errors);
    }
    public function validatorData(){
        return ['errors' => $this->errors, 'oldInputs' => $this->data];
    }
    public function dataToSession($index = null){
        $in = $index ?? $this->dataIndex;
        return $_SESSION[$in] = $this->validatorData();
    }
    /*End public methods*/
    /*private methods*/
    private function exists($field){
        return isset($this->data[$field]) && !empty($this->data[$field]);
    }
    private function sanitizeInput($value){
        return filter_var($value, FILTER_SANITIZE_STRING);
    }
    private function check(rule $rule, $fieldName){
        $value = $this->sanitizeInput($this->data[$fieldName] ?? null);
        return $rule->check($value);
    }
    private function addError($field, $errMsg, $errType){
        return $this->errors[$field] = ["msg" => $errMsg, "type" => $errType];
    }
    private function ruleAsArr($ruleWithArgument){
        $ruleWithArgument = trim($ruleWithArgument);
        $ruleArr = explode(':', $ruleWithArgument);
        return $ruleArr;
    }
    private function requireRuleClass($className){
        require_once 'rules/'.$className.'.php';
    }
    private function fail(){
        return $this->failed = 1;
    }
    /*End private methods*/
}