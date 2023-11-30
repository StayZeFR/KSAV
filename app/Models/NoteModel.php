<?php
namespace App\Models;

use CodeIgniter\Database\ConnectionInterface;
use CodeIgniter\Model;

class NoteModel extends Model
{
    protected $table = "note";
    protected $primaryKey = "IDAVIS";

    protected $returnType = "array";
    protected $useSoftDeletes = false;

    protected $allowedFields = ["IDPRESTATION", "IDAVIS", "NOTE"];

}