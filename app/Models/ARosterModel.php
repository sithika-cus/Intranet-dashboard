<?php

namespace App\Models;
use CodeIgniter\Model;

class ARosterModel extends Model
{
	protected $table = "airport_roster_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}


