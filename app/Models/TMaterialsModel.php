<?php

namespace App\Models;
use CodeIgniter\Model;

class TMaterialsModel extends Model
{
	protected $table = 'training_materials';
	protected $primaryKey = 'id';

	protected $allowedFields = ['training_name', 'document_name', 'user', 'date_modified', 'file_link'];
}
