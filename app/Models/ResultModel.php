<?php

namespace App\Models;

use CodeIgniter\Model;

class ResultModel extends Model
{
    protected $table = 'result';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_user', 'result'];
}
