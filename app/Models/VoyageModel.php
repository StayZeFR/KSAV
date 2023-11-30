<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class VoyageModel extends Model
{
    protected $table = "voyage";
    protected $primaryKey = "IDVOYAGE";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDVOYAGE", "IDMODELEVOYAGE", "DATEDEPART"];

}