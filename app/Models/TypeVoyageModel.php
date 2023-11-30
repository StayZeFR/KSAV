<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class TypeVoyageModel extends Model
{
    protected $table = "typevoyage";
    protected $primaryKey = "IDTYPEVOYAGE";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDTYPEVOYAGE", "LIBELLE", "DESCRIPTION"];

}
