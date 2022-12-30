<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KycController;
use App\Http\Controllers\TreController;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ChartsController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\TiendaController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\FutswapController;
use App\Http\Controllers\TicketsController;
use App\Http\Controllers\UtilityController;
use App\Http\Controllers\BusinessController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\SubAdminController;

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\FormularyController;
use App\Http\Controllers\InversionController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\BonoManualController;
use App\Http\Controllers\PreregisterController;
use App\Http\Controllers\LiquidactionController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ConfigurationController;
use App\Http\Controllers\MiscellaneousController;
use App\Http\Controllers\UserInterfaceController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\ManualActivationController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\WithdrawalSettingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// Main Page Route
// Route::get('/', [DashboardController::class,'dashboardEcommerce'])->name('dashboard-ecommerce')->middleware('verified');
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('config:cache');
    Artisan::call('view:clear');
    Artisan::call('route:clear');
    return 'DONE'; //Return anything
});

/*Route::get('/delete', function() {
    Artisan::call('delete:orden');
    return 'DONE'; //Return anything
});*/
Route::get('/delete', [ReportController::class, 'cron'])->name('delete');
Route::get('/massive/mail', [UserController::class, 'massiveMail']);


Route::get('/futswap_confirmation', function () {
    Artisan::call('futswap:canceled');
    return 'DONE'; //Return anything
});

Route::get('/welcome', [HomeController::class, 'index'])->name('welcome');
Route::get('/update/whizfx', [UserController::class, 'updateWhizfx'])->name('update.whizfx');
Route::get('/terminos', [HomeController::class, 'terminos'])->name('terminos');
Route::get('/politicas', [HomeController::class, 'politicas'])->name('politicas');
Route::get('/', [DashboardController::class, 'landing'])->name('landing');
Route::post('/data-bar-chartt', [DashboardController::class, 'getDataBarChart']);
Route::get('/futswap/bill/{token?}', [FutswapController::class, 'scanQr'])->name('scanQr');
Route::get('/status/payment', [FutswapController::class, 'statusPayment'])->name('statusPayment');
Route::resource('preregister', PreregisterController::class);

