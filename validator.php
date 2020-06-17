<?php
require_once 'rules/rule.php';
use rules\rule;
class validator{
    /*Properties*/
    public bool $failed = false;
    private string $dataIndex = 'validatorData';
    private array $errors = [];
    private array $availableRules = [
        'required','digits', 'email', 'max', 'min',
        'letters', 'lettersAndDigits', 'username',
        'date', 'letter', 'link', 'equal', 'match'
    ];
    private array $data;
    /*End properties*/
    /*Public methods*/
    public function __construct(array $data){
        $this->data = $data;
    }
    public function validate(array $validationArr):void{
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
    public function getErrors():array{
        return $this->errors;
    }
    public function getError(string $field):?string{
        return $this->errors[$field] ?? null;
    }
    public function hasError(string $field):bool{
        return isset($this->errors[$field]);
    }
    public function dataValid():bool{
        return empty($this->errors);
    }
    public function validatorData():array{
        return ['errors' => $this->errors, 'oldInputs' => $this->data];
    }
    public function dataToSession(?string $index = null):array{
        $in = $index ?? $this->dataIndex;
        return $_SESSION[$in] = $this->validatorData();
    }
    /*End public methods*/
    /*private methods*/
    private function exists(string $field):bool{
        return isset($this->data[$field]) && !empty($this->data[$field]);
    }
    private function sanitizeInput($value):string{
        return filter_var($value, FILTER_SANITIZE_STRING);
    }
    private function check(rule $rule, string $fieldName):bool{
        $value = $this->sanitizeInput($this->data[$fieldName] ?? null);
        return $rule->check($value);
    }
    private function addError(string $field, string $errMsg, string $errType):array{
        return $this->errors[$field] = ["msg" => $errMsg, "type" => $errType];
    }
    private function ruleAsArr(string $ruleWithArgument):array{
        $ruleWithArgument = trim($ruleWithArgument);
        return explode(':', $ruleWithArgument);
    }
    private function requireRuleClass(string $className):void{
        require_once 'rules/'.$className.'.php';
    }
    private function fail():void{
        $this->failed = true;
    }
    /*End private methods*/
}