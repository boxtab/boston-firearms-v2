<?php

declare(strict_types=1);

use App\Models\Appointment;
use App\Models\Event;
use App\Orchid\Screens\Appointment\AppointmentCreateScreen;
use App\Orchid\Screens\Appointment\AppointmentEditScreen;
use App\Orchid\Screens\Appointment\AppointmentListScreen;
use App\Orchid\Screens\Attendee\AttendeeListAppointmentScreen;
use App\Orchid\Screens\Attendee\AttendeeListEventDayScreen;
use App\Orchid\Screens\Attendee\AttendeeScreen;
use App\Orchid\Screens\Attendee\BlacklistScreen;
use App\Orchid\Screens\AttendeeBlacklist\AttendeeBlacklistScreen;
use App\Orchid\Screens\Client\ClientEditScreen;
use App\Orchid\Screens\Client\ClientListScreen;
use App\Orchid\Screens\Event\EventEditScreen;
use App\Orchid\Screens\Event\EventListScreen;
use App\Orchid\Screens\Examples\ExampleCardsScreen;
use App\Orchid\Screens\Examples\ExampleChartsScreen;
use App\Orchid\Screens\Examples\ExampleFieldsAdvancedScreen;
use App\Orchid\Screens\Examples\ExampleFieldsScreen;
use App\Orchid\Screens\Examples\ExampleLayoutsScreen;
use App\Orchid\Screens\Examples\ExampleScreen;
use App\Orchid\Screens\Examples\ExampleTextEditorsScreen;
use App\Orchid\Screens\InfoSource\InfoSourceScreen;
use App\Orchid\Screens\PlatformScreen;
use App\Orchid\Screens\Role\RoleEditScreen;
use App\Orchid\Screens\Role\RoleListScreen;
use App\Orchid\Screens\NotificationEvent\NotificationEventListScreen;
use App\Orchid\Screens\User\UserEditScreen;
use App\Orchid\Screens\User\UserListScreen;
use App\Orchid\Screens\User\UserProfileScreen;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Tabuna\Breadcrumbs\Trail;

/*
|--------------------------------------------------------------------------
| Dashboard Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the need "dashboard" middleware group. Now create something great!
|
*/

// Main
Route::screen('/main', PlatformScreen::class)
    ->name('platform.main');

// Platform > Profile
Route::screen('profile', UserProfileScreen::class)
    ->name('platform.profile')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Profile'), route('platform.profile'));
    });

/*
 * User
 */
// Platform > System > Users
Route::screen('users/{user}/edit', UserEditScreen::class)
    ->name('platform.systems.users.edit')
    ->breadcrumbs(function (Trail $trail, $user) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('User'), route('platform.systems.users.edit', $user));
    });

// Platform > System > Users > Create
Route::screen('users/create', UserEditScreen::class)
    ->name('platform.systems.users.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.users')
            ->push(__('Create'), route('platform.systems.users.create'));
    });

// Platform > System > Users > User
Route::screen('users', UserListScreen::class)
    ->name('platform.systems.users')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Users'), route('platform.systems.users'));
    });

/*
 * Role
 */
// Platform > System > Roles > Role
Route::screen('roles/{role}/edit', RoleEditScreen::class)
    ->name('platform.systems.roles.edit')
    ->breadcrumbs(function (Trail $trail, $role) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Role'), route('platform.systems.roles.edit', $role));
    });

// Platform > System > Roles > Create
Route::screen('roles/create', RoleEditScreen::class)
    ->name('platform.systems.roles.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.roles')
            ->push(__('Create'), route('platform.systems.roles.create'));
    });

// Platform > System > Roles
Route::screen('roles', RoleListScreen::class)
    ->name('platform.systems.roles')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Roles'), route('platform.systems.roles'));
    });

// Example...

/*
 * Event
 */
// Platform > System > Events > Event
Route::screen('events/{event}/edit', EventEditScreen::class)
    ->name('platform.systems.events.edit')
    ->breadcrumbs(function (Trail $trail, $event) {
        return $trail
            ->parent('platform.systems.events')
            ->push(__('Edit event'), route('platform.systems.events.edit', $event));
    });

// Platform > System > Events > Create
Route::screen('events/create', EventEditScreen::class)
    ->name('platform.systems.events.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.events')
            ->push(__('Create an event'), route('platform.systems.events.create'));
    });

// Platform > System > Events
Route::screen('events', EventListScreen::class)
    ->name('platform.systems.events')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Event list'), route('platform.systems.events'));
    });

/*
 * Appointment
 */
