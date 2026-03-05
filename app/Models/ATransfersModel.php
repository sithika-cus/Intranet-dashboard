<?php

namespace App\Models;
use CodeIgniter\Model;

class ATransfersModel extends Model
{
	protected $table = "appraiser_transfer_files";
	protected $primaryKey = "id";

	protected $allowedFields = ['date', 'title', 'url', 'date_modified'];
}