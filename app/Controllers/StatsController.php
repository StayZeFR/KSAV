<?php

namespace App\Controllers;

use App\Models\ModeleVoyageModel;
use App\Models\NoteModel;
use App\Models\UtilisateurModel;
use CodeIgniter\HTTP\RedirectResponse;
use CodeIgniter\HTTP\ResponseInterface;

class StatsController extends BaseController
{

    public function view(): string
    {

        $manager = new ModeleVoyageModel();
        $builder = $manager->builder();
        $builder->distinct();
        $builder->select("modelevoyage.IDMODELEVOYAGE AS MODELEVOYAGE_ID, modelevoyage.NOM AS MODELEVOYAGE_NOM");
        $builder->join("voyage", "voyage.IDMODELEVOYAGE = modelevoyage.IDMODELEVOYAGE");
        $builder->join("reservation", "reservation.IDVOYAGE = voyage.IDVOYAGE", "right");
        $travels = $builder->get()->getResultArray();

        $manager = new NoteModel();

        $builder = $manager->builder();
        $builder->select("prestation.LIBELLE AS PRESTATION_LIBELLE, AVG(note.NOTE) AS NOTE_MOYENNE");
        $builder->join("prestation", "prestation.IDPRESTATION = note.IDPRESTATION");
        $builder->groupBy("note.IDPRESTATION");
        $builder->orderBy("note.IDPRESTATION", "ASC");
        $avgNotesServices = $builder->get()->getResultArray();

        $builder = $manager->builder();
        $builder->select("modelevoyage.NOM AS MODELEVOYAGE_NOM, ROUND(AVG(note.NOTE), 2) AS NOTE_MOYENNE");
        $builder->join("avis", "avis.IDAVIS = note.IDAVIS");
        $builder->join("reservation", "reservation.IDAVIS = avis.IDAVIS");
        $builder->join("voyage", "voyage.IDVOYAGE = reservation.IDVOYAGE");
        $builder->join("modelevoyage", "modelevoyage.IDMODELEVOYAGE = voyage.IDMODELEVOYAGE");
        $builder->groupBy("modelevoyage.IDMODELEVOYAGE");
        $builder->orderBy("modelevoyage.IDMODELEVOYAGE", "ASC");
        $avgNotesTravels = $builder->get()->getResultArray();

        return view("pages/stats/stats", [
            "page" => "stats",
            "travels" => $travels,
            "avgNotesServices" => $avgNotesServices,
            "avgNotesTravels" => $avgNotesTravels
        ]);
    }

    /**
     * Fonction qui retourne la moyenne des notes des services par voyage en JSON
     *
     * @param integer $id
     * @return ResponseInterface
     */
    public function getAVGByTravel(int $id): ResponseInterface
    {
        $manager = new NoteModel();

        $builder = $manager->builder();
        $builder->select("prestation.LIBELLE AS PRESTATION_LIBELLE, AVG(note.NOTE) AS NOTE_MOYENNE");
        $builder->join("avis", "avis.IDAVIS = note.IDAVIS");
        $builder->join("reservation", "reservation.IDAVIS = avis.IDAVIS");
        $builder->join("voyage", "voyage.IDVOYAGE = reservation.IDVOYAGE");
        $builder->join("modelevoyage", "modelevoyage.IDMODELEVOYAGE = voyage.IDMODELEVOYAGE");
        $builder->join("prestation", "prestation.IDPRESTATION = note.IDPRESTATION");
        $builder->where("modelevoyage.IDMODELEVOYAGE", $id);
        $builder->groupBy("note.IDPRESTATION");
        $builder->orderBy("modelevoyage.IDMODELEVOYAGE", "ASC");
        $avgNotesServices = $builder->get()->getResultArray();

        return $this->response->setJSON($avgNotesServices);
    }
}
