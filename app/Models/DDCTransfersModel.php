<?php

namespace App\Models;
use CodeIgniter\Model;

class DDCTransfersModel extends Model
{
	protected $table = "ddc_transfer_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}

