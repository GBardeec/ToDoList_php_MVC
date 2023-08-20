<?php

class UserController
{
    public function login()
    {
        if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['login']) && isset($_POST['password'])) {
            $login = $_POST['login'];
            $password = $_POST['password'];

            $userModel = new UserModel();
            $loggedIn = $userModel->login($login, $password);

            if ($loggedIn) {
                header('Location: /');
                return;
            } else {
                $userExists = $userModel->checkUserExists($login);
                if ($userExists) {
                    header('Location: /login');
                } else {
                    $registered = $userModel->registerAndLogin($login, $password);
                    if ($registered) {
                        header('Location: /');
                        return;
                    }
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
