<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ModeleVoyageModel extends Model
{
    protected $table = "modelevoyage";
    protected $primaryKey = "IDMODELEVOYAGE";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDMODELEVOYAGE", "IDTYPEVOYAGE", "NOM", "DESCRIPTION", "DESTINATION", "TOUROPERATOR"];

    /**
     * Permet de récupérer les services d'un voyage
     *
     * @param integer $id
     * @return void
     */
    public function getServices(int $id): array
    {
        $builder = $this->builder();
        $builder->select("prestation.IDPRESTATION AS ID_PRESTATION, prestation.LIBELLE AS LIBELLE_PRESTATION");
        $builder->join("posseder", "posseder.IDMODELEVOYAGE = modelevoyage.IDMODELEVOYAGE", "left");
        $builder->join("prestation", "prestation.IDPRESTATION = posseder.IDPRESTATION", "left");
        $builder->where("modelevoyage.IDMODELEVOYAGE", $id);
        $services = $builder->get()->getResultArray();

        return $services;
    }

}