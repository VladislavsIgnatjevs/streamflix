<?php
/**
 * Created by PhpStorm.
 * User: vignatjevs
 * Date: 15/01/2017
 * Time: 23:16
 */

require_once 'core/include/header.inc.php';



$showerrors = false;




if (!empty($_REQUEST['login-submit'])){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $remember = $_REQUEST['remember'];

    $user = new User();
    if ($user->validateUser($username,$password)){
        $user->getUser($username);
        $user->loginUser($user->username,$user->id, $remember);
        header('Location: videos_main.php');
    } else {
        $errors['bad_user'] = 'User details are not recognized. Please try again using different credentials';
    }



}

if (!empty($_REQUEST['register-submit'])){
    $username = $_REQUEST['username'];
    $password = $_REQUEST['password'];
    $password_confirm = $_REQUEST['confirm-password'];
    $email = $_REQUEST['email'];

    //check if user like this exists
    $user = new User();
    if ($user->isUser($username)) {
        $errors['user_exists'] = 'Sorry, this username is already taken. Take a moment and think about some other ones';
    }
    if (!$user->passwordStrong($password)) {
        $errors['weak_password'] = 'Please make sure that your password contains atleast one number and at least one letter and
    is in the length between 8-50 characters. The following special characters are allowed: !@#$% .';

    }
    if (!$user->passwordsMatch($password,$password_confirm)) {
        $errors['pass_mismatch'] = 'The password you entered mismatch. ';
    }


    if (empty($errors)) {
        //encrypt password

        //register user
        $user->registerUser($username,$email,$password);

        $user->getUser($username);
        $user->loginUser($user->username,$user->id);
        header('Location: videos_main.php');


    }
}

if (!empty($errors)) {
    $showerrors = true;
}





include('core/include/header.html.php');

?>


    <link rel="stylesheet" href="/css/css_login_register.css">
    <script src="/js/login_register.js"></script>



<div class="container">
    <div class="row">
        <div class="col-md-6 col-md-offset-3">
            <div class="panel panel-login">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-lg-12">
                            <form id="login-form" action="#" method="post" role="form" style="display: block;">
                                <h2>LOGIN</h2>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="col-xs-6 form-group pull-left checkbox">
                                    <input id="checkbox1" type="checkbox" name="remember">
                                    <label for="checkbox1">Remember Me</label>
                                </div>
                                <div class="col-xs-6 form-group pull-right">
                                    <input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
                                </div>
                            </form>
                            <form id="register-form" action="#" method="post" role="form" style="display: none;">
                                <h2>REGISTER</h2>
                                <div class="form-group">
                                    <input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
                                </div>
                                <div class="form-group">
                                    <input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
                                </div>
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col-sm-6 col-sm-offset-3">
                                            <input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="panel-heading">
                    <div class="row">
                        <div class="col-xs-6 tabs">
                            <a href="#" class="active" id="login-form-link"><div class="login">LOGIN</div></a>
                        </div>
                        <div class="col-xs-6 tabs">
                            <a href="#" id="register-form-link"><div class="register">REGISTER</div></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php
include('core/include/footer.html.php');