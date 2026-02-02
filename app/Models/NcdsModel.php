<?php

namespace App\Models;
use CodeIgniter\Model;

class NcdsModel extends Model
{
	protected $table = 'ncds_files';
	protected $primaryKey = 'id';

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}