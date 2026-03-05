<?php

namespace App\Models;
use CodeIgniter\Model;

class CDetectionsModel extends Model
{
	protected $table = 'cusdet';
	protected $primaryKey = 'id';

	protected $allowedFields = ['title', 'document_name', 'user', 'date_modified', 'file_link', 'directorate'];
}

