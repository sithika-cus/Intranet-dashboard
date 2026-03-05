<?php

namespace App\Models;
use CodeIgniter\Model;

class ARuilingModel extends Model
{
	protected $table = 'advrl';
	protected $primaryKey = 'id';

	protected $allowedFields = ['title', 'document_name', 'user', 'date_modified', 'file_link'];
}


