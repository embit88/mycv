<?php

use vfx\Router;

$admin_url = ADMIN_URL;

// AUTH
Router::add("login", ['controller' => 'Auth', 'action' => 'index', 'name' => 'login']);

// ADMIN
Router::add("{$admin_url}/dashboard", ['controller' => 'Dashboard', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.dashboard']);
Router::add("{$admin_url}/information", ['controller' => 'Information', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.information.index']);
Router::add("{$admin_url}/skills", ['controller' => 'Skill', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.skills.index']);
Router::add("{$admin_url}/works", ['controller' => 'Work', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.works.index']);
Router::add("{$admin_url}/works/edit/<~id~>", ['controller' => 'Work', 'action' => 'edit', 'admin_prefix' => $admin_url, 'name' => 'admin.works.edit']);
Router::add("{$admin_url}/works/add", ['controller' => 'Work', 'action' => 'add', 'admin_prefix' => $admin_url, 'name' => 'admin.works.add']);
Router::add("{$admin_url}/projects", ['controller' => 'Project', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.projects.index']);
Router::add("{$admin_url}/projects/edit/<~id~>", ['controller' => 'Project', 'action' => 'edit', 'admin_prefix' => $admin_url, 'name' => 'admin.projects.edit']);
Router::add("{$admin_url}/projects/add", ['controller' => 'Project', 'action' => 'add', 'admin_prefix' => $admin_url, 'name' => 'admin.projects.add']);
Router::add("{$admin_url}/contacts", ['controller' => 'Contact', 'action' => 'index', 'admin_prefix' => $admin_url, 'name' => 'admin.contacts.index']);
Router::add("{$admin_url}/contacts/edit", ['controller' => 'Contact', 'action' => 'edit', 'admin_prefix' => $admin_url, 'name' => 'admin.contacts.edit']);

// API
Router::add("api/get_projects", ['controller' => 'Project', 'action' => 'api', 'name' => 'api.get_projects']);

// CLIENT
Router::add("project/<~slug~>", ['controller' => 'Project', 'action' => 'view', 'name' => 'projects.view']);
Router::add("projects", ['controller' => 'Project', 'action' => 'index', 'name' => 'projects.list']);
Router::add("", ['controller' => 'Home', 'action' => 'index', 'name' => 'home']);
