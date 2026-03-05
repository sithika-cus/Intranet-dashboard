<?php

namespace App\Models;
use CodeIgniter\Model;

class NotificationModel extends Model
{
	protected $table = "intranet_notifications";
	protected $primaryKey = "id";

	protected $allowedFields = ['date_added', 'title', 'content'];
}