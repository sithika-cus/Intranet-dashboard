<?php

namespace App\Models;
use CodeIgniter\Model;

class AGadvicesModel extends Model
{
	protected $table = 'agadvices';
	protected $primaryKey = 'id';

	protected $allowedFields = ['id', 'attorny_gen_ref', 'cus_ref', 'date', 'title', 'url', 'date_modified'];
	
}
