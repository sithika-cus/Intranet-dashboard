<?php

namespace App\Models;
use CodeIgniter\Model;

class CUploadsModel extends Model
{
	protected $table = 'cu';
	protected $primaryKey = 'id';

	protected $allowedFields = ['title', 'document_name', 'user', 'date_modified', 'file_link'];
}



