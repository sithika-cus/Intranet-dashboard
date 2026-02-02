<?php

namespace App\Models;
use CodeIgniter\Model;

class DoplModel extends Model
{
	protected $table = 'dopl_files';
	protected $primaryKey = 'id';

	protected $allowedFields = [
     'date',
     'title',
     'url',
     'no',
     'branch',
     'keywords',
     'previous_dopl_numbers',
     'based_documents',
     'Remarks'
	];
}