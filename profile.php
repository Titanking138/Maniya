<?php
    require_once './include/header.php';
?>

<div class="settingsContainer column">
    <div class="formSection">
        <form method="POST">
            
            <h2>User details</h2>
            <input type="text" id="firstName" name="firstName" placeholder="first name">
            <input type="text" id="lastName" name="lastName" placeholder="last name">
            <input type="email" id="email" name="email" placeholder="email">
            
            <input type="submit" value="Save" name="saveDetailsButton">
        </form>
        <form method="POST">
            
            <h2>Reset Password</h2>
            <input type="password" id="oldPassword" name="oldPassword" placeholder="Old Password">
            <input type="password" id="newPassword" name="newPassword" placeholder="new password">
            <input type="password" id="newPassword2" name="newPassword2" placeholder="confirm new Password">
            
            <input type="submit" value="Save" name="savepasswordButton">
        </form>
    </div>
</div>