Route::middleware('auth')->group(function () {
    Route::middleware('verified')->group(function () {

        //RUTAS ADMIN
        Route::middleware('admin')->group(function () {

            Route::get('/manual-bonus-history', [ReportController::class, 'manualBonusHistory'])->name('manual.bonus.history');
            Route::post('/manual-bonus-history', [ReportController::class, 'manualBonusHistory'])->name('manual.bonus.history.filter');

            Route::get('/configurar-retiros', [LiquidactionController::class, 'configurar_retiro'])->name('config.retiros');
            //GENEALOGY
            Route::prefix('red')->group(function () {
                Route::get('/buscar', [TreController::class, 'buscar'])->name('red.buscar');
                Route::post('/buscar', [TreController::class, 'search'])->name('red.search');
            });
            //Levels
            Route::get('/levels', [TreController::class, 'levels'])->name('levels');
            Route::post('/active/levels', [TreController::class, 'activateLevels'])->name('activate_levels');
            //MARKET
            Route::group(['prefix' => 'market'], function () {
                Route::post('/cambiarStatus', [TiendaController::class, 'cambiar_status'])->name('cambiarStatus');
            });

            Route::resource('manual/activation', ManualActivationController::class);
            Route::group(['prefix' => 'configuration'], function () {
                Route::resource('withdrawal/settings', WithdrawalSettingController::class);
            });

            //WALLET PAY DIRECT
            Route::get('admin/wallet', [LiquidactionController::class, 'indexAdmin'])->name('ComponentsAdmin.wallet');
            // Route::post("/search/manual/activation", [ManualActivationController::class, "searchEmail"])->name("search.activation");

            //RENTABILIDAD
            Route::get('/rentabilidad', [UtilityController::class, 'index'])->name('rentabilidad');
            Route::post('/rentabilidad/porcentaje', [InversionController::class, 'porcentajeRentabilidad'])->name('porcentajeRentabilidad');
            //Route::get('/rentabilidad/pagar', [InversionController::class, 'pagarRentabilidad'])->name('pagarRentabilidad');
            //Route::get('/rentabilidadSumCapital', [InversionController::class, 'rentabilidadSumCapital'])->name('rentabilidadSumCapital');

            //Reports
            Route::get('/cashflow', [ReportController::class, 'cashflow'])->name('cashflow');

            //Licences
            Route::post('/licenses', [InversionController::class, 'licenses'])->name('licenses.index.filter');

            Route::get('/anuales', [ReportController::class, 'anuales'])->name('reports.anuales');
            //USERS
            
            Route::prefix('user')->group(function () {
                Route::get('user-list', [UserController::class, 'listUser'])->name('user.list-user');
                Route::post('user-list', [UserController::class, 'listUser'])->name('user.list-user.filter');

                Route::get('expired/license/list', [UserController::class, 'ExpiredLicenseUserList'])->name('user.expired.licenses.list');
                Route::get('user-view/{id}', [UserController::class, 'userView'])->name('user.user-view');
                Route::post('/user/{user}/start', [UserController::class, 'start'])->name('user.start');
            });

            //Configuracion de wallet del admin
            Route::resource('configurations', ConfigurationController::class);

            //Inversiones
            Route::get('/admin/investments', [InversionController::class, 'adminIndex'])->name('inversion.admin.index');

            Route::get('1', [InversionController::class, 'getPackegeType'])->name('porcentaje.rentabilidad');
            Route::post('porcentaje-rentabilidad', [utilityController::class, 'update'])->name('porcentaje.rentabilidad.update');

            // LIQUIDACIONEs
            Route::get('/liquidaciones/realizadas', [LiquidactionController::class, 'realizadas'])->name('liquidaciones.realizadas');
            Route::post('/liquidaciones/realizadas', [LiquidactionController::class, 'realizadas'])->name('liquidaciones.realizadas.filter');
            Route::get('/liquidaciones/pendientes', [LiquidactionController::class, 'pendientes'])->name('liquidaciones.pendientes');
            Route::post('/liquidaciones/pendientes', [LiquidactionController::class, 'pendientes'])->name('liquidaciones.pendientes.filter');
            Route::get('/liquidaciones/pendientes/export_csv', [LiquidactionController::class, 'ExportCSV'])->name('liquidaciones.export.csv');

            //buscardor id
            Route::get('/search', [BonoManualController::class, 'search'])->name('bonoManual.search');
            Route::post('/search-id', [BonoManualController::class, 'searchPost'])->name('search.id');
            //Bono manual
            Route::get('/Edicion-saldo/{id}', [BonoManualController::class, 'index'])->name('Edicion-SaldoI-ndex');

            //Agragr saldo a usuario
            Route::post('/agregar-saldo', [BonoManualController::class, 'agregar_saldo'])->name('agregar_saldo');
            Route::post('/sustraer-saldo', [BonoManualController::class, 'sustraer_saldo'])->name('sustraer_saldo');
        });
        Route::post('check/code/profile', [UserController::class, 'checkCode'])->name('check-code');
        //Ruta para cambiar referido de un user
        Route::post('referred-update', [UserController::class, 'referred'])->name('referred.update');

        Route::get('/panels', [DashboardController::class, 'index'])->name('dashboard.index');
        Route::post('/rankNotification', [UserController::class, 'ranNotification'])->name('notification.Rank');

        // Red de usuario
        Route::prefix('red')->group(function () {
            // Ruta para ver la lista de usuarios
            //Route::get('users/{network}', [TreController::class, 'indexNewtwork'])->name('genealogy_list_network');
            // Ruta para visualizar el arbol o la matriz
            Route::get('/unilevel', [TreController::class, 'index'])->name('red.unilevel');
            Route::get('/binario', [TreController::class, 'binario'])->name('red.binario');
            Route::get('/referred/tree/{tree}', [TreController::class, 'referredTree'])->name('referred.tree');
            // Ruta para visualizar el arbol o la matriz de un usuario en especifico
            Route::get('/{id}', [TreController::class, 'moretree'])->name('genealogy_type_id');
            // Ruta para buscar un id el arbol binario
            Route::post('/binario', [TreController::class, 'searchBinary'])->name('search.binary');
            // Ruta para buscar un id el arbol unilevel
            Route::post('/referred/tree/{tree}', [TreController::class, 'searchUnilevelTree'])->name('search.unilevel');
        });

        Route::get('/impersonate/stop', [UserController::class, 'stop'])->name('impersonate.stop');

        //TIENDA
        Route::prefix('market')->group(function () {
            Route::get('/licenses', [TiendaController::class, 'marketLicences'])->name('market.licenses');
            Route::post('/transactionCompra', [TiendaController::class, 'transactionCompra'])->name('shop.transactionCompra');
            Route::post('/procesarOrden', [TiendaController::class, 'procesarOrden'])->name('shop.proccess');
            Route::post('/reactivacion', [TiendaController::class, 'reactivacion'])->name('reactivacion');
            Route::post('/ipn', [TiendaController::class, 'ipn'])->name('shop.ipn');
            Route::post('/reactivacionSaldo', [TiendaController::class, 'reactivacionSaldo'])->name('reactivacionSaldo');
            Route::get('/getStatus', [TiendaController::class, 'getStatus'])->name('getStatus');
            Route::post('/transaction', [TiendaController::class, 'transaction'])->name('shop.transaction');

            Route::post('/make-purchase', [PaymentController::class, 'makePurchase'])->name('makePurchase');
        });

        Route::get('/ordenes', [ReportController::class, 'ordenes'])->name('ordenes.index');
        Route::post('/ordenes', [ReportController::class, 'ordenes'])->name('ordenes.index.filter');
        Route::post('/cambiarStatus', [TiendaController::class, 'cambiar_status'])->name('orders.cambiarStatus');
        Route::get('/reports/utility', [ReportController::class, 'utility'])->name('reports.utility');
        Route::get('inversiones', [BusinessController::class, 'inversiones'])->name('business.invest');
        Route::get('/investments', [InversionController::class, 'userIndex'])->name('investment.user.index');
        Route::get('/investments/mypackages', [InversionController::class, 'myPackages'])->name('investment.user.mypackages');
        Route::get('/inversiones/forex', [BusinessController::class, 'dataChartForex'])->name('business.forex');
        Route::get('/inversiones/indices', [BusinessController::class, 'dataChartIndice'])->name('business.indices');
        Route::get('/inversiones/crypto', [BusinessController::class, 'dataChartCrypto'])->name('business.crypto');
        Route::get('wallet', [LiquidactionController::class, 'index'])->name('wallet.index');
        //Ruta para actualizar una wallet
        Route::post('wallet-uedit', [WalletController::class, 'edit'])->name('wallet.edit');
        //Ruta para transferir saldo mlm
        Route::post('transfer-mlm', [WalletController::class, 'transferMlm'])->name('transfer.mlm');
        //Ruta para transferir saldo licencias
        Route::post('transfer-licencias', [WalletController::class, 'transferLicencias'])->name('transfer.licencias');
        Route::get('/comisiones', [WalletController::class, 'comisiones'])->name('reports.comision');
        Route::post('/comisiones', [WalletController::class, 'comisiones'])->name('reports.comision.filter');


        // ruta para el envio del codigo de seguridad para enlazar una wallet
        Route::post('/send-seccurity-code', [UserController::class, 'sendSeccurityCode'])->name('send.seccurity.code');
        Route::post('/save_wallet', [UserController::class, 'storeWallet'])->name('user.store.wallet');


        Route::get('menuRentabilidad', [BusinessController::class, 'rentabilidad'])->name('business.rentabilidad');

        //Route Retiros
        Route::get('/reports/withdraw', [ReportController::class, 'withdraw'])->name('reports.withdraw');
        Route::post('/reports/withdraw', [ReportController::class, 'withdraw'])->name('reports.withdraw.filter');
        Route::get('/withdraw', [LiquidactionController::class, 'withdraw'])->name('business.withdraw');
        Route::post('/withdraw-capital', [LiquidactionController::class, 'withdrawCapital'])->name('business.withdraw-capital');
        Route::post('/procesar-retiro-capital', [LiquidactionController::class, 'procesarRetiroCapital'])->name('settlement.procesarRetiroCapital');
        Route::post('/confirmarRetiro', [LiquidactionController::class, 'sendCodeEmail'])->name('settlement.sendCodeEmail');
        Route::post('/process', [LiquidactionController::class, 'procesarLiquidacion'])->name('liquidacion.process');
        Route::get('/retiros', [LiquidactionController::class, 'retiros'])->name('retiros');

        Route::post('/getCode', [LiquidactionController::class, 'getCode'])->name('getCode.user.retiro');

        Route::post('/verificarRetiro', [LiquidactionController::class, 'verificarRetiro'])->name('verificar.user.retiro');
        Route::post('/verifi-carRetiro-utilidad', [LiquidactionController::class, 'verificarRetiroUtilidad'])->name('verificar.user.retiro.utilidad');

        Route::get('/solicitud-retiros', [LiquidactionController::class, 'solicitudesRetiros'])->name('solicitudesRetiros');
        Route::get('/retirar', [LiquidactionController::class, 'retiro'])->name('retiro');
        Route::get('/transferencia', [LiquidactionController::class, 'transferencia'])->name('transferencia');
        Route::get('/user-transfer', [LiquidactionController::class, 'userTransfer'])->name('userTransfer');

        Route::get('/sendCodeRetiro', [LiquidactionController::class, 'sendCodeRetiro'])->name('settlement.sendCodeRetiro');

        Route::post('/liquidaciones/trasferir', [LiquidactionController::class, 'email_trasnfer'])->name('liquidaciones.trasferir');
        Route::get('/liquidaciones/validacion', [LiquidactionController::class, 'liquidationValidate'])->name('liquidaciones.validate');
        Route::post('/liquidaciones/validacion', [LiquidactionController::class, 'liquidationCheck'])->name('liquidaciones.check');

        Route::post('/guardar-configuracion', [LiquidactionController::class, 'guardar_configuracion'])->name('guardar.configuracion');

        Route::post('/trasferencia', [LiquidactionController::class, 'Transferencia_verificada'])->name('Transferencia.verificada');
        //MONTO DEL BONO A PAGAR
        Route::get('/liquidaciones/montoBono', [LiquidactionController::class, 'montoBono'])->name('liquidaciones.montoBono');

        Route::get('/bonos', [WalletController::class, 'bonosView'])->name('bonos');
        Route::post('bonosSettings', [WalletController::class, 'bonosSettings'])->name('bonosSettings');


        Route::get('/retiros/retiro-capital', [InversionController::class, 'retiroCapital'])->name('retiros.retiro-capital'); //->middleware('primerosCincoDias');
        // Route::get('/cron-rango', [InversionController::class, 'createBonusRage'])->name('cron.rango');
        Route::post('/retiros/generar', [InversionController::class, 'generarLiquidacion'])->name('liquidaciones.generar');
        Route::post('/retiros/cambiar-status', [LiquidactionController::class, 'cambiarStatus'])->name('retiros.cambiarStatus');

        Route::post('/notificacionesLeidas', [UserController::class, 'notificacionesLeidas'])->name('user.notificacionesLeidas');

        //Route de Subadmin
        Route::get('/subadmin/paquetes', [SubAdminController::class, 'index'])->name('subadmin.index');
        Route::post('/subadmin/solicitudes', [SubAdminController::class, 'solicitudes'])->name('subadmin.solicitudes');
        Route::get('/subadmin/solicitud/{id}', [SubAdminController::class, 'showSolicitud'])->name('subadmin.showSolicitud');
    });
});

