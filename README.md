# validator
Validator (with rules classes) &amp; form class that help you valdating data in server side using PHP OOP
## Installation
```bash
git clone https://github.com/Mustapha-Attar/validator.git
```
## Available rules
Their files can be found at: [available rules](https://github.com/Mustapha-Attar/validator/tree/master/rules)
* required
* digits
* email
* max
* min
* letters
* lettersAndDigits
* username
* date
* letter
* link
* equal
* match
## Usage
### Validation process
```php
<?php
session_start();
$validator = new validator($_POST);
$validator->validate([
  "email" => ['required', 'email', 'max: 50'],
  "phoneNumber" => ['required', 'digits', 'max: 11', 'min: 6'],
  "username" => ['required', 'username', 'min: 2', 'max: 50'],
  "dob" => ['required', 'date'],
  "gender" => ['required', 'letter: m|f'],
  "link" => ['link'],
  "password" => ['required', 'min: 6'],
  "passwordConfirmation" => ['required', 'match: password']
]);
if($validator->failed):
    //will send old inputs and errors (placement and errors messages)
    //to session so that they can be used in the frontend
    $validator->dataToSession();
    header("Location: /index.php");
    exit;
else://data is valid
    echo 'passed';
endif;
```
### Error display using 'Form' class
<div class="errMsg"><?php echo $form->getError('link'); ?></div>
#### Customising error messages
```php
<?php
$form->customErrMsg('link', 'link', 'is invalid link');//string $inputName, string $errType, string $newErrorMsg
```
In the new error message don't include a label or field name it'll get inserted at the begining of the error message later.

It's (The field name that should appear in the error message) customisable as well.

If you have an input that looks like this:
```html
<input type="text" name="phoneNumber" />
```
then turn the error message from this form: "phoneNumber is invalid"
into: "Phone number is invalid"
```php
<?php
echo $form->getError('phoneNumber', 'Phone number');
```
1st parameter: (original) field name; 2nd parameter: a field name that should appear in the error message

#### Customising error class
```php
$form->setErrorClass(string $newErrClass);
```
So now when using:
```html
<div class="input-holder <?php echo $form->errClass('username'); ?>">
```
, that will add the new class, if the field that named 'username' has an error
#### Get old entered value
```html
<input id="link" type="text" name="link" class="input" value="<?php echo $form->old('link'); ?>" />
```
In case you have a password input you can just skip this step
```html
<input id="password" type="password" name="password" class="input" value="" />
```
### Complete example
```php
<?php
session_start();
require_once 'form.php';
$form = new form();
$form->customErrMsg('link', 'link', 'is invalid link');
$form->setErrorClass('has-error');
?>
```
```html
<form action="/reg.php" method="POST">
  <div class="input-holder <?php echo $form->errClass('link'); ?>">
    <label for="link" class="label">Profile link:</label>
      <input id="link" type="text" name="link" class="input" value="<?php echo $form->old('link'); ?>" />
      <div class="errMsg"><?php echo $form->getError('link'); ?></div>
  </div>
</form>
```
