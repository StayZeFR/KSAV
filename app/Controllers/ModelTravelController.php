<?php

namespace App\Controllers;

use App\Models\ModeleVoyageModel;
use App\Models\PossederModel;
use App\Models\PrestationModel;
use App\Models\TypeVoyageModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class ModelTravelController extends BaseController
{
    public function viewList(): string
    {
        $manager = new ModeleVoyageModel();
        $builder = $manager->builder();
        $builder->select("modelevoyage.IDMODELEVOYAGE AS ID_MODELEVOYAGE, modelevoyage.NOM AS NOM_MODELEVOYAGE, modelevoyage.DESCRIPTION AS DESCRIPTION_MODELEVOYAGE, modelevoyage.DESTINATION AS DESTINATION_MODELEVOYAGE, modelevoyage.TOUROPERATOR as TOUROPERATOR_MODELEVOYAGE, typevoyage.IDTYPEVOYAGE AS ID_TYPEVOYAGE, typevoyage.LIBELLE AS LIBELLE_TYPEVOYAGE, typevoyage.DESCRIPTION AS DESCRIPTION_TYPEVOYAGE");
        $builder->join("typevoyage", "modelevoyage.IDTYPEVOYAGE = typevoyage.IDTYPEVOYAGE", "left");
        $models = $builder->get()->getResultArray();

        return view("pages/travel/model/list", [ 
            "page" => "modelTravel", 
            "models" => $models 
        ]);
    }

    /**
     * Fonction que retourne la vue d'ajout d'un modèle de voyage
     * 
     * @return string
     */
    public function viewAdd(): string
    {
        $manager = new TypeVoyageModel();
        $typesVoyages = $manager->findAll();

        $manager = new PrestationModel();
        $servives = $manager->findAll();

        return view("pages/travel/model/action", [ 
            "page" => "modelTravel",
            "action" => "add", 
            "typesVoyages" => $typesVoyages,
            "services" => $servives
        ]);
    }

    /**
     * Fonction qui permet d'ajouter un modèle de voyage
     * 
     * @return string
     */
    public function add(): RedirectResponse
    {
        $manager = new ModeleVoyageModel();

        $data = [
            "NOM" => trim($this->request->getPost("name_model-travel")),
            "IDTYPEVOYAGE" => intval($this->request->getPost("type_model-travel")),
            "DESTINATION" => trim($this->request->getPost("destination_model-travel")),
            "DESCRIPTION" => trim($this->request->getPost("description_model-travel")),
            "TOUROPERATOR" => trim($this->request->getPost("touroperator_model-travel"))
        ];

        $manager->insert($data);

        $id = $manager->getInsertID();

        $manager = new PossederModel();

        $services = $this->request->getPost("services_model-travel");

        foreach ($services as $service) {
            $data = [
                "IDMODELEVOYAGE" => $id,
                "IDPRESTATION" => $service
            ];

            $manager->insert($data);
        }

        return redirect()->to(url_to("modelTravelList"));
    }

    /**
     * Fonction que retourne la vue de modification d'un modèle de voyage
     * 
     * @param int $id
     * @return string
     */
    public function viewEdit(int $id): string
    {
        $manager = new ModeleVoyageModel();
        $data = $manager->find($id);

        $manager = new PossederModel();
        $result = $manager->select("IDPRESTATION")->where("IDMODELEVOYAGE", $id)->findAll();

        $data["SERVICES"] = [];

        foreach ($result as $service) {
            array_push($data["SERVICES"], $service["IDPRESTATION"]);
        }

        $manager = new TypeVoyageModel();
        $typesVoyages = $manager->findAll();

        $manager = new PrestationModel();
        $services = $manager->findAll();

        return view("pages/travel/model/action", [ 
            "page" => "modelTravel",
            "action" => "edit", 
            "id" => $id, 
            "data" => $data, 
            "typesVoyages" => $typesVoyages,
            "services" => $services
        ]);
    }

    /**
     * Fonction qui permet de modifier un modèle de voyage
     * 
     * @param int $id
     * @return string
     */
    public function edit(int $id): RedirectResponse
    {
        $manager = new ModeleVoyageModel();

        $data = [
            "NOM" => trim($this->request->getPost("name_model-travel")),
            "IDTYPEVOYAGE" => intval($this->request->getPost("type_model-travel")),
            "DESTINATION" => trim($this->request->getPost("destination_model-travel")),
            "DESCRIPTION" => trim($this->request->getPost("description_model-travel")),
            "TOUROPERATOR" => trim($this->request->getPost("touroperator_model-travel"))
        ];

        $manager->update($id, $data);

        $manager = new PossederModel();

        $manager->where("IDMODELEVOYAGE", $id)->delete();

        $services = $this->request->getPost("services_model-travel");

        foreach ($services as $service) {
            $data = [
                "IDMODELEVOYAGE" => $id,
                "IDPRESTATION" => $service
            ];

            $manager->insert($data);
        }

        return redirect()->to(url_to("modelTravelList"));
    }

    /**
     * Fonction qui permet de supprimer un modèle de voyage
     * 
     * @param int $id
     * @return string
     */
    public function delete(int $id): RedirectResponse
    {
        $manager = new ModeleVoyageModel();
        $manager->delete($id);

        return redirect()->to(url_to("modelTravelList"));
    }

    /**
     * Permet de récupérer les services d'un voyage
     *
     * @param integer $id
     * @return void
     */
    public function getServices(int $id): ResponseInterface
    {
        $manager = new ModeleVoyageModel();
        $services = $manager->getServices($id);

        return $this->response->setJSON($services);
    }

}