// Ruta para actualizar el modo de la app (dark/light);
Route::post('/change/color/app', [DashboardController::class, 'changeAppColor']);


Auth::routes(['verify' => true]);
/* Route Dashboards */
Route::group(['prefix' => 'dashboard'], function () {
    Route::get('analytics', [DashboardController::class, 'dashboardAnalytics'])->name('dashboard-analytics');
    Route::get('ecommerce', [DashboardController::class, 'dashboardEcommerce'])->name('dashboard-ecommerce');
});
/* Route Dashboards */


/* Route UI */
Route::group(['prefix' => 'ui'], function () {
    Route::get('typography', [UserInterfaceController::class, 'typography'])->name('ui-typography');
});
/* Route UI */
Route::post('/days-chartAxios', [DashboardController::class, 'getDaysChartAxios'])->name('get.days.chartAxios');

Route::get('profile', [UserController::class, 'profile'])->name('profile.profile');
Route::post('update', [UserController::class, 'update'])->name('profile.update');
Route::post('contacto-update', [UserController::class, 'updateContacto'])->name('contacto.update');
Route::post('wallet-update', [UserController::class, 'updateWallet'])->name('wallet.update');
Route::post('contraseña-update', [UserController::class, 'passwordUpdate'])->name('contraseña.update');
Route::post('pin-update', [UserController::class, 'pinUpdate'])->name('pin.update');
Route::post('photo-update', [UserController::class, 'photoUpdate'])->name('photo.update');
Route::post('photo/delete', [UserController::class, 'deletePhoto'])->name('photo.delete');
Route::post('code-update', [UserController::class, 'CodeUpdate'])->name('code.update');
Route::post('send/code/autentication', [UserController::class, 'sendCodeAutentication']);
Route::post('check/autentication', [UserController::class, 'checkAutenticator']);


