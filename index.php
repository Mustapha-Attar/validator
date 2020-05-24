<?php
session_start();
require_once 'form.php';
$form = new form();
$form->customErrMsg('gender', 'letter', 'is invalid');
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="/styling/style.css">
    <title>Document</title>
</head>
<body>
    <div id="form-holder">
        <h2>Registration</h2>
        <form action="/reg.php" method="POST">
            <div class="input-holder <?php echo $form->errClass('username'); ?>">
                <label for="username" class="label">
                    Username:
                </label>
                <input id="username" type="text" name="username" class="input" value="<?php echo $form->old('username'); ?>" />
                <div class="errMsg">
                    <?php echo $form->getError('username'); ?>
                </div>
            </div>
            <div class="input-holder <?php echo $form->errClass('email'); ?>">
                <label for="email" class="label">
                    Email:
                </label>
                <input id="email" type="text" name="email" class="input" value="<?php echo $form->old('email'); ?>" />
                <div class="errMsg">
                    <?php echo $form->getError('email'); ?>
                </div>
            </div>
            <div class="input-holder <?php echo $form->errClass('phoneNumber'); ?>">
                <label for="phoneNumber" class="label">
                    Phone number:
                </label>
                <input id="phoneNumber" type="text" name="phoneNumber" class="input" value="<?php echo $form->old('phoneNumber'); ?>" />
                <div class="errMsg">
                    <?php echo $form->getError('phoneNumber', 'Phone number'); ?>
                </div>
            </div>
            <div class="input-holder <?php echo $form->errClass('link'); ?>">
                <label for="link" class="label">
                    Link:
                </label>
                <input id="link" type="text" name="link" class="input" value="<?php echo $form->old('link'); ?>" />
                <div class="errMsg">
                    <?php echo $form->getError('link'); ?>
                </div>
            </div>
            <div class="input-holder <?php echo $form->errClass('dob'); ?>">
                <label for="dob" class="label">
                    Date of birth:
                </label>
                <input id="dob" type="date" name="dob" class="input" value="<?php echo $form->old('link'); ?>" />
                <div class="errMsg">
                    <?php echo $form->getError('dob', 'Date of birth'); ?>
                </div>
            </div>
            <div class="input-holder <?php echo $form->errClass('gender'); ?>">
                <label for="dob" class="label">
                    Gender:
                </label>
                <label>
                    Female:
                    <input type="radio" name="gender" value="f"/>
                </label>
                <label>
                    Male:
                    <input type="radio" name="gender" value="m"/>
                </label>
                <div class="errMsg">
                    <?php echo $form->getError('gender'); ?>
                </div>
            </div>
            <div class="input-holder">
                <input type="submit" name="reg" class="submit" value="Submit" />
            </div>
        </form>
    </div>
</body>
</html>