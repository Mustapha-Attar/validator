<?php
class form{
    /*properties*/
    private string $errClass = 'has-error';
    private array $data = [];
    private array $errors = [];
    private array $oldInputs = [];
    private string $dataIndex = 'validatorData';
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
    public function hasError(string $field):bool{
        return isset($this->errors[$field]);
    }
    public function getError(string $field, ?string $label = null):string{
        $err = $this->errors[$field]['msg'] ?? '';
        $l = $label ?? $field;
        $l = ucfirst(strtolower($l));
        $err = empty($err)? '': $l.' '.$err;
        return $err;
    }
    public function errType(string $field):?string{
        return $this->errors[$field]['type'] ?? null;
    }
    public function old(string $field):string{
        $val = $this->oldInputs[$field] ?? '';
        return htmlspecialchars($val);
    }
    public function errClass(string $field):string{
        return $this->hasError($field)? $this->errClass: '';
    }
    public function success():bool{
        return (bool)sizeof($this->errors);
    }
    public function customErrMsg(string $field, string $type, string $msg):bool{
        if(isset($this->errors[$field]['type']) && $this->errors[$field]['type'] === $type):
            $this->errors[$field]['msg'] = $msg;
            return true;
        endif;
        return false;
    }
    public function setErrorClass(string $errClass):string{
        $oldClass = $this->errClass;
        $this->errClass = $errClass;
        return $oldClass;
    }
    /*end public methods*/
}