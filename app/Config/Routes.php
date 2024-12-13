<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Login::index');

$routes->get('/home', 'Home::index');
$routes->get("/movieDetails/(:any)","Home::movieDetails/$1");
$routes->get("/upload","Upload::index");
$routes->post("/update","Upload::upload");
//Update
$routes->get("/edit/(:any)","Home::edit/$1");
$routes->post("/editMovie/(:any)","Home::updateMovie/$1");
//Delete Movie
$routes->get("/delete/(:any)","Home::deleteMovie/$1");
//Selecting Seats 
$routes->get("/bookTicket/(:any)","Home::bookTicket/$1");
$routes->get("/book/(:any)/(:any)/","Home::book/$1/$2/");
//ticket
//$routes->post("/bookseats/(:any)","Home::book/$1");
$routes->get("/ticket/(:any)","Home::ticket/$1");
//register
$routes->get("/register","Register::index");
$routes->post("/registerUser","Register::registerUser");
//login 
$routes->post("/loginUser","Login::loginUser");
$routes->get("/logout","Login::logout");

//All Tickets
$routes->get("/allTickets","Home::allTickets");

//User Ticket 
$routes->get("/userTickets","Home::userTickets");

//logs
$routes->get("/logs","Home::logs");