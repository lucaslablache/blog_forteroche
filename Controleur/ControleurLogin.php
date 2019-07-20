<?php
require_once 'Vue/Vue.php';
require_once 'Modele/Login.php';

// IMPORTANT hasher le password
// et le stocker dans la BDD

class ControleurLogin
{

    private $login;

    public function __construct()
    {
        $this->login = new Login();
    }

    //$2y$12$Je/ECVsXnVG6hIjyFAbfZuATKJDXp//hquhdOmHrSwp.i4.9h8S6K => 'dechevre' cout 12


    function try_connect ()
    {
        if (!empty($_POST['pseudo']) && !empty($_POST['password']))
        {
            if ($this->login->isPasswordCorrect($_POST['pseudo'],$_POST['password']))
            {
                //on connecte l'admin
                if (session_status() == PHP_SESSION_NONE)
                {
                    session_start();
                }
                $_SESSION['connecte'] = 'admin';
                header('Location: /forteroche/index.php?action=admin');

            }
            else
            {
                throw new Exception("Identifiants incorects");
            }
        }
    }
}