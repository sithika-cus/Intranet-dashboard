<?php
namespace App\Controllers;

class Dashboard extends BaseController
{
    public function index()
    {
        // Load the dashboard view
        return view('dashboard');
    }
    public function indexOne()
    {
        // Load the dashboard view
        return view('dashboard_cards');
    }
}
