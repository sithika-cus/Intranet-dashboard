<?php

namespace App\Models;
use CodeIgniter\Model;

class CTModel extends Model
{
	protected $table = "common_templates";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}

