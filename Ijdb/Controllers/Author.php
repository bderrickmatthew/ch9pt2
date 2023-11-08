<?php
namespace Ijdb\controllers;

use Ninja\DatabaseTable;

class Author
{
    public function __construct(private DatabaseTable $authorsTable)
    {
    }

    public function registrationForm()
    {
        return [
                'template' => 'register.html.php',
                'title' => 'Register an account'
            ];
    }

    public function success()
    {
        return [
            'template' => 'registersuccess.html.php',
            'title' => 'Registration Successful'
        ];
    }

    public function registrationFormSubmit()
    {
        $author = $_POST['author'];

        // starting with an empty array
        $errors = [];

        /* IGNORE THIS COMMENT! 
        //assume that the data is valid to begin with
        //$valid = true; is removed since if $errors array is still empty, we know there are errors.
        
        // but if any of the fields is left blank, set $valid to false
        */

        // empty() is used because it will catch invalid form submissions without
        // causing an error.
        // if any fields have been left blank, write an error to the error.

        if (empty($author['name']))
        {
            $errors[] = 'Name cannot be blank';
        }

        if (empty($author['email']))
        {
            $errors[] = 'Email cannot be blank';
        }
        // check if the email is valid.
        elseif (filter_var($author['email'], FILTER_VALIDATE_EMAIL) == false)
        {
            $errors[] = 'Invalid email address';
        }
        else
        {
            // if the email isn't blank and valid, convert the email to lowercase.
            $author['email'] = strtolower($author['email']);

            // search for the lowercase version of $author['email']
            // check whether an email address already exists in the database
            if (count($this->authorsTable->find('email', $author['email'])) > 0)
            {
                $errors[] = 'That email address is already registered!';
            }
        }

        if (empty($author['password']))
        {
            $errors[] = 'Password cannot be blank';
        }

        /*
        // old comment->ignore: if $valid is still true, no fields were blank and the data can be added
         //if ($errors == true)
        //{
            //$this->authorsTable->save($author);

            //header('Location: /author/success');
        //} 

        // If the $errors array is still empty, no fields were blank and the data can be added.
        //if (empty($errors))
        */

        // If there are no errors, proceed with saving the record in the database.
        if (count($errors) === 0)
        {
            // hash the password before saving it to the database
            $author['password'] = password_hash($author['password'], PASSWORD_DEFAULT);

            // when submitted, the $author variable now contains 
            // a lowercase value for email and a hashed password        
            $this->authorsTable->save($author);

            header('Location: /author/success');
        }
        else
        {
            // if the data is not valid, show the form again.
            return [
                'template' => 'register.html.php',
                'title' => 'Register an account',
                'variables' => [
                    'errors' => $errors,
                    'author' => $author
                ]
            ];
        }
    }
}