//Ruta para seleccionar una wallet
Route::post('wallet-option', [WalletController::class, 'walletOption'])->name('wallet.option');
Route::get('finanzas', [UserController::class, 'finanzas'])->name('financial.finanzas');
Route::post('package', [FormularyController::class, 'index'])->name('subadmin.package');
Route::get('/datatable/package', [FormularyController::class, 'dataTablePackages'])->name('datatable.package');
Route::get('package/{id}', [FormularyController::class, 'show'])->name('subadmin.details');
Route::post('package-status', [FormularyController::class, 'update'])->name('status.update');
Route::get('formulary-update', [FormularyController::class, 'formulario'])->name('formulary.update');
Route::post('formulary-v2', [FormularyController::class, 'reset'])->name('formulary-v2');

//Ruta de los Tickets
Route::group(['prefix' => 'tickets'], function () {
    Route::get('ticket-create', [TicketsController::class, 'create'])->name('ticket.create');
    Route::post('ticket-store', [TicketsController::class, 'store'])->name('ticket.store');
    // Para el usuario
    Route::get('ticket-edit-user/{id}', [TicketsController::class, 'editUser'])->name('ticket.edit-user');
    Route::patch('ticket-update-user/{id}', [TicketsController::class, 'updateUser'])->name('ticket.update-user');
    Route::get('ticket-list-user', [TicketsController::class, 'listUser'])->name('ticket.list-user');
    Route::get('ticket-show-user/{id}', [TicketsController::class, 'showUser'])->name('ticket.show-user');
    // Para el Admin
    Route::middleware('admin')->group(function () {
        Route::get('ticket-edit-admin/{id}', [TicketsController::class, 'editAdmin'])->name('ticket.edit-admin');
        Route::patch('ticket-update-admin/{id}', [TicketsController::class, 'updateAdmin'])->name('ticket.update-admin');
        Route::get('ticket-list-admin', [TicketsController::class, 'listAdmin'])->name('ticket.list-admin');
        Route::post('ticket-list-admin', [TicketsController::class, 'listAdmin'])->name('ticket.list-admin.filter');
        Route::get('ticket-show-admin/{id}',  [TicketsController::class, 'showAdmin'])->name('ticket.show-admin');
    });
});

