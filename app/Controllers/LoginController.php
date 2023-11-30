<?php

namespace App\Controllers;

use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RedirectResponse;

class LoginController extends BaseController
{

    public function view(): string
    {
        return view("pages/login");
    }

    /**
     * Fonction de connexion à l'application (POST)
     */
    public function login(): RedirectResponse
    {
        $manager = new UtilisateurModel();

        $login = $this->request->getPost("login");
        $password = $this->request->getPost("password");

        if (!empty($login) || !empty($password)) {
            $user = $manager->where("NOM", $login)->first();
            if (!empty($user)) {
                if (password_verify($password, $user["MDP"])) {
                    session()->set("isLoggedIn", true);
                    return redirect()->to(url_to("homeView"));
                } else {
                    session()->setFlashdata("error", "Identifiants incorrects");
                    return redirect()->to(url_to("loginView"));
                }
            } else {
                session()->setFlashdata("error", "Identifiants incorrects");
                return redirect()->to(url_to("loginView"));
            }
        } else {
            session()->setFlashdata("error", "Veuillez remplir tous les champs");
            return redirect()->to(url_to("loginView"));
        }
    }

    /**
     * Fonction de déconnexion de l'application
     */
    public function logout(): RedirectResponse
    {
        session()->destroy();
        return redirect()->to(url_to("loginView"));
    }
}
