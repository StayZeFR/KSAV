<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\ReservationModel;
use App\Models\AvisModel;
use App\Models\ModeleVoyageModel;
use App\Models\VoyageModel;
use App\Models\ClientModel;
use CodeIgniter\HTTP\RedirectResponse;

class ReviewController extends BaseController
{
    public function viewList(): string
    {
        $manager = new ReservationModel();
        $builder = $manager->builder();
        $builder->select("reservation.IDRESERVATION AS ID_RESERVATION, avis.DATEAVIS AS DATE_AVIS, client.IDCLIENT AS ID_CLIENT, client.NOM AS NOM_CLIENT, client.PRENOM AS PRENOM_CLIENT, voyage.IDVOYAGE AS ID_VOYAGE, voyage.IDMODELEVOYAGE AS ID_MODELEVOYAGE, modelevoyage.IDMODELEVOYAGE AS ID_MODELEVOYAGE, modelevoyage.NOM AS NOM_MODELEVOYAGE, avis.IDAVIS AS ID_AVIS");
        $builder->join("avis", "avis.IDAVIS = reservation.IDAVIS", "right");
        $builder->join("client ", "client.IDCLIENT = reservation.IDCLIENT");
        $builder->join("voyage  ", "voyage.IDVOYAGE = reservation.IDVOYAGE");
        $builder->join("modelevoyage", "modelevoyage.IDMODELEVOYAGE = voyage.IDMODELEVOYAGE");
        $reviews = $builder->get()->getResultArray();

        $manager = new VoyageModel();
        $travels = $manager->findAll();
        $canAdd = count($travels) > 0;

        $manager = new ClientModel();
        $customers = $manager->findAll();
        $canAdd = $canAdd && (count($customers) > 0);

        return view("pages/review/list", [
            "page" => "review", 
            "reviews" => $reviews,
            "canAdd" => $canAdd
        ]);
    }

    /**
     * Permet d'afficher le formulaire d'ajout d'un avis
     *
     * @return string
     */
    public function viewAdd(): string
    {
        $manager = new ModeleVoyageModel();
        $travels = $manager->findAll();

        $manager = new ClientModel();
        $customers = $manager->findAll();

        return view("pages/review/action", [
            "page" => "review",
            "action" => "add",
            "travels" => $travels,
            "customers" => $customers
        ]);
    }

    /**
     * Fonction qui permet d'ajouter un avis
     * 
     * @return string
     */
    public function add(): RedirectResponse
    {
        $manager = new AvisModel();
        $data = [
            "POINTSPOSITIFS" => trim($this->request->getPost("positifs-review")),
            "POINTSNEGATIFS" => trim($this->request->getPost("negatifs-review")),
            "DATEAVIS" => date("Y-m-d")
        ];
        $manager->insert($data);

        $id = $manager->getInsertID();

        $manager = new ReservationModel();
        $data = [
            "IDRESERVATION" => str_replace(" ", "", $this->request->getPost("reservation-review")),
            "IDVOYAGE" => $this->request->getPost("id_travel-review"),
            "IDCLIENT" => str_replace(" ", "", $this->request->getPost("client-review")),
            "IDAVIS" => $id
        ];
        
        if (strlen($data["IDRESERVATION"]) < 5) {            
            session()->setFlashdata("error", "N°Réservation inférieur à 5 caractères");
            return redirect()->to(url_to("reviewViewAdd"));
        }
        
        $manager->insert($data);
        
        $manager = new NoteModel();
        $data = [];
        foreach ($this->request->getPost() as $key => $value) {
            if (str_contains($key, "note_")) {
                $service = explode("*", $key)[1];
                $data[] = [
                    "IDPRESTATION" => $service,
                    "IDAVIS" => $id,
                    "NOTE" => $value
                ];
            }
        }
        $manager->insertBatch($data);

        return redirect()->to(url_to("reviewViewList"));
    }

    /**
     * Fonction qui retourne la vue des details de l'avis utilisateur
     * 
     * @param int $id
     * @return string
     */
    public function viewDetails(int $id): string
    {       
        $manager = new AvisModel();
        $builder = $manager->builder();
        $builder->select("reservation.IDRESERVATION AS ID_RESERVATION, reservation.IDVOYAGE AS ID_VOYAGE, reservation.IDCLIENT AS ID_CLIENT, avis.IDAVIS AS ID_AVIS, avis.POINTSPOSITIFS AS AVIS_POINTSPOSITIFS, avis.POINTSNEGATIFS AS AVIS_POINTSNEGATIFS, avis.DATEAVIS AS DATE_AVIS, client.NOM AS CLIENT_NOM, client.PRENOM AS CLIENT_PRENOM, voyage.DATEDEPART AS DATE_DEPART, modelevoyage.NOM AS MODELEVOYAGE_NOM");
        $builder->join("reservation", "reservation.IDAVIS = avis.IDAVIS");
        $builder->join("client", "client.IDCLIENT = reservation.IDCLIENT");
        $builder->join("voyage","voyage.IDVOYAGE = reservation.IDVOYAGE");
        $builder->join("modelevoyage","modelevoyage.IDMODELEVOYAGE = modelevoyage.IDMODELEVOYAGE");
        $builder->where("avis.IDAVIS", $id);
        $review = $builder->get()->getResultArray()[0];

        $manager = new NoteModel();
        $builder = $manager->builder();
        $builder->select("note.NOTE AS NOTE_NOTE, prestation.LIBELLE AS PRESTATION_LIBELLE");
        $builder->join("prestation","prestation.IDPRESTATION = note.IDPRESTATION");
        $builder->where("note.IDAVIS", $id);
        $notes = $builder->get()->getResultArray();

        return view("pages/review/action", [ 
            "page" => "review", 
            "action" => "view",
            "review" => $review, 
            "notes" => $notes,
            "id" => $id
        ]);
    }
}