//ruta para redireccionar a la vista del QR
Route::get('member',  [FutswapController::class, 'redirect'])->name('member');
//ruta para redirecionar al QR cuando la orden fue cancelada
Route::get('memberActive',  [FutswapController::class, 'redirectCancel'])->name('memberActive');

//Rutas KYC users
Route::get('KYc-verificacion', [KycController::class, 'index'])->name('KYC-Verify');
Route::post('KYC-upload', [KycController::class, 'store'])->name('KYC-store');

//auditoria admin
Route::get('KYc-Admin', [KycController::class, 'indexAdmin'])->name('KYC-admin-Verify');
Route::post('Accion-KYC', [KycController::class, 'update'])->name('KYC-accion');

/* Route Pages */
Route::group(['prefix' => 'page'], function () {
    Route::get('account-settings', [PagesController::class, 'account_settings'])->name('page-account-settings');
    Route::get('profile', [PagesController::class, 'profile'])->name('page-profile');
    
    Route::get('faq', [PagesController::class, 'faq'])->name('page-faq');
    Route::get('knowledge-base', [PagesController::class, 'knowledge_base'])->name('page-knowledge-base');
    Route::get('knowledge-base/category', [PagesController::class, 'kb_category']);
    Route::get('knowledge-base/category/question', [PagesController::class, 'kb_question']);
    Route::get('pricing', [PagesController::class, 'pricing'])->name('page-pricing');
    Route::get('blog/list', [PagesController::class, 'blog_list'])->name('page-blog-list');
    Route::get('blog/detail', [PagesController::class, 'blog_detail'])->name('page-blog-detail');
    Route::get('blog/edit', [PagesController::class, 'blog_edit'])->name('page-blog-edit');
    // Miscellaneous Pages With Page Prefix
    Route::get('coming-soon', [MiscellaneousController::class, 'coming_soon'])->name('misc-coming-soon');
    Route::get('not-authorized', [MiscellaneousController::class, 'not_authorized'])->name('misc-not-authorized');
    Route::get('maintenance', [MiscellaneousController::class, 'maintenance'])->name('misc-maintenance');
});
/* Route Pages */
Route::get('/error', [MiscellaneousController::class, 'error'])->name('error');
/* Route Authentication Pages */
Route::post('/registro', [RegisterController::class, 'create'])->name('auth-register');
Route::group(['prefix' => 'auth'], function () {
    Route::get('login-v1', [AuthenticationController::class, 'login_v1'])->name('auth-login-v1');
    Route::get('login-v2', [AuthenticationController::class, 'login_v2'])->name('auth-login-v2');
    Route::get('register-v2', [AuthenticationController::class, 'register_v2'])->name('auth-register-v2');
    Route::get('forgot-password-v1', [AuthenticationController::class, 'forgot_password_v1'])->name('auth-forgot-password-v1');
    Route::get('forgot-password-v2', [AuthenticationController::class, 'forgot_password_v2'])->name('auth-forgot-password-v2');
    Route::get('reset-password-v1', [AuthenticationController::class, 'reset_password_v1'])->name('auth-reset-password-v1');
    Route::get('reset-password-v2', [AuthenticationController::class, 'reset_password_v2'])->name('auth-reset-password-v2');
    Route::get('lock-screen', [AuthenticationController::class, 'lock_screen'])->name('auth-lock_screen');
    Route::get('verify/{user?}', [AuthenticationController::class, 'verify'])->name('auth.verify');
    Route::get('verify-account/{token}', [UserController::class, 'verifyAccount'])->name('verify.account');
    Route::get('verified-email', [UserController::class, 'verifiedEmail'])->name('verified-email');
});
/* Route Authentication Pages */
Route::get('verified-reset/{user?}', [AuthenticationController::class, 'verify_v2'])->name('auth.verified-reset');

