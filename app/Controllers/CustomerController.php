<?php

namespace App\Controllers;
use App\Models\ClientModel;
use CodeIgniter\HTTP\RedirectResponse;

class CustomerController extends BaseController
{
    public function viewList(): string
    {
        $manager = new ClientModel();
        $customers = $manager->findAll();

        var_dump($customers);

        return view("pages/customer/list", [ 
            "page" => "customer", 
            "customers" => $customers 
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'ajout d'un client
     *
     * @return string
     */
    public function viewAdd(): string
    {
        return view("pages/customer/action", [ 
            "page" => "customer", 
            "action" => "add" 
        ]);
    }

    /**
     * Permet d'ajouter un client dans la base de données
     *
     * @return RedirectResponse
     */
    public function add(): RedirectResponse
    {
        $manager = new ClientModel();

        $data = [
            "NOM" => str_replace(" ", "", $this->request->getPost("lastname_customer")),
            "PRENOM" => str_replace(" ", "", $this->request->getPost("firstname_customer")),
            "ADRESSE" => trim($this->request->getPost("address_customer")),
            "EMAIL" => str_replace(" ", "", $this->request->getPost("email_customer")),
            "TEL" => str_replace(" ", "", $this->request->getPost("phone_customer"))
        ];

        $manager->insert($data);

        return redirect()->to(url_to("customerViewList"));
    }

    /**
     * Permet d'afficher le formulaire de modification d'un client
     *
     * @param integer $id
     * @return string
     */
    public function viewEdit(int $id): string
    {
        $manager = new ClientModel();
        $data = $manager->find($id);

        return view("pages/customer/action", [
            "page" => "customers",
            "action" => "edit",
            "id" => $id,
            "data" => $data
        ]);
    }

    /**
     * Permet de modifier un client dans la base de données
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function edit(int $id): RedirectResponse
    {
        $manager = new ClientModel();

        $data = [
            "NOM" => str_replace(" ", "", $this->request->getPost("lastname_customer")),
            "PRENOM" => str_replace(" ", "", $this->request->getPost("firstname_customer")),
            "ADRESSE" => trim($this->request->getPost("address_customer")),
            "EMAIL" => str_replace(" ", "", $this->request->getPost("email_customer")),
            "TEL" => str_replace(" ", "", $this->request->getPost("phone_customer"))
        ];

        $manager->update($id, $data);

        return redirect()->to(url_to("customerViewList"));
    }

    /**
     * Permert de supprimer un client de la base de données
     *
     * @param integer $id
     * @return RedirectResponse
     */
    public function delete(int $id): RedirectResponse
    {
        $manager = new ClientModel();
        $manager->delete($id);

        return redirect()->to(url_to("customerViewList"));
    }
}
