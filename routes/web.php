<?php

use Illuminate\Support\Facades\Route;

Route::group(['middleware' => 'auth'], function () {

       /*  Route::get('/todo', [App\Http\Controllers\todo\TodoController::class, 'index']);
        Route::get('/', [App\Http\Controllers\contacts\ContactsController::class, 'index']);
        Route::get('/notes', [App\Http\Controllers\note\NoteController::class, 'index']);
        Route::get('/scrum', [App\Http\Controllers\scrum\ScrumboardController::class, 'index']);
        Route::get('/messages', [App\Http\Controllers\mailbox\MailboxControlller::class, 'index']); */

        Route::get('clientes', [App\Http\Controllers\clientes\ClientesController::class, 'index']);
        Route::get('clientes/{id}', [App\Http\Controllers\clientes\ClientesController::class, 'show'])->name('clientes.show');
        Route::post('clientes', [App\Http\Controllers\clientes\ClientesController::class, 'store'])->name('clientes.store');    
        Route::put('clientes/{cliente}', [App\Http\Controllers\clientes\ClientesController::class, 'update'])->name('clientes.update');
        Route::delete('clientes/{cliente}', [App\Http\Controllers\clientes\ClientesController::class, 'destroy'])->name('clientes.destroy');
        Route::get('cliente/data/ajax/{id?}', [App\Http\Controllers\clientes\ClientesController::class, 'data'])->name('clientes.data');
        Route::get('coche/data/ajax', [App\Http\Controllers\clientes\ClientesController::class, 'getCochesClientes'])->name('coches.data');


        Route::get('coches', [App\Http\Controllers\coches\CochesController::class, 'index'])->name('coches.index');
        Route::get('coches/create', [App\Http\Controllers\coches\CochesController::class, 'create'])->name('coches.create');
        Route::get('coches/{coche}', [App\Http\Controllers\coches\CochesController::class, 'show'])->name('coches.show');
        Route::get('coches/{coche}/edit', [App\Http\Controllers\coches\CochesController::class, 'edit'])->name('coches.edit');
        Route::put('coches/{id}', [App\Http\Controllers\coches\CochesController::class, 'update'])->name('coches.update');
        Route::delete('coches/{id}', [App\Http\Controllers\coches\CochesController::class, 'destroy'])->name('coches.destroy');
        Route::post('coches', [App\Http\Controllers\coches\CochesController::class, 'store'])->name('coches.store');
        Route::get('coche/ajax', [App\Http\Controllers\coches\CochesController::class, 'data'])->name('coches.data');
        Route::post('coches/{id}/upload-image', [App\Http\Controllers\coches\CochesController::class, 'uploadImage'])->name('coches.uploadImage');
        Route::get('coches/{id}/info', [App\Http\Controllers\coches\CochesController::class, 'info'])->name('coches.info');


        Route::get('mantenimientos', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'index'])->name('mantenimientos.index');
        Route::get('mantenimientos/create', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'create'])->name('mantenimientos.create');
        Route::get('mantenimientos/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'show'])->name('mantenimientos.show');
        Route::get('mantenimiento/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'showData'])->name('mantenimientos.showData');
        Route::get('mantenimientos/{id}/edit', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'edit'])->name('mantenimientos.edit');
        //Route::put('mantenimientos/{mantenimiento}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'update'])->name('mantenimientos.update');
        Route::patch('mantenimiento/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'updateMantenimiento'])->name('mantenimientos.updateMantenimiento');
        Route::delete('mantenimientos/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'destroy'])->name('mantenimientos.destroy');
        Route::post('mantenimientos', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'store'])->name('mantenimientos.store');
        Route::get('mantenimientos/factura/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'factura'])->name('mantenimientos.factura');
        /* /mantenimiento/reportar-pago/*/
        Route::post('mantenimiento/reportar-pago/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'reportarPago'])->name('mantenimientos.reportarPago');
        Route::get('download-factura/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'downloadPdfFactura'])->name('mantenimientos.downloadFactura');
        /* sendFacturaByEmail */
        Route::post('send-factura-email/{id}', [App\Http\Controllers\mantenimiento\MantenimientoController::class, 'sendFacturaByEmail'])->name('mantenimientos.sendFacturaByEmail');


        Route::get('servicios', [App\Http\Controllers\servicios\ServicioController::class, 'index']);
        Route::post('servicios', [App\Http\Controllers\servicios\ServicioController::class, 'store'])->name('servicios.store');
        Route::put('servicios/{servicio}', [App\Http\Controllers\servicios\ServicioController::class, 'update'])->name('servicios.update');
        Route::delete('servicios/{id}', [App\Http\Controllers\servicios\ServicioController::class, 'destroy'])->name('servicios.destroy');
        Route::get('servicios/ajax', [App\Http\Controllers\servicios\ServicioController::class, 'data'])->name('servicios.data');

        Route::get('empleados', [App\Http\Controllers\empleados\EmpleadoController::class, 'index']);
        Route::post('empleados', [App\Http\Controllers\empleados\EmpleadoController::class, 'store'])->name('empleados.store');
        Route::put('empleados/{id}', [App\Http\Controllers\empleados\EmpleadoController::class, 'update'])->name('empleados.update');
        Route::delete('empleados/{id}', [App\Http\Controllers\empleados\EmpleadoController::class, 'destroy'])->name('empleados.destroy');
        Route::get('empleados/data/ajax', [App\Http\Controllers\empleados\EmpleadoController::class, 'data'])->name('empleados.data');

        Route::get('/logout', [App\Http\Controllers\AuthController::class, 'logout']);
        Route::get('/', [App\Http\Controllers\AuthController::class, 'index'])->name('index');



});



Route::get('auth/register', [App\Http\Controllers\AuthController::class, 'signup'])->name('register');
Route::get('auth/login', [App\Http\Controllers\AuthController::class, 'signin'])->name('login');
Route::post('auth/login', [App\Http\Controllers\AuthController::class, 'login'])->name('auth.login');
Route::post('auth/register', [App\Http\Controllers\AuthController::class, 'register'])->name('auth.register');



Route::view('/analytics', 'analytics');
Route::view('/finance', 'finance');
Route::view('/crypto', 'crypto');

Route::view('/apps/chat', 'apps.chat');
Route::view('/apps/mailbox', 'apps.mailbox');
/* Route::view('/apps/todolist', 'apps.todolist'); */
Route::view('/apps/notes', 'apps.notes');
Route::view('/apps/scrumboard', 'apps.scrumboard');
Route::view('/apps/contacts', 'apps.contacts');
Route::view('/apps/calendar', 'apps.calendar');

Route::view('/apps/invoice/list', 'apps.invoice.list');
Route::view('/apps/invoice/preview', 'apps.invoice.preview');
Route::view('/apps/invoice/add', 'apps.invoice.add');
Route::view('/apps/invoice/edit', 'apps.invoice.edit');

Route::view('/components/tabs', 'ui-components.tabs');
Route::view('/components/accordions', 'ui-components.accordions');
Route::view('/components/modals', 'ui-components.modals');
Route::view('/components/cards', 'ui-components.cards');
Route::view('/components/carousel', 'ui-components.carousel');
Route::view('/components/countdown', 'ui-components.countdown');
Route::view('/components/counter', 'ui-components.counter');
Route::view('/components/sweetalert', 'ui-components.sweetalert');
Route::view('/components/timeline', 'ui-components.timeline');
Route::view('/components/notifications', 'ui-components.notifications');
Route::view('/components/media-object', 'ui-components.media-object');
Route::view('/components/list-group', 'ui-components.list-group');
Route::view('/components/pricing-table', 'ui-components.pricing-table');
Route::view('/components/lightbox', 'ui-components.lightbox');

Route::view('/elements/alerts', 'elements.alerts');
Route::view('/elements/avatar', 'elements.avatar');
Route::view('/elements/badges', 'elements.badges');
Route::view('/elements/breadcrumbs', 'elements.breadcrumbs');
Route::view('/elements/buttons', 'elements.buttons');
Route::view('/elements/buttons-group', 'elements.buttons-group');
Route::view('/elements/color-library', 'elements.color-library');
Route::view('/elements/dropdown', 'elements.dropdown');
Route::view('/elements/infobox', 'elements.infobox');
Route::view('/elements/jumbotron', 'elements.jumbotron');
Route::view('/elements/loader', 'elements.loader');
Route::view('/elements/pagination', 'elements.pagination');
Route::view('/elements/popovers', 'elements.popovers');
Route::view('/elements/progress-bar', 'elements.progress-bar');
Route::view('/elements/search', 'elements.search');
Route::view('/elements/tooltips', 'elements.tooltips');
Route::view('/elements/treeview', 'elements.treeview');
Route::view('/elements/typography', 'elements.typography');

Route::view('/charts', 'charts');
Route::view('/widgets', 'widgets');
Route::view('/font-icons', 'font-icons');
Route::view('/dragndrop', 'dragndrop');

Route::view('/tables', 'tables');

Route::view('/datatables/advanced', 'datatables.advanced');
Route::view('/datatables/alt-pagination', 'datatables.alt-pagination');
Route::view('/datatables/basic', 'datatables.basic');
Route::view('/datatables/checkbox', 'datatables.checkbox');
Route::view('/datatables/clone-header', 'datatables.clone-header');
Route::view('/datatables/column-chooser', 'datatables.column-chooser');
Route::view('/datatables/export', 'datatables.export');
Route::view('/datatables/multi-column', 'datatables.multi-column');
Route::view('/datatables/multiple-tables', 'datatables.multiple-tables');
Route::view('/datatables/order-sorting', 'datatables.order-sorting');
Route::view('/datatables/range-search', 'datatables.range-search');
Route::view('/datatables/skin', 'datatables.skin');
Route::view('/datatables/sticky-header', 'datatables.sticky-header');

Route::view('/forms/basic', 'forms.basic');
Route::view('/forms/input-group', 'forms.input-group');
Route::view('/forms/layouts', 'forms.layouts');
Route::view('/forms/validation', 'forms.validation');
Route::view('/forms/input-mask', 'forms.input-mask');
Route::view('/forms/select2', 'forms.select2');
Route::view('/forms/touchspin', 'forms.touchspin');
Route::view('/forms/checkbox-radio', 'forms.checkbox-radio');
Route::view('/forms/switches', 'forms.switches');
Route::view('/forms/wizards', 'forms.wizards');
Route::view('/forms/file-upload', 'forms.file-upload');
Route::view('/forms/quill-editor', 'forms.quill-editor');
Route::view('/forms/markdown-editor', 'forms.markdown-editor');
Route::view('/forms/date-picker', 'forms.date-picker');
Route::view('/forms/clipboard', 'forms.clipboard');

Route::view('/users/profile', 'users.profile');
Route::view('/users/user-account-settings', 'users.user-account-settings');

Route::view('/pages/knowledge-base', 'pages.knowledge-base');
Route::view('/pages/contact-us-boxed', 'pages.contact-us-boxed');
Route::view('/pages/contact-us-cover', 'pages.contact-us-cover');
Route::view('/pages/faq', 'pages.faq');
Route::view('/pages/coming-soon-boxed', 'pages.coming-soon-boxed');
Route::view('/pages/coming-soon-cover', 'pages.coming-soon-cover');
Route::view('/pages/error404', 'pages.error404');
Route::view('/pages/error500', 'pages.error500');
Route::view('/pages/error503', 'pages.error503');
Route::view('/pages/maintenence', 'pages.maintenence');

Route::view('/auth/boxed-lockscreen', 'auth.boxed-lockscreen');
Route::view('/auth/boxed-signin', 'auth.boxed-signin');
Route::view('/auth/boxed-signup', 'auth.boxed-signup');
Route::view('/auth/boxed-password-reset', 'auth.boxed-password-reset');
Route::view('/auth/cover-login', 'auth.cover-login');
Route::view('/auth/cover-register', 'auth.cover-register');
Route::view('/auth/cover-lockscreen', 'auth.cover-lockscreen');
Route::view('/auth/cover-password-reset', 'auth.cover-password-reset');
