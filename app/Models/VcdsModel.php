<?php

namespace App\Models;
use CodeIgniter\Model;

class VcdsModel extends Model
{
	protected $table = "vcds_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}