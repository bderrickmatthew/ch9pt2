<?php
namespace Ninja;

class Authentication
{

    //  DatabaseTable instance -> configured for the table that stores user accounts.
    //  usernameColumn -> stores the login names.
    //  passwordColumn -> stores the password.
    public function __construct(private DatabaseTable $users, private string $usernameColumn, private string $passwordColumn)
    {
        session_start();
    }

    public function login(string $username, string $password)
    {
        $user = $this->users->find($this->usernameColumn, strtolower($username));

        if (!empty($user) && password_verify($password, $user[0][$this->passwordColumn]))
        {
            session_regenerate_id();
            $_SESSION['username'] = $username;
            $_SESSION['password'] = $user[0][$this->passwordColumn];

            return true;
        }
        else
        {
            return false;
        }
    }

    public function isLoggedIn(): bool
    {
        if (empty($_SESSION['username']))
        {
            return false;
        }

        $user = $this->users->find($this->usernameColumn, strtolower($_SESSION['username']));

        if (!empty($user) && $user[0][$this->passwordColumn] === $_SESSION['password'])
        {
            return true;
        }
        else
        {
            return false;
        }
    }

    public function logout()
    {
        unset($_SESSION['username']);
        unset($_SESSION['password']);
        session_regenerate_id();
    }
}
