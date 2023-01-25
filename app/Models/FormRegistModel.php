<?php

namespace App\Models;

use CodeIgniter\Model;

class FormRegistModel extends Model
{
    protected $table = 'form_regist';
    protected $useTimestamps = true;
    protected $allowedFields = ['user_id', 'leader_name', 'leader_phone', 'leader_email', 'institution', 'member', 'member_1', 'member_2', 'ktm', 'requirments', 'token'];
}
