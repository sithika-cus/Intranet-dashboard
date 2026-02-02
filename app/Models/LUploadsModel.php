<?php

namespace App\Models;
use CodeIgniter\Model;

class LUploadsModel extends Model
{
	protected $table = 'legaluploads';
	protected $primaryKey = 'id';

	protected $allowedFields = ['id', 'date', 'title', 'url'];
}