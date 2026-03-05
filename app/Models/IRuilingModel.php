<?php

namespace App\Models;
use CodeIgniter\Model;

class IRuilingModel extends Model
{
	protected $table = 'intrl';
	protected $primaryKey = 'id';

	protected $allowedFields = ['com_desc', 'photo', 'dec_hs', 'que_hs', 'codes_balance', 'gri_ref', 'key_point', 'cc_hs', 'issue_date'];
}


