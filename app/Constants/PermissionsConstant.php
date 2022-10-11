<?php

namespace App\Constants;

/**
 * Class PermissionsConstant
 * @package App\Constants
 */
class PermissionsConstant
{
    const PERMISSIONS = [
        'PlatformSystems' => [
            'platform.systems.roles' => 'Platform systems roles',
            'platform.systems.attachment' => 'Platform systems attachment',
        ], // Platform

        'PlatformUsers' => [
            'platform.systems.users' => 'Platform systems users',
        ], // PlatformUsers

        'Permissions' => [
            'permission.create' => 'Permission create',
            'permission.edit' => 'Permission edit',
            'permission.show' => 'Permission show',
            'permission.delete' => 'Permission delete',
            'permission.access' => 'Permission access',
        ], // Permissions

        'Roles' => [
            'roles.create' => 'Role create',
            'roles.edit' => 'Role edit',
            'roles.show'  => 'Role show',
            'roles.delete' => 'Role delete',
            'roles.access' => 'Role access',
        ], // Roles

        'Users' => [
            'user.create' => 'User create',
            'user.edit' => 'User edit',
            'user.show' => 'User show',
            'user.delete' => 'User delete',
            'user.access' => 'User access',
        ], // Users

        'Events' => [
            'event.create' => 'Event create',
            'event.edit' => 'Event edit',
            'event.show' => 'Event show',
            'event.delete' => 'Event delete',
            'event.access' => 'Event access',
        ], // Events

        'Clients' => [
            'client.create' => 'Client create',
            'client.edit' => 'Client edit',
            'client.show' => 'Client show',
            'client.delete' => 'Client delete',
            'client.access' => 'Client access',
        ], // Clients

        'Appointments' => [
            'appointment.create' => 'Appointment create',
            'appointment.edit' => 'Appointment edit',
            'appointment.show' => 'Appointment show',
            'appointment.delete' => 'Appointment delete',
            'appointment.access' => 'Appointment access',
        ], // Appointments

        'Twilio' => [
            'twilio.create' => 'Twilio create',
            'twilio.edit' => 'Twilio edit',
            'twilio.show' => 'Twilio show',
            'twilio.delete' => 'Twilio delete',
            'twilio.access' => 'Twilio access',
        ], // Events

        'Instructor' => [
            'instructor.show' => "Show Certificate Settings",
            'instructor.edit' => "Edit Certificate Settings",
            'instructor.class_print' => "Generate whole Class Certificate",
            'instructor.attendee_print' => "Generate Attendee Certificate",
        ],

        'Platform' => [
            'platform.index' => 'Platform index',
        ], // Platform
    ]; // PERMISSIONS
}
