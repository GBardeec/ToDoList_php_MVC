<?php

require_once 'MVC/models/UserModel.php';

class UserController
{
    public function login()
    {

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $login = htmlspecialchars($_POST['login']);
            $password = htmlspecialchars($_POST['password']);

            $userModel = new UserModel();
            $loggedIn = $userModel->login($login, $password);

            if ($loggedIn) {
                header('Location: /');
                return;
            } else {
                $registered = $userModel->registerAndLogin($login, $password);
                if ($registered) {
                    header('Location: /');
                    return;
                } else {
                    echo "<script>alert('Пароль не правильный');</script>";
                }
            }
        }

        require_once 'MVC/Views/UserView.php';
    }

    public function logout()
    {
        session_unset();
        session_destroy();

        header('Location: /login');
    }
}