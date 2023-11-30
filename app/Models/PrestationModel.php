<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PrestationModel extends Model
{
    protected $table = "prestation";
    protected $primaryKey = "IDPRESTATION";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDPRESTATION", "NOM", "DESCRIPTION"];

}