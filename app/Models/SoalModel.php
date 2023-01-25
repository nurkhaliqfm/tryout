<?php

namespace App\Models;

use CodeIgniter\Model;

class SoalModel extends Model
{
    protected $table = 'soal';
    protected $useTimestamps = true;
    protected $allowedFields = ['id_soal', 'soal', 'option_a', 'option_b', 'option_c', 'option_d', 'answare'];
}
