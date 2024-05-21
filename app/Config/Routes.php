<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (is_file(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

    // SYSTEM ROUTES (Login, Dashboard & Profile Settings) //
$routes->get('/', 'Welcome::index');

    // Login
$routes->post('/login', 'Login::login');
$routes->get('/dashboard', 'Login::dashboard');
$routes->get('/logout', 'Login::logout');

    //Profile Settings
$routes->get('/profile', 'Profile::index');
$routes->post('/profile/delete-account', 'Profile::deleteAccount');
$routes->get('/profile-update', 'Profile::profileUpdate');
$routes->post('/profile-update/password', 'Profile::passwordUpdate');
$routes->post('/profile-update/delete-account', 'Profile::deleteAccount');
$routes->get('/profile/get-cv', 'Profile::getCV');
$routes->get('get-cv', 'Profile::getCV');

    //Forgot Password
$routes->get('/forgot-password', 'Login::forgotPassword');
$routes->post('/login/forgot-password1', 'Login::forgotPassword1');
$routes->get('/forgot-password2', 'Login::forgotPassword2');
$routes->post('/login/verify-otp', 'Login::verifyOTP');
$routes->get('/forgot-password3', 'Login::forgotPassword3');
$routes->post('/login/recover-password', 'Login::recoverPassword');

    // ROLES MANAGEMENT //
$routes->get('/roles', 'Roles::index');
$routes->post('/roles/create-role', 'Roles::createRole');
$routes->post('/roles/update-role', 'Roles::editRole');
$routes->post('/roles/delete-role', 'Roles::deleteRole');

    // MEMBERS MANAGEMENT //
$routes->get('/members', 'Members::index');
$routes->post('/members/add-member', 'Members::addMember');
$routes->post('/members/update-member', 'Members::editMember');
$routes->post('/members/delete-member', 'Members::deleteMember');
$routes->post('/members/updateMember-photo', 'Members::updateMemberPhoto');

    // CATEGORIES MANAGEMENT //
$routes->get('/categories', 'Categories::index');
$routes->post('/categories/add-category', 'Categories::addCategory');
$routes->post('/categories/update-category', 'Categories::editCategory');
$routes->post('/categories/delete-category', 'Categories::deleteCategory');

    // PROJECTS MANAGEMENT //
$routes->get('/projects', 'Projects::index');
$routes->post('/projects/add-project', 'Projects::addProject');
$routes->post('/projects/update-project', 'Projects::editProject');
$routes->post('/projects/delete-project', 'Projects::deleteProject');

    // EVENTS MANAGEMENT //
$routes->get('/events', 'Events::index');
$routes->post('/events/add-event', 'Events::addEvent');
$routes->post('/events/update-event', 'Events::editEvent');
$routes->post('/events/delete-event', 'Events::deleteEvent');

    // GALLERY MANAGEMENT //
$routes->get('/gallery', 'Gallery::index');
$routes->post('/gallery/add-gallery', 'Gallery::addGallery');
$routes->post('/gallery/update-gallery', 'Gallery::editGallery');
$routes->post('/gallery/delete-gallery', 'Gallery::deleteGallery');

    // COLLEGES & DEPARTMENTS MANAGEMENT //
$routes->get('/colleges', 'Colleges::index');
$routes->post('/colleges/add-college', 'Colleges::addCollege');
$routes->post('/colleges/add-department', 'Colleges::addDepartment');
$routes->post('/colleges/update-college', 'Colleges::editCollege');
$routes->post('/colleges/delete-college', 'Colleges::deleteCollege');

    // REPORTS MANAGEMENT //
$routes->get('/reports', 'Reports::index');
$routes->post('/reports/add-report', 'Reports::addReport');
$routes->post('/reports/download-report', 'Reports::downloadReport');
$routes->post('/reports/delete-report', 'Reports::deleteReport');

    // USERS MANAGEMENT //  
$routes->get('/users', 'Users::index');
$routes->post('/users/add-user', 'Users::addUser');
$routes->post('/users/edit-user', 'Users::editUser');
$routes->post('/users/delete-user', 'Users::deleteUser');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
