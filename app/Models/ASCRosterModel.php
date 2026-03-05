<?php

namespace App\Models;
use CodeIgniter\Model;

class ASCRosterModel extends Model
{
	protected $table = "airport_roster_files_sc";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}






