<?php
require('../Template/Initialization.php');
require(BASEDIR . '/Data/DatabaseUtil.Class.php');
require(BASEDIR . '/Data/UserDataService.Class.php');
require(BASEDIR . '/Model/User.Class.php');

$user_name = DatabaseUtil::sanitize_data_from_form($_POST['input_user_name']);
$password = DatabaseUtil::sanitize_data_from_form($_POST['input_password']);

# Check if there's a user in the db with the same user name
# $dbUser = new User('mandy', 'secret'); #TODO get from the db
$dbUser = User::getUserFromDBByUserName($user_name);

# Compare the passwords
if (isset($dbUser) && password_verify($password, $dbUser->getPassword()))
{
    # if they match set cookie and session value for user and redirect to index page
    # set the session if it hasn't been set
    if (!isset($_SESSION))
    {
        session_start();
    }
    if (isset($_SESSION['LoginError']))
    {
        $_SESSION['LoginError'] = false;
    }
    $_SESSION['User'] = $dbUser->getUserName();
    $_SESSION['UserID'] = $dbUser->getUserID();
    setcookie('User', $dbUser->getUserName(), time() + 60 * 60 * 24 * 10, '/'); // keep user logged in for 10 days via Cookie
    setcookie('UserID', $dbUser->getUserID(), time() + 60 * 60 * 24 * 10, '/'); // keep user logged in for 10 days via Cookie

    header("Location: ../index.php");
    exit;
}
else
{
    # set session variable informing there was a logon error
    $_SESSION['LoginError'] = true;
    # redirect to login page to display the error and have user try again
    header("Location: ../View/Login.php");
    exit;
}

?>