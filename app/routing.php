<?php
/**
 * This file hold all routes definitions.
 *
 * PHP version 7
 *
 * @author   WCS <contact@wildcodeschool.fr>
 *
 * @link     https://github.com/WildCodeSchool/simple-mvc
 */

$routes = [
    'Main' => [ // Controller
        ['index', '/', 'GET'], // action, url, method
    ],

    'CompanyAdmin' => [
        ['index', '/admin/company', 'GET'],
        ['edit', '/admin/company/edit', ['POST', 'GET']],
    ],
    'HeaderAdmin' => [
        ['index', '/admin/header', 'GET'],
        ['editAlert', '/admin/header/editAlert', 'POST'],
        ['addImage', '/admin/header/addImage', 'POST'],
        ['deleteImage', '/admin/header/deleteImage', 'POST'],

    ],
    'SpotlightAdmin' => [
        ['index', '/admin/spotlight', 'GET'],
        ['editSpotlight', '/admin/editspotlight', 'POST'],
    ],
    'Place' => [
        ['index', '/lieux', 'GET'],
    ],
    'Admin' => [
        ['index', '/admin', 'GET'],
    ],
    'PlaceAdmin' => [
        ['index', '/admin/place', 'GET'],
        ['edit', '/admin/place/edit', 'POST'],
        ['edit', '/admin/place/edit', 'GET'],
    ],
    'Food' => [
        ['index', '/menu', 'GET'],
    ],
    'FoodAdmin' => [
        ['index', '/admin/menu', 'GET'],
        ['showProduct', '/admin/menu/showProduct/{id}', 'GET'],
        ['showCategory', '/admin/menu/showCategory/{id}', 'GET'],
        ['editCategory', '/admin/menu/editCategory', 'POST'],
        ['editProduct', '/admin/menu/editProduct', 'POST'],
        ['deleteProduct', '/admin/menu/deleteProduct', 'POST'],
        ['deleteCategory', '/admin/menu/deleteCategory', 'POST'],
        ['insertProduct', '/admin/menu/insertProduct', 'POST'],
        ['insertCategory', '/admin/menu/insertCategory', 'POST'],
        ['showNewProduct', '/admin/menu/showNewProduct', 'GET'],
        ['showNewCategory', '/admin/menu/showNewCategory', 'GET'],
    ],
    'Gallery' => [
        ['index', '/gallery', 'GET'],
    ],
    'TeamAdmin' => [
        ['index', '/admin/team', 'GET'],
        ['edit', '/admin/team/edit', 'POST'],
        ['edit', '/admin/team/edit', 'GET'],
    ],
    'GalleryAdmin' => [
        ['index', '/admin/gallery', 'GET'],
        ['insert', '/admin/gallery/insert', 'POST'],
        ['delete', '/admin/gallery/delete/', 'POST'],
    ],
];
