<?php
require_once("include/db_config.php");
require_once("include/classes/ClearInput.php");
require_once("include/classes/Account.php");
require_once("include/classes/Constant.php");
$account = new Account($conn);


if (isset($_POST["submitButton"])) { // if submit button is pressed 

    $firstName = ClearInput::clearName($_POST["firstName"]);
    $lastName = ClearInput::clearName($_POST["lastName"]);
    $username = ClearInput::clearUserName($_POST["username"]);
    $email = ClearInput::clearEmail($_POST["email"]);
    $email2 = ClearInput::clearEmail($_POST["email2"]);
    $password = ClearInput::clearPassword($_POST["password"]);
    $password2 = ClearInput::clearPassword($_POST["password2"]);

    $succes = $account->registration($firstName, $lastName, $username, $email, $email2, $password, $password2);

    if ($succes) {
        $_SESSION["userLoggedIn"] = $username;
        header('Location: index.php');
    }
}

function getInputValue($name)
{
    if (isset($_POST[$name])) {
        echo $_POST[$name];
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Maniya</title>
    <link rel="stylesheet" type="text/css " href="Asseset/style/style.css">
</head>

<body>
    <div class="SignInContaier">
        <div class="column">
            <div class="header">
                <img src="Asseset/img/logo.png" alt="Logo" title="Logo">
                <h3>Sign Up</h3>
                <span>continue to maniya</span>
            </div>
            <form action="" method="post">

                <!-- firstNAme -->
                <?php echo $account->getError(Constant::$firstNameError) ?>
                <input type="text" name="firstName" id="firstName" placeholder="First Name" values="<?php getInputValue("firstName") ?>" require>

                <!-- lastname -->
                <?php echo $account->getError(Constant::$lastNameError) ?>
                <input type="text" name="lastName" id="lastName" placeholder="Last Name" values="<?php getInputValue("lastName") ?>" require>

                <!-- username -->
                <?php echo $account->getError(Constant::$userNameError) ?>
                <?php echo $account->getError(Constant::$userNameCheckError) ?>
                <input type="text" name="username" id="username" placeholder="Username" values="<?php getInputValue("username") ?>" require>

                <!-- email -->
                <?php echo $account->getError(Constant::$emailNotMatch) ?>
                <?php echo $account->getError(Constant::$emailNotValid) ?>
                <?php echo $account->getError(Constant::$emailTakenError) ?>
                <input type="email" name="email" id="email" placeholder="Email" values="<?php getInputValue("email") ?>" require>
                <input type="email" name="email2" id="email2" placeholder="Confirm Email" values="<?php getInputValue("email2") ?>" require>

                <!-- password -->
                <?php echo $account->getError(Constant::$passwordIncludeError) ?>
                <?php echo $account->getError(Constant::$passwordLenError) ?>
                <?php echo $account->getError(Constant::$passwordNotMatchError) ?>
                <input type="password" name="password" id="password" placeholder="Password" require>
                <input type="password" name="password2" id="password2" placeholder="Confirm Password" require>
                <input type="submit" value="SUBMIT" name="submitButton">
            </form>
            <span>Already Have account ? Sign in <a href="login.php" class="signInMessage">here</a></span>
        </div>
    </div>
</body>

</html>