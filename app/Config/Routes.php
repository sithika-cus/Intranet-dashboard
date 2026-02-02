<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Dashboard::index');
$routes->get('dashboard', 'Dashboard::index'); 
$routes->get('publications/departmentalOrders', 'Publications::departmentalOrders');
$routes->get('publications/ncCommittee', 'Publications::ncCommittee');
$routes->get('publications/vcDecisions', 'Publications::vcDecisions');
$routes->get('publications/cOrdinance', 'Publications::cOrdinance');
$routes->get('publications/lUploads', 'Publications::lUploads');

$routes->post('publications/update', 'Publications::update');
$routes->post('publications/upload', 'Publications::upload');
$routes->post('publications/add', 'Publications::add');
$routes->post('publications/delete', 'Publications::delete');

$routes->post('publications/updateNc', 'Publications::updateNc');
$routes->post('publications/uploadNc', 'Publications::uploadNc');
$routes->post('publications/deleteNc', 'Publications::deleteNc');
$routes->post('publications/addNc', 'Publications::addNc');

$routes->post('publications/updateVc', 'Publications::updateVc');
$routes->post('publications/uploadVc', 'Publications::uploadVc');
$routes->post('publications/deleteVc', 'Publications::deleteVc');
$routes->post('publications/addVc', 'Publications::addVc');

$routes->post('publications/updateC', 'Publications::updateC');
$routes->post('publications/uploadC', 'Publications::uploadC');
$routes->post('publications/deleteC', 'Publications::deleteC');
$routes->post('publications/addC', 'Publications::addC');

$routes->post('publications/updateL', 'Publications::updateL');
$routes->post('publications/uploadL', 'Publications::uploadL');
$routes->post('publications/deleteL', 'Publications::deleteL');
$routes->post('publications/addL', 'Publications::addL');
