<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

/*
 * --------------------------------------------------------------------
 * Routes de base
 * --------------------------------------------------------------------
 */

/*
 * Regroupement de routes pour les voyages (travel) et les modèles de voyages (model)
 */
$routes->group("travel", ["filter" => "authguard"], function (RouteCollection $routes) {

    $routes->group("model", function (RouteCollection $routes) {
        $routes->get("/", "ModelTravelController::viewList", ["as" => "modelTravelList"]);

        $routes->get("add", "ModelTravelController::viewAdd", ["as" => "modelTravelViewAdd"]);
        $routes->post("add", "ModelTravelController::add", ["as" => "modelTravelAdd"]);

        $routes->get("(:num)/edit", "ModelTravelController::viewEdit/$1", ["as" => "modelTravelViewEdit"]);
        $routes->post("(:num)/edit", "ModelTravelController::edit/$1", ["as" => "modelTravelEdit"]);

        $routes->get("(:num)/delete", "ModelTravelController::delete/$1", ["as" => "modelTravelDelete"]);
    });

    $routes->get("/", "TravelController::viewList", ["as" => "travelViewList"]);

    $routes->get("add", "TravelController::viewAdd", ["as" => "travelViewAdd"]);
    $routes->post("add", "TravelController::add", ["as" => "travelAdd"]);

    $routes->get("(:num)", "TravelController::viewDetail/$1", ["as" => "travelViewDetail"]);
    $routes->get("(:num)/edit", "TravelController::viewEdit/$1", ["as" => "travelViewEdit"]);
    $routes->post("(:num)/edit", "TravelController::edit/$1", ["as" => "travelEdit"]);

    $routes->get("(:num)/delete", "TravelController::delete/$1", ["as" => "travelDelete"]);
});

/*
 * Regroupement de routes pour les clients
 */
$routes->group("customers", ["filter" => "authguard"], function (RouteCollection $routes) {
    $routes->get("/", "CustomerController::viewList", ["as" => "customerViewList"]);

    $routes->get("add", "CustomerController::viewAdd", ["as" => "customerViewAdd"]);
    $routes->post("add", "CustomerController::add", ["as" => "customerAdd"]);

    $routes->get("(:num)/edit", "CustomerController::viewEdit/$1", ["as" => "customerViewEdit"]);
    $routes->post("(:num)/edit", "CustomerController::edit/$1", ["as" => "customerEdit"]);

    $routes->get("(:num)/delete", "CustomerController::delete/$1", ["as" => "customerDelete"]);
});


/*
 * Regroupement de routes pour les avis clients (reviews)
 */
$routes->group("reviews", ["filter" => "authguard"], function (RouteCollection $routes) {
    $routes->get("/", "ReviewController::viewList", ["as" => "reviewViewList"]);

    $routes->get("add", "ReviewController::viewAdd", ["as" => "reviewViewAdd"]);
    $routes->post("add", "ReviewController::add", ["as" => "reviewAdd"]);

    $routes->get("(:num)", "ReviewController::viewDetails/$1", ["as" => "reviewViewDetails"]);
});

/*
 * Regroupement de routes pour les statistiques
 */
$routes->group("stats", ["filter" => "authguard"], function (RouteCollection $routes) {
    $routes->get("/", "StatsController::view", ["as" => "statsView"]);
});

$routes->get("/", "HomeController::view", ["as" => "homeView", "filter" => "authguard"]);

$routes->get("/login", "LoginController::view", ["as" => "loginView"]);
$routes->post("/login", "LoginController::login", ["as" => "loginCheck"]);
$routes->get("/logout", "LoginController::logout", ["as" => "loginLogout"]);

/*
 * Regroupement de routes pour les retours d'ajax 
 */
$routes->group("api", function (RouteCollection $routes) {
    $routes->post("model-travel/(:num)/services", "ModelTravelController::getServices/$1");
    $routes->post("travels/(:num)", "TravelController::getTravelsByID/$1");
    $routes->POST("stats/travel/(:num)", "StatsController::getAVGByTravel/$1");
});