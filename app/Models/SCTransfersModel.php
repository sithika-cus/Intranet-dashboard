<?php

namespace App\Models;
use CodeIgniter\Model;

class SCTransfersModel extends Model
{
	protected $table = "sc_transfer_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}