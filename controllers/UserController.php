<?php


class UserController
{
    public function actionUserLogIn()
    {
       $user = new UserModel();

        if (!UserModel::isUserBlocked()) {
            if (UserModel::checkLoginPassword()) {
                /*successfully login*/
                $_SESSION [ 'user' ] = [ "name" => $_POST['name'] ];
            } else {
                /*use rest of attempts to log in*/
                if ($user->getLoginAttempt($_POST['name']) > ATTEMPT_LIMIT) {
                    $user->BlockUser();
                }
            }
        } else {
            if ($user->UnBlockUser()) {
                if (UserModel::checkLoginPassword()) {
                    /*successfully login*/
                    $_SESSION [ 'user' ] = [ "name" => $_POST['name'] ];
                } else {
                    /*use rest of attempts to log in*/
                    if ($user->getLoginAttempt($_POST['name']) > ATTEMPT_LIMIT) {
                        $user->BlockUser();
                    }
                }
            }
        }

    }
}