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
$routes->get('publications/aGadvices', 'Publications::aGadvices');
$routes->get('publications/cUploads', 'Publications::cUploads');
$routes->get('publications/cDetections', 'Publications::cDetections');
$routes->get('cclassification/advanceRuiling', 'ComClassification::advanceRuiling');
$routes->get('cclassification/internalRuiling', 'ComClassification::internalRuiling');
$routes->get('rosters/wRoasters', 'Rosters::wRoasters');
$routes->get('rosters/aRosters', 'Rosters::aRosters');
$routes->get('rosters/ascRosters', 'Rosters::ascRosters');
$routes->get('rosters/aTransfer', 'Rosters::aTransfer');
$routes->get('transfers/ddcTransfers', 'Transfers::ddcTransfers');
$routes->get('transfers/scTransfers', 'Transfers::scTransfers');
$routes->get('transfers/apTransfers', 'Transfers::apTransfers');
$routes->get('transfers/ascTransfers', 'Transfers::ascTransfers');
$routes->get('trainings/fTrainings', 'Trainings::fTrainings');
$routes->get('trainings/tMaterials', 'Trainings::tMaterials');
$routes->get('comtemplates/cTemplates', 'Templates::cTemplates');
$routes->get('comtemplates/iNotifications', 'Templates::iNotifications');



$routes->post('publications/update', 'Publications::update');
$routes->post('publications/add', 'Publications::add');
$routes->post('publications/delete', 'Publications::delete');

$routes->post('publications/updateNc', 'Publications::updateNc');
$routes->post('publications/deleteNc', 'Publications::deleteNc');
$routes->post('publications/addNc', 'Publications::addNc');

$routes->post('publications/updateVc', 'Publications::updateVc');
$routes->post('publications/uploadVc', 'Publications::uploadVc');
$routes->post('publications/deleteVc', 'Publications::deleteVc');
$routes->post('publications/addVc', 'Publications::addVc');

$routes->post('publications/updateC', 'Publications::updateC');
$routes->post('publications/deleteC', 'Publications::deleteC');
$routes->post('publications/addC', 'Publications::addC');

$routes->post('publications/updateL', 'Publications::updateL');
$routes->post('publications/deleteL', 'Publications::deleteL');
$routes->post('publications/addL', 'Publications::addL');

$routes->post('publications/updateAg', 'Publications::updateAg');
$routes->post('publications/deleteAg', 'Publications::deleteAg');
$routes->post('publications/addAg', 'Publications::addAg');

$routes->post('publications/updateCu', 'Publications::updateCu');
$routes->post('publications/deleteCu', 'Publications::deleteCu');
$routes->post('publications/addCu', 'Publications::addCu');

$routes->post('publications/updateCd', 'Publications::updateCd');

$routes->post('publications/deleteCd', 'Publications::deleteCd');
$routes->post('publications/addCd', 'Publications::addCd');

$routes->post('cclassification/updateAr', 'ComClassification::updateAr');
$routes->post('cclassification/deleteAr', 'ComClassification::deleteAr');
$routes->post('cclassification/addAr', 'ComClassification::addAr');

$routes->post('cclassification/updateIr', 'ComClassification::updateIr');
$routes->post('cclassification/deleteIr', 'ComClassification::deleteIr');
$routes->post('cclassification/addIr', 'ComClassification::addIr');

$routes->post('rosters/updateWr', 'Rosters::updateWr');
$routes->post('rosters/deleteWr', 'Rosters::deleteWr');
$routes->post('rosters/addWr', 'Rosters::addWr');

$routes->post('rosters/updateRa', 'Rosters::updateRa');
$routes->post('rosters/deleteRa', 'Rosters::deleteRa');
$routes->post('rosters/addRa', 'Rosters::addRa');

$routes->post('rosters/updateSc', 'Rosters::updateSc');
$routes->post('rosters/deleteSc', 'Rosters::deleteSc');
$routes->post('rosters/addSc', 'Rosters::addSc');

$routes->post('transfers/updateDdct', 'Transfers::updateDdct');
$routes->post('transfers/deleteDdct', 'Transfers::deleteDdct');
$routes->post('transfers/addDdct', 'Transfers::addDdct');

$routes->post('transfers/updateSct', 'Transfers::updateSct');
$routes->post('transfers/deleteSct', 'Transfers::deleteSct');
$routes->post('transfers/addSct', 'Transfers::addSct');

$routes->post('transfers/updateAt', 'Transfers::updateAt');
$routes->post('transfers/deleteAt', 'Transfers::deleteAt');
$routes->post('transfers/addAt', 'Transfers::addAt');

$routes->post('transfers/updateAsc', 'Transfers::updateAsc');
$routes->post('transfers/deleteAsc', 'Transfers::deleteAsc');
$routes->post('transfers/addAsc', 'Transfers::addAsc');

$routes->post('trainings/updateFt', 'Trainings::updateFt');
$routes->post('trainings/deleteFt', 'Trainings::deleteFt');
$routes->post('trainings/addFt', 'Trainings::addFt');

$routes->post('trainings/updateTm', 'Trainings::updateTm');
$routes->post('trainings/deleteTm', 'Trainings::deleteTm');
$routes->post('trainings/addTm', 'Trainings::addTm');

$routes->post('comtemplates/updateCt', 'Templates::updateCt');
$routes->post('comtemplates/deleteCt', 'Templates::deleteCt');
$routes->post('comtemplates/addCt', 'Templates::addCt');

$routes->post('comtemplates/updateIn', 'Templates::updateIn');
$routes->post('comtemplates/deleteIn', 'Templates::deleteIn');
$routes->post('comtemplates/addIn', 'Templates::addIn');