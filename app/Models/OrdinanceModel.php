<?php

namespace App\Models;
use CodeIgniter\Model;

class OrdinanceModel extends Model
{
	protected $table = 'ordinance';
	protected $primaryKey = 'id';

	protected $allowedFields = ['part_no', 'part_desc', 'section_no', 'section_desc'];
}