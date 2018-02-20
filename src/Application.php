<?php

namespace Core;

class Application {

    public function __construct() {

        // On crée le routeur
        $this->router = new \AltoRouter();

        // On lance le mapping
        $this->mapping();
    }

    public function mapping() {

        // On mappe toutes nos URL
        $this->router->map('GET', '/', 'MainController#index', 'home');
        $this->router->map('GET', '/communities/[a:slug]', 'CommunityController#page', 'community');
        $this->router->map('GET', '/events', 'EventController#list', 'list_event');
        $this->router->map('GET', '/events/search', 'EventController#search', 'search_event');
        $this->router->map('GET', '/events/[i:id]', 'EventController#show', 'events_show');
        $this->router->map('POST', '/events/[i:id]', 'EventController#signup', 'events_signup');
        $this->router->map('POST', '/events/[i:id]', 'EventController#messageOrga', 'events_message');
        $this->router->map('GET', '/faq', 'MainController#faq', 'faq');
        $this->router->map('GET', '/cgu', 'MainController#cgu', 'cgu');
        $this->router->map('GET', '/admin/communities', 'CommunityController#page', 'admin_community');
        $this->router->map('GET|POST', '/admin/communities/create', 'CommunityController#create', 'admin_community_create');
        $this->router->map('GET|POST', '/admin/communities/[i:id]/update', 'CommunityController#update', 'admin_community_update');
        $this->router->map('POST', '/admin/communities/[i:id]/delete', 'CommunityController#delete', 'admin_community_delete');
        $this->router->map('GET', '/admin/events', 'EventController#listEvents', 'admin_events');
        $this->router->map('GET', '/admin/events/[i:id]/create', 'EventController#create', 'create_event');
        $this->router->map('GET', '/admin/events/[i:id]/delete', 'EventController#delete', 'delete_event');
        $this->router->map('GET', '/admin/members', 'MemberController#page', 'page_member');
        $this->router->map('GET', '/admin/members/updates/status', 'MemberController#status', 'update_status');
        $this->router->map('GET', '/admin/members/[i:id]/delete', 'MemberController#delete', 'delete_member');
        $this->router->map('GET', '/admin/members/[i:id]/update/role', 'MemberController#update', 'update_role');
        $this->router->map('GETPOST|', '/signup', 'UserController#sign', 'sign');
        $this->router->map('GET|POST', '/login', 'UserController#login', 'login');
        $this->router->map('POST', '/logout', 'UserController#logout', 'logout');
        $this->router->map('GET|POST', '/forgot_password', 'UserController#forgetPassword', 'forget_password');
        $this->router->map('GET|POST', '/update_password', 'UserController#updatepassword', 'update_password');
        $this->router->map('GET', '/profile', 'UserController#profile', 'profile');
        $this->router->map('GET', '/profile/update', 'UserController#updateProfile', 'update_profile');
        $this->router->map('GET|POST', '/events/create', 'EventController#create', 'create');
        $this->router->map('GET|POST', '/[admin|profile:domain]/event/[i:id]', 'EventController#updateEvent', 'update_event');
    }

    public function run () {

        // Je récupère les données de Altorouter
        // $match = ...
        $match = $this->router->match();
        // Je regarde quel controller et quelle
        // méthode je dois exécuter
        // $truc = explode('#')
if ($match !== false) {
    $controllerParts = explode('#', $match['target']);
    $controllerName = $controllerParts[0];
    $methodName = $controllerParts[1];
    $controller = new $controllerName();
    $controller->$methodName($match['params']);
}else {
    echo "404";
}

}
}
