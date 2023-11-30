<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class PossederModel extends Model
{
    protected $table = "posseder";
    protected $primaryKey = "IDMODELEVOYAGE";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDMODELEVOYAGE", "IDPRESTATION"];

}