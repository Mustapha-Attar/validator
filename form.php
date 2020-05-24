<?php
class form{
    /*properties*/
    private $errClass = 'has-error';
    private $data = [];
    private $errors = [];
    private $oldInputs = [];
    private $dataIndex = 'validatorData';
    /*end properties*/
    /*public methods*/
    public function __construct(array $data = null){
        if($data !== null):
            $this->data = $data;
        else:
            $this->data = $_SESSION[$this->dataIndex] ?? ["errors" => [], "oldInputs" => []];
            unset($_SESSION[$this->dataIndex]);
        endif;
        $this->oldInputs = $this->data['oldInputs'];
        $this->errors = $this->data['errors'];
    }
    public function hasError($field){
        return isset($this->errors[$field]);
    }
    public function getError($field, $label = null){
        $err = $this->errors[$field]['msg'] ?? '';
        $l = $label ?? $field;
        $l = ucfirst(strtolower($l));
        $err = empty($err)? '': $l.' '.$err;
        return $err;
    }
    public function errType($field){
        return $this->errors[$field]['type'] ?? null;
    }
    public function old($field){
        $val = $this->oldInputs[$field] ?? '';
        return htmlspecialchars($val);
    }
    public function errClass($field){
        return $this->hasError($field)? $this->errClass: '';
    }
    public function success(){
        return sizeof($this->errors);
    }
    public function customErrMsg($field, $type, $msg){
        if(isset($this->errors[$field]['type']) && $this->errors[$field]['type'] === $type):
            $this->errors[$field]['msg'] = $msg;
            return true;
        endif;
        return false;
    }
    public function setErrorClass($errClass){
        return $this->errClass = $errClass;
    }
    /*end public methods*/
}