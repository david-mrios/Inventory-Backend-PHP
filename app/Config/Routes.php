<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');


// Roles de usuario.
$routes->post('Create/Role', 'user_role_Controller::create');
$routes->post('Update/Role', 'user_role_Controller::update');
$routes->post('Delete/Role', 'user_role_Controller::deleteLogic');
$routes->get('Get/Role', 'user_role_Controller::getAll');
$routes->post('Search/Role', 'user_role_Controller::search');

// Usuario.
$routes->post('Create/User', 'application_user_controller::create');
$routes->post('Update/User', 'application_user_controller::update');
$routes->post('Delete/User', 'application_user_controller::deleteLogic');
$routes->get('get/User', 'application_user_controller::getAll');
$routes->post('search/User', 'application_user_controller::search');
$routes->post('Login', 'application_user_controller::login');
$routes->get('get/Session', 'application_user_controller::getSession');

// Instructor.
$routes->post('Create/Instructor', 'instructorController::create');
$routes->post('Update/Instructor', 'instructorController::update');
$routes->post('Delete/Instructor', 'instructorController::deleteLogic');
$routes->get('Get/Instructor', 'instructorController::getAll');
$routes->post('Search/Instructor', 'instructorController::search');

// Responsable.
$routes->post('Create/Responsable', 'responsableController::create');
$routes->post('Update/Responsable', 'responsableController::update');
$routes->post('Delete/Responsable', 'responsableController::deleteLogic');
$routes->get('Get/Responsable', 'responsableController::getAll');
$routes->post('Search/Responsable', 'responsableController::search');

// Custodio.
$routes->post('Create/Custodio', 'custodioController::create');
$routes->post('Update/Custodio', 'custodioController::update');
$routes->post('Delete/Custodio', 'custodioController::deleteLogic');
$routes->get('Get/Custodio', 'custodioController::getAll');
$routes->post('Search/Custodio', 'custodioController::search');

// Marcas de los equipos
$routes->post('Create/MarcaEquipo', 'marcaEquipoController::create');
$routes->post('Update/MarcaEquipo', 'marcaEquipoController::update');
$routes->post('Delete/MarcaEquipo', 'marcaEquipoController::delete');
$routes->get('Get/MarcaEquipo', 'marcaEquipoController::getAll');
$routes->post('search/MarcaEquipo', 'marcaEquipoController::search');

// Equipo Mobiliario.
$routes->post('Create/EquipoMobiliario', 'EquipoMobiliarioController::create');
$routes->post('Update/EquipoMobiliario', 'EquipoMobiliarioController::update');
$routes->post('Delete/EquipoMobiliario', 'EquipoMobiliarioController::deleteLogic');
$routes->get('Get/EquipoMobiliario', 'EquipoMobiliarioController::getAll');
$routes->post('Search/EquipoMobiliario', 'EquipoMobiliarioController::search');

// Equipo Tecnologico.
$routes->post('Create/EquipoTecnologico', 'EquipoTecnologicoController::create');
$routes->post('Update/EquipoTecnologico', 'EquipoTecnologicoController::update');
$routes->post('Delete/EquipoTecnologico', 'EquipoTecnologicoController::deleteLogic');
$routes->get('Get/EquipoTecnologico', 'EquipoTecnologicoController::getAll');
$routes->post('search/EquipoTecnologico', 'EquipoTecnologicoController::search');

// Inventario.
$routes->post('Create/Inventario', 'inventarioController::create');
$routes->post('Update/Inventario', 'inventarioController::update');
$routes->post('Delete/Inventario', 'inventarioController::delete');
$routes->get('Get/Inventario', 'inventarioController::getAll');
$routes->post('Search/Inventario', 'inventarioController::search');














// Laboratorio.
$routes->post('Create/Laboratorio', 'laboratorioController::create');
$routes->post('Update/Laboratorio', 'laboratorioController::update');
$routes->post('Delete/Laboratorio', 'laboratorioController::deleteLogic');
$routes->get('Get/Laboratorio', 'laboratorioController::getAll');
$routes->post('Search/Laboratorio', 'laboratorioController::search');

// Movimientos.
$routes->post('Create/Movimiento', 'movimientoController::create');
$routes->post('Update/Movimiento', 'movimientoController::update');
$routes->post('Delete/Movimiento', 'movimientoController::delete');
$routes->get('get/Movimiento', 'movimientoController::getAll');
$routes->post('search/Movimiento', 'movimientoController::search');


