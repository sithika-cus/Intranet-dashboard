<?php

namespace App\Models;
use CodeIgniter\Model;

class WRoasterModel extends Model
{
	protected $table = "warehouse_roster_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}
