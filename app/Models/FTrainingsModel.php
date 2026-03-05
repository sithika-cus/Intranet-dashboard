<?php

namespace App\Models;
use CodeIgniter\Model;

class FTrainingsModel extends Model
{
	protected $table = "foreign_transfer_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}