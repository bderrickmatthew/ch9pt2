<?php
namespace Ijdb\Controllers;

use Ninja\DatabaseTable;

class Joke
{

    private $authorsTable;
    private $jokesTable;

    public function __construct(DatabaseTable $jokesTable, DatabaseTable $authorsTable)
    {
        $this->jokesTable   = $jokesTable;
        $this->authorsTable = $authorsTable;
    }

    public function home()
    {
        $title = 'Internet Joke Database';

        return ['template' => 'home.html.php',
            'title' => $title,
            'variables' => []
        ];
    }

    public function deleteSubmit()
    {
        $this->jokesTable->delete('id', $_POST['id']);

        header("location: /joke/list");
    }

    /*  
        public function delete()
        {
        }
    */

    public function list()
    {
        $result = $this->jokesTable->findAll();
        $jokes  = [];

        foreach ($result as $joke)
        {
            $author = $this->authorsTable->find('id', $joke['authorId'])[0];

            $jokes[] = [
                'id' => $joke['id'],
                'joketext' => $joke['joketext'],
                'jokedate' => $joke['jokedate'],
                'name' => $author['name'],
                'email' => $author['email']
            ];
        }

        $title      = 'Joke List';
        $totalJokes = $this->jokesTable->total();

        return ['template' => 'jokes.html.php',
            'title' => $title,
            'variables' => [
                'totalJokes' => $totalJokes,
                'jokes' => $jokes
                ]
            ];
    }

    public function editSubmit()
    {
        $joke             = $_POST['joke'];
        $joke['jokedate'] = new \DateTime();
        $joke['authorId'] = 1;

        $this->jokesTable->save($joke);

        header("location: /joke/list");
    }

    public function edit($id = null)
    {

        if (isset($id))
        {
            $joke = $this->jokesTable->find('id', $id)[0] ?? null;
        }
        else
        {
            $joke = null;
        }

        $title = 'Edit Joke';

        return ['template' => 'editjoke.html.php',
            'title' => $title,
            'variables' => [
                'joke' => $joke ?? null
                ]
            ];
    }

}
