<?php
require_once("include/db_config.php");
require_once("include/classes/ClearInput.php");
require_once("include/classes/Account.php");
require_once("include/classes/Constant.php");
$account = new Account($conn);
if (isset($_POST["submitButton"])) { // if submit button is pressed 
    $username = ClearInput::clearUserName($_POST["username"]);
    $password = ClearInput::clearPassword($_POST["password"]);
    $succes = $account->login($username, $password);

    if ($succes) {
        $_SESSION["userLoggedIn"] = $username;
        header('Location: index.php');
    }
}

function getInputValue($name) // if password wrong all other values stay remain so no need to enter it again
{
    if(isset($_POST[$name]))
    {
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
                <h3>Sign In</h3>
                <span>continue to maniya</span>
            </div>
            <form action="" method="post">
                <?php echo $account->getError(Constant::$loginError) ?>
                <input type="text" name="username" id="username" placeholder="Username" value="<?php getInputValue("username")?>" require>
                <input type="password" name="password" id="password" placeholder="Password" require>
                <input type="submit" value="SUBMIT" name="submitButton">
            </form>
            <span> have account ? Make one <a href="register.php" class="signInMessage">here</a></span>
        </div>
    </div>
</body>

</html>