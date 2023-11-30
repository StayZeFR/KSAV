<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class UtilisateurModel extends Model
{
    protected $table = "utilisateur";
    protected $primaryKey = "IDUTILISATEUR";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDUTILISATEUR", "NOM", "MDP"];

}