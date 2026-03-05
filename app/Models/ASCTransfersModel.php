<?php

namespace App\Models;
use CodeIgniter\Model;

class ASCTransfersModel extends Model
{
	protected $table = "asc_transfer_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}