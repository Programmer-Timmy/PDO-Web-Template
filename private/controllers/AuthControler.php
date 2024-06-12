<?php
namespace App\Controllers;
class AuthControler
{
    public static function login(string $username, #[\SensitiveParameter] string $password)
    {
        global $site;
        $database = new Database();
        $user = $database->get(table: $site['user-adminTable'], where:['username' => $username]);
        if (!$user) {
            return null;
            exit();
        }
        if (password_verify($password, $user->password_hash)) {
            $_SESSION[$site['accounts']['sessionName']] = $user->id;
            if ($site['admin']['enabled']) {
                if ($user->admin = 1) {
                    $_SESSION[$site['admin']['sessionName']] = $user->id;
                }
            }
            if ($site['saveUrl']) {
                return $_SESSION['redirect'];
                exit();
            }
            return 'home';
            exit();
        } else {
            return null;
            exit();
        }
    }
}