/* Route Charts */
Route::group(['prefix' => 'chart'], function () {
    Route::get('apex', [ChartsController::class, 'apex'])->name('chart-apex');
    Route::post('usersChart', [ChartsController::class, 'usersChart'])->name('usersChart');
    Route::get('chartjs', [ChartsController::class, 'chartjs'])->name('chart-chartjs');
    Route::get('echarts', [ChartsController::class, 'echarts'])->name('chart-echarts');
    Route::get('package-rentability-chart/{invesment_id?}', [ChartsController::class, 'packageRentabilityChart'])->name('package.rentability.chart');
});
/* Route Charts */
// map leaflet
Route::get('/maps/leaflet', [ChartsController::class, 'maps_leaflet'])->name('map-leaflet');
// locale Route
Route::get('lang/{locale}', [LanguageController::class, 'swap']);
Route::match(['get', 'post'], '/aprobarRetiro', [LiquidactionController::class, 'aprobarRetiro'])->name('settlement.aprobarRetiro');
//vista de google authenticator
Route::post('/login-two-factor/{user}', [LoginController::class, 'login2FA'])->name('login.2fa');
//vista para el codigo d everificacion email
Route::post('/check-mail/{user}', [LoginController::class, 'cheking'])->name('checking.mail');
//vista para la membresia de activacion
Route::get('/member-active', [UserController::class, 'memberActive'])->name('member.active');
//vista para la activacion de la membresia
Route::post('/active', [UserController::class, 'Active'])->name('active');
//configurar codigo en profile
//Route::post('/activate-two-factor', [LoginController::class, 'activate2fa'])->name('activate.2fa');
//ruta de deslogueo
Route::post('/desloguear', [UserController::class, 'desloguear'])->name('desloguear');
Route::get('/check-mail/{id}', [LoginController::class, 'check_mail'])->name('check.mail');
Route::get('/filter', [EducationController::class, 'filter'])->name('education.filter');


// CRONES
Route::middleware('admin')->group(function () {

    Route::get('/bono-pamm', function () {
        Artisan::call('bonos:pamm');
        return redirect()->back()->with('success', 'El cron bono:pamm corrio con exito');
    })->name('bono.pamm');

    Route::get('/set-ranges', function () {
        Artisan::call('set:ranges');
        return redirect()->back()->with('success', 'El cron bono:cartera corrio con exito');
    })->name('set.ranges');

    Route::get('/delete-binary-points', function () {
        Artisan::call('delete:binary:points');
        return redirect()->back()->with('success', 'El cron create:utility corrio con exito');
    })->name('delete.binary.points');

    Route::get('/corte-ganancias-binarias', function () {
        Artisan::call('corte:ganancias:binarias');
        return redirect()->back()->with('success', 'El cron add:utility corrio con exito');
    })->name('corte.ganancias.binarias');
});