// Platform > System > Events > Appointment
Route::screen('events/{eventId}/appointment/{appointmentId}/edit', AppointmentEditScreen::class)
    ->name('platform.systems.events.appointment.edit')
    ->breadcrumbs(function (Trail $trail, $eventId, $appointmentId) {
        return $trail
            ->parent('platform.systems.events')
            ->push(__('Edit appointment'), route('platform.systems.events.appointment.edit', [$eventId, $appointmentId]));
    });

// Platform > System > Events > Appointments > Create
Route::screen('events/{eventId}/appointment/create', AppointmentCreateScreen::class)
    ->name('platform.systems.events.appointment.create')
    ->breadcrumbs(function (Trail $trail, int $eventId) {
        return $trail
            ->parent('platform.systems.events')
            ->push(__('Create an appointment'), route('platform.systems.events.appointment.create', $eventId));
    });

// Platform > System > Events > Appointments
Route::screen('events/{eventId}/appointments', AppointmentListScreen::class)
    ->name('platform.systems.events.appointments')
    ->breadcrumbs(function (Trail $trail, int $eventId) {
        return $trail
            ->parent('platform.systems.events')
            ->push(__('Appointment list'), route('platform.systems.events.appointments', $eventId));
    });

/*
 * Client
 */
// Platform > System > Clients > Client
Route::screen('clients/{client}/edit', ClientEditScreen::class)
    ->name('platform.systems.clients.edit')
    ->breadcrumbs(function (Trail $trail, $client) {
        return $trail
            ->parent('platform.systems.attendee')
            ->push(__('Edit'), route('platform.systems.clients.edit', $client));
    });

// Platform > System > Clients > Create
Route::screen('clients/create', ClientEditScreen::class)
    ->name('platform.systems.clients.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.attendee')
            ->push(__('Create client'), route('platform.systems.clients.create'));
    });

/*
 * Info Source
 */
// Platform > System > Info Source
Route::screen('info-source/{info-source}/edit', InfoSourceScreen::class)
    ->name('platform.systems.info-source.edit')
    ->breadcrumbs(function (Trail $trail, $infoSource) {
        return $trail
            ->parent('platform.systems.info-source')
            ->push(__('Edit'), route('platform.systems.info-source.edit', $infoSource));
    });

// Platform > System > Info Source > Create
Route::screen('info-source/create', InfoSourceScreen::class)
    ->name('platform.systems.info-source.create')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.systems.info-source')
            ->push(__('Create'), route('platform.systems.info-source.create'));
    });

// Platform > System > Info Source
Route::screen('info-source', InfoSourceScreen::class)
    ->name('platform.systems.info-source')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Info Source'), route('platform.systems.info-source'));
    });

/*
 * Attendee
 */
// Platform > System > Attendee
Route::screen('attendee', AttendeeScreen::class)
    ->name('platform.systems.attendee')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Attendee'), route('platform.systems.attendee'));
    });

// Platform > System > AttendeeBlacklist
Route::screen('attendee-blacklist', AttendeeBlacklistScreen::class)
    ->name('platform.systems.attendee-blacklist')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Attendee'), route('platform.systems.attendee-blacklist'));
    });

// Platform > System > Attendee > Blacklist
Route::screen('attendee/{attendeeId}/blacklist', BlacklistScreen::class)
    ->name('platform.systems.attendee.blacklist')
    ->breadcrumbs(function (Trail $trail, int $attendeeId) {
        return $trail
            ->parent('platform.systems.attendee')
            ->push(__('Blacklist'), route('platform.systems.attendee.blacklist', $attendeeId));
    });

// Platform > System > Events > Appointment > Attendees
Route::screen('events/{eventId}/appointment/{appointmentId}', AttendeeListAppointmentScreen::class)
    ->name('platform.systems.events.appointment.attendees')
    ->breadcrumbs(function (Trail $trail, $eventId, $appointmentId) {
        return $trail
            ->parent('platform.systems.events.appointments', $eventId, $appointmentId)
            ->push(__('Attendees list of appointment'), route('platform.systems.events.appointment.attendees', [$eventId, $appointmentId]));
    });

// Platform > System > Events > Day > Attendees
Route::screen('events/{eventId}/day/{day}', AttendeeListEventDayScreen::class)
    ->name('platform.systems.events.day.attendees')
    ->breadcrumbs(function (Trail $trail, $eventId, $day) {
        return $trail
            ->parent('platform.systems.events.appointments', $eventId, $day)
            ->push(__('Attendees list of event day'), route('platform.systems.events.appointment.attendees', [$eventId, $day]));
    });


/*
 * Notification Events
 */
// Platform > System > Notification Events
Route::screen('notification-events', NotificationEventListScreen::class)
    ->name('platform.systems.notification-events')
    ->breadcrumbs(function (Trail $trail) {
        return $trail
            ->parent('platform.index')
            ->push(__('Notification event list'), route('platform.systems.notification-events'));
    });