// Tipo de movimiento.
$routes->post('Create/Tipo/Movimiento', 'tipoMovimientoController::create');
$routes->post('Update/Tipo/Movimiento', 'tipoMovimientoController::update');
$routes->post('Delete/Tipo/Movimiento', 'tipoMovimientoController::delete');
$routes->get('Get/Tipo/Movimiento', 'tipoMovimientoController::getAll');
$routes->post('Search/Tipo/Movimiento', 'tipoMovimientoController::search');




// Detalle de inventario de equipo mobiliario.
$routes->post('Create/DetInvEqMb', 'Detalle_Inv_EqMobiliarioCont::create');
$routes->post('Update/DetInvEqMb', 'Detalle_Inv_EqMobiliarioCont::update');
$routes->post('Delete/DetInvEqMb', 'Detalle_Inv_EqMobiliarioCont::delete');
$routes->get('Get/DetInvEqMb', 'Detalle_Inv_EqMobiliarioCont::getAll');
$routes->post('search/DetInvEqMb', 'Detalle_Inv_EqMobiliarioCont::search');

// Detalle de inventario de equipo tecnologico.
$routes->post('Create/DetInvEqTec', 'Detalle_Inv_EqTecnologicoCont::create');
$routes->post('Update/DetInvEqTec', 'Detalle_Inv_EqTecnologicoCont::update');
$routes->post('Delete/DetInvEqTec', 'Detalle_Inv_EqTecnologicoCont::delete');
$routes->get('Get/DetInvEqTec', 'Detalle_Inv_EqTecnologicoCont::getAll');
$routes->post('Search/DetInvEqTec', 'Detalle_Inv_EqTecnologicoCont::search');

// Detalle de movimiento  de equipo mobiliario.
$routes->post('Create/DetMovEqMob', 'detalleMovEqMobCont::create');
$routes->post('Update/DetMovEqMob', 'detalleMovEqMobCont::update');
$routes->post('Delete/DetMovEqMob', 'detalleMovEqMobCont::delete');
$routes->get('Get/DetMovEqMob', 'detalleMovEqMobCont::getAll');
$routes->post('Search/DetMovEqMob', 'detalleMovEqMobCont::search');

// Detalle de movimiento  de equipo tecnologico.
$routes->post(' ', 'detalleMovEqTecCont::create');
$routes->post('Update/DetMovEqTec', 'detalleMovEqTecCont::update');
$routes->post('Delete/DetMovEqTec', 'detalleMovEqTecCont::delete');
$routes->get('Get/DetMovEqTec', 'detalleMovEqTecCont::getAll');
$routes->post('Search/DetMovEqTec', 'detalleMovEqTecCont::search');

// Encargado de los laboratorios.
$routes->post('Create/EncargadoLab', 'EncargadoLabController::create');
$routes->post('Update/EncargadoLab', 'EncargadoLabController::update');
$routes->post('Delete/EncargadoLab', 'EncargadoLabController::delete');
$routes->get('Get/EncargadoLab', 'EncargadoLabController::getAll');
$routes->post('Search/EncargadoLab', 'EncargadoLabController::search');


// Estado.
$routes->post('Create/Estado', 'estadoController::create');
$routes->post('Update/Estado', 'estadoController::update');
$routes->post('Delete/Estado', 'estadoController::delete');
$routes->get('Get/Estado', 'estadoController::getAll');
$routes->post('search/Estado', 'estadoController::search');

// Dependencia.
$routes->post('Create/Dependencia', 'dependenciaController::create');
$routes->post('Update/Dependencia', 'dependenciaController::update');
$routes->post('Delete/Dependencia', 'dependenciaController::delete');
$routes->get('Get/Dependencia', 'dependenciaController::getAll');
$routes->post('Search/Dependencia', 'dependenciaController::search');

// Facultad.
$routes->post('Create/Facultdad', 'facultadController::create');
$routes->post('Update/Facultdad', 'facultadController::update');
$routes->post('Delete/Facultdad', 'facultadController::delete');
$routes->get('Get/Facultdad', 'facultadController::getAll');
$routes->post('search/Facultdad', 'facultadController::search');

// Recinto.
$routes->post('Create/Recinto', 'recintoController::create');
$routes->post('Update/Recinto', 'recintoController::update');
$routes->post('Delete/Recinto', 'recintoController::delete');
$routes->get('Get/Recinto', 'recintoController::getAll');
$routes->post('search/Recinto', 'recintoController::search');



