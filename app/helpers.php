<?php

function formatName($holder) : string {
    if(!$holder) return '';

    return "$holder->first_name " . ($holder->middle_name ? $holder->middle_name . ' ' : '') . "$holder->last_name";
}
function formatYearSection($holder) : string {
    return "$holder->year - $holder->section";
}

function displayRoles($roles) : string {
    $roleNames = $roles->map(fn($value) => $value->name);
    return $roleNames->join(', ');
}

function checkRole($user, $roles) {
    $userRoles = $user->roles;
    
    foreach($roles as $role) {
        if($userRoles->contains($role)) return true;
    }

    return false;
}

function getUserGroupCode() {

    if(checkRole(auth()->user(), [2, 3, 4])) {
        return auth()->user()->groups;
    }
    
    return auth()->user()->groups[0]->id;

}

function getUserGroupCodes() {
    return auth()->user()->groups->map(fn($value) => $value->id);
}

function getUserRoleIds() {
    return auth()->user()->roles->map(fn($value) => $value->id);
}

function convertToKebabCase($string) {
    return str_replace(' ', '-', strtolower($string)); 
}