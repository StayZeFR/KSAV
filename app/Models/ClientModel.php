<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class ClientModel extends Model
{
    protected $table = "client";
    protected $primaryKey = "IDCLIENT";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDCLIENT", "NOM", "PRENOM", "ADRESSE", "EMAIL", "TEL"];

}