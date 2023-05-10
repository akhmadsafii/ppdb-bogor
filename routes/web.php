<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DocumentController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\FormController;
use App\Http\Controllers\Admin\MessageController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\ParticipantController;
use App\Http\Controllers\Admin\PaymentController as AdminPaymentController;
use App\Http\Controllers\Admin\RegistrationCotroller;
use App\Http\Controllers\Admin\ResponseMessageController;
use App\Http\Controllers\Admin\ScheduleController;
use App\Http\Controllers\Admin\Setting\AppearanceController;
use App\Http\Controllers\Admin\Setting\SettingController;
use App\Http\Controllers\Admin\Setting\SettingPaymentController;
use App\Http\Controllers\Admin\Setting\SettingTemplateController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\Admin\TypeFormController;
use App\Http\Controllers\AnnouncementController as ControllersAnnouncementController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\DownloadController as ControllersDownloadController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InformationController;
use App\Http\Controllers\Participant\AnnouncementController as ParticipantAnnouncementController;
use App\Http\Controllers\Participant\DashboardController as ParticipantDashboardController;
use App\Http\Controllers\Participant\DownloadController as ParticipantDownloadController;
use App\Http\Controllers\Participant\MessageController as ParticipantMessageController;
use App\Http\Controllers\Participant\PageController as ParticipantPageController;
use App\Http\Controllers\Participant\ParticipantController as ParticipantParticipantController;
use App\Http\Controllers\Participant\PaymentController;
use App\Http\Controllers\Participant\PrintController;
use App\Http\Controllers\Participant\RegisterController;
use App\Http\Controllers\Participant\ResponseMessageController as ParticipantResponseMessageController;
use App\Http\Controllers\Participant\ScheduleController as ParticipantScheduleController;
use App\Http\Controllers\ScheduleController as ControllersScheduleController;
use App\Http\Controllers\SelectionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index'])->name('ppdb-public');
Route::prefix('information')->name('public_information.')->group(function () {
    Route::get('plot', [InformationController::class, 'index'])->name('plot');
    Route::get('guide', [InformationController::class, 'index'])->name('guide');
    Route::get('requirement', [InformationController::class, 'index'])->name('requirement');
    Route::get('faq', [InformationController::class, 'index'])->name('faq');
});
Route::get('announcement', [ControllersAnnouncementController::class, 'index'])->name('public_announcement');
Route::prefix('announcement')->name('public_announcement.')->group(function () {
    Route::get('preview', [ControllersAnnouncementController::class, 'preview'])->name('preview');
});
Route::get('score', [ControllersAnnouncementController::class, 'score'])->name('public_score');
// Route::prefix('score')->name('public_announcement.')->group(function () {
//     Route::get('preview', [ControllersAnnouncementController::class, 'preview'])->name('preview');
// }); 

Route::get('schedule', [ControllersScheduleController::class, 'index'])->name('public_schedule');
Route::get('selection', [SelectionController::class, 'index'])->name('public_selection');
Route::prefix('download')->name('public_download.')->group(function () {
    Route::get('file', [ControllersDownloadController::class, 'index'])->name('file');
    Route::get('brochure', [ControllersDownloadController::class, 'index'])->name('brochure');
});

Route::prefix('auth')->name('auth.')->group(function () {
    Route::get('login', [AuthController::class, 'login'])->name('login');
    Route::get('register', [AuthController::class, 'register'])->name('register');
    Route::post('verify', [AuthController::class, 'verify'])->name('verify_login');
    Route::post('verify-register', [AuthController::class, 'verifyRegister'])->name('verify_register');
    Route::get('logout', [AuthController::class, 'logout'])->name('logout');
});

Route::middleware('auth:supervisor,admin')->group(function () {
    // Route::middleware('auth:admin')->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard-admin');

        Route::get('account', [AdminController::class, 'index'])->name('account_admin');
        Route::prefix('account')->name('account_admin.')->group(function () {
            Route::post('send', [AdminController::class, 'store'])->name('send');
            Route::delete('delete', [AdminController::class, 'delete'])->name('delete');
            Route::get('detail', [AdminController::class, 'detail'])->name('detail');
            Route::get('update-status', [AdminController::class, 'update_status'])->name('update_status');
            Route::get('edit', [AdminController::class, 'edit'])->name('edit');
            Route::post('update-profile', [AdminController::class, 'update_profile'])->name('update_profile');
            Route::post('update-password', [AdminController::class, 'update_password'])->name('update_password');
        });

        Route::prefix('supervisor')->name('supervisor.')->group(function () {
            Route::get('/', [SupervisorController::class, 'index'])->name('account');
            Route::post('/', [SupervisorController::class, 'store'])->name('store');
            Route::get('delete', [SupervisorController::class, 'delete'])->name('delete');
            Route::get('detail', [SupervisorController::class, 'detail'])->name('detail');
            Route::get('update-status', [SupervisorController::class, 'update_status'])->name('update_status');
        });

        Route::get('participant', [ParticipantController::class, 'index'])->name('account_participant');
        Route::prefix('participant')->name('participant.')->group(function () {
            Route::get('action', [ParticipantController::class, 'action'])->name('add');
            Route::post('send', [ParticipantController::class, 'store'])->name('send');
            Route::get('update-status', [ParticipantController::class, 'update_status'])->name('update_status');
            Route::delete('delete', [ParticipantController::class, 'delete'])->name('delete');
            Route::get('detail', [ParticipantController::class, 'detail'])->name('detail');
            Route::post('reset-password', [ParticipantController::class, 'reset_password'])->name('reset_password');
        });

        Route::get('registration', [RegistrationCotroller::class, 'index'])->name('master_registration');
        Route::prefix('registration')->name('master_registration.')->group(function () {
            Route::get('action', [RegistrationCotroller::class, 'action'])->name('action');
            Route::post('send', [RegistrationCotroller::class, 'store'])->name('send');
            Route::get('detail', [RegistrationCotroller::class, 'detail'])->name('detail');
            Route::post('update-decision', [RegistrationCotroller::class, 'update_decision'])->name('update_decision');
            Route::post('update-decision-at-time', [RegistrationCotroller::class, 'update_decision_at_time'])->name('update_decision_at_time');
            Route::get('print-preview', [RegistrationCotroller::class, 'print_preview'])->name('print_preview');
            Route::get('export', [RegistrationCotroller::class, 'exports'])->name('export');
        });

        Route::get('document', [DocumentController::class, 'index'])->name('document');
        Route::prefix('document')->name('document.')->group(function () {
            Route::get('participant', [DocumentController::class, 'participant'])->name('participant');
            Route::post('send', [DocumentController::class, 'store'])->name('send');
            Route::delete('delete', [DocumentController::class, 'delete'])->name('delete');
            Route::get('update-status', [DocumentController::class, 'update_status'])->name('update_status');
            Route::get('detail', [DocumentController::class, 'detail'])->name('detail');
        });

        Route::get('announcement', [AnnouncementController::class, 'index'])->name('announcement');
        Route::prefix('announcement')->name('announcement.')->group(function () {
            Route::post('send', [AnnouncementController::class, 'store'])->name('send');
            Route::delete('delete', [AnnouncementController::class, 'delete'])->name('delete');
            Route::get('detail', [AnnouncementController::class, 'detail'])->name('detail');
            Route::get('update-status', [AnnouncementController::class, 'update_status'])->name('update_status');
        });

        Route::get('type-form', [TypeFormController::class, 'index'])->name('type_form');
        Route::prefix('type-form')->name('type_form.')->group(function () {
            Route::post('send', [TypeFormController::class, 'store'])->name('send');
            Route::get('detail', [TypeFormController::class, 'detail'])->name('detail');
            Route::get('update-status', [TypeFormController::class, 'update_status'])->name('update_status');
        });

        Route::get('form', [FormController::class, 'index'])->name('form');
        Route::prefix('form')->name('form.')->group(function () {
            Route::get('sort', [FormController::class, 'sort_number'])->name('sort_number');
            Route::post('send', [FormController::class, 'store'])->name('send');
            Route::get('detail', [FormController::class, 'detail'])->name('detail');
            Route::get('update-status', [FormController::class, 'update_status'])->name('update_status');
            Route::post('update-number', [FormController::class, 'update_number'])->name('update_number');
            Route::post('update-checked', [FormController::class, 'update_checked'])->name('update_checked');
            Route::post('card-update-checked', [FormController::class, 'update_card_checked'])->name('card_update_checked');
        });

        Route::get('banner', [BannerController::class, 'index'])->name('banner');
        Route::prefix('banner')->name('banner.')->group(function () {
            Route::post('send', [BannerController::class, 'store'])->name('send');
        });

        Route::get('message', [MessageController::class, 'index'])->name('message');
        Route::prefix('message')->name('message.')->group(function () {
            Route::get('get_participant', [MessageController::class, 'get_participant'])->name('get_participant');
            Route::post('send', [MessageController::class, 'store'])->name('send');
            Route::post('update', [MessageController::class, 'update'])->name('update');
            Route::get('detail', [MessageController::class, 'detail'])->name('detail');
            Route::get('closed', [MessageController::class, 'closed'])->name('closed');
            Route::delete('delete', [MessageController::class, 'delete'])->name('delete');
            Route::get('preview', [MessageController::class, 'preview'])->name('preview');
        });

        Route::prefix('response-message')->name('response-message.')->group(function () {
            Route::post('send', [ResponseMessageController::class, 'store'])->name('send');
        });


        Route::prefix('pages')->name('pages.')->group(function () {
            Route::get('plot', [PageController::class, 'index'])->name('plot');
            Route::get('guide', [PageController::class, 'index'])->name('guide');
            Route::get('requirement', [PageController::class, 'index'])->name('requirement');
            Route::get('faq', [PageController::class, 'index'])->name('faq');
            Route::get('greeting', [PageController::class, 'index'])->name('greeting');
            Route::post('send', [PageController::class, 'store'])->name('send');
        });

        Route::get('registration-schedule', [ScheduleController::class, 'index'])->name('registration_schedule');
        Route::prefix('registration-schedule')->name('registration_schedule.')->group(function () {
            Route::post('send', [ScheduleController::class, 'store'])->name('send');
            Route::delete('delete', [ScheduleController::class, 'delete'])->name('delete');
            Route::get('detail', [ScheduleController::class, 'detail'])->name('detail');
            Route::get('update-status', [ScheduleController::class, 'update_status'])->name('update_status');
        });


        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('confirm', [AdminPaymentController::class, 'index'])->name('confirm');
            Route::get('pending', [AdminPaymentController::class, 'pending'])->name('pending');
            Route::get('detail', [AdminPaymentController::class, 'detail'])->name('detail');
            Route::post('update-payment', [AdminPaymentController::class, 'update_payment'])->name('update_payment');
            Route::post('update_status_at_time', [AdminPaymentController::class, 'update_decision_at_time'])->name('update_status_at_time');
        });



        Route::prefix('downloads')->name('downloads.')->group(function () {
            Route::get('brochure', [DownloadController::class, 'index'])->name('brochure');
            Route::get('file', [DownloadController::class, 'index'])->name('file');
            Route::get('detail', [DownloadController::class, 'detail'])->name('detail');
            Route::get('update-status', [DownloadController::class, 'update_status'])->name('update_status');
            Route::post('send', [DownloadController::class, 'store'])->name('send');
            Route::delete('delete', [DownloadController::class, 'delete'])->name('delete');
        });

        Route::prefix('setting')->name('setting.')->group(function () {

            Route::get('appearance', [AppearanceController::class, 'index'])->name('appearance');
            Route::prefix('appearance')->name('appearance.')->group(function () {
                Route::post('update', [AppearanceController::class, 'update'])->name('update');
            });

            Route::get('general', [SettingController::class, 'index'])->name('general');
            Route::prefix('general')->name('general.')->group(function () {
                Route::post('update', [SettingController::class, 'update'])->name('update');
            });

            Route::get('payment', [SettingPaymentController::class, 'index'])->name('payment');
            Route::prefix('payment')->name('payment.')->group(function () {
                Route::post('update', [SettingPaymentController::class, 'update'])->name('update');
            });

            Route::prefix('template')->name('template.')->group(function () {
                Route::get('letter', [SettingTemplateController::class, 'index'])->name('letter');
                Route::post('update', [SettingTemplateController::class, 'update'])->name('update');
                Route::get('card', [SettingTemplateController::class, 'index'])->name('card');
                Route::prefix('card')->name('card.')->group(function () {
                    Route::get('output-form', [SettingTemplateController::class, 'output_form'])->name('output_form');
                });
            });

            Route::get('type-form', [SettingController::class, 'type_form'])->name('type_form');
        });
    });
});

Route::middleware('auth:participant')->group(function () {
    Route::prefix('participant')->name('participant.')->group(function () {
        Route::get('dashboard', [ParticipantDashboardController::class, 'index'])->name('dashboard-participant');

        Route::prefix('account')->name('account_participant.')->group(function () {
            Route::get('edit', [ParticipantParticipantController::class, 'edit'])->name('edit');
            Route::post('update-profile', [ParticipantParticipantController::class, 'update_profile'])->name('update_profile');
            Route::post('update-password', [ParticipantParticipantController::class, 'update_password'])->name('update_password');
        });

        Route::get('announcement', [ParticipantAnnouncementController::class, 'index'])->name('announcement');
        Route::prefix('announcement')->name('announcement.')->group(function () {
            Route::get('preview', [ParticipantAnnouncementController::class, 'preview'])->name('preview');
        });

        Route::prefix('information')->name('information.')->group(function () {
            Route::get('plot', [ParticipantPageController::class, 'index'])->name('plot');
            Route::get('requirement', [ParticipantPageController::class, 'index'])->name('requirement');
            Route::get('guide', [ParticipantPageController::class, 'index'])->name('guide');
            Route::get('faq', [ParticipantPageController::class, 'index'])->name('faq');
        });

        Route::get('schedule', [ParticipantScheduleController::class, 'index'])->name('schedule');
        Route::prefix('register')->name('register.')->group(function () {
            Route::get('formulir', [RegisterController::class, 'formulir'])->name('formulir');
            Route::post('save-form', [RegisterController::class, 'save_form'])->name('save_formulir');
            Route::get('document', [RegisterController::class, 'document'])->name('document');
            Route::prefix('document')->name('document.')->group(function () {
                Route::post('send', [RegisterController::class, 'store_document'])->name('send');
                Route::delete('delete', [RegisterController::class, 'delete_document'])->name('delete');
                Route::get('detail', [RegisterController::class, 'detail_document'])->name('detail');
                Route::get('update-status', [RegisterController::class, 'update_status'])->name('update_status');
            });
        });

        Route::prefix('payment')->name('payment.')->group(function () {
            Route::get('history', [PaymentController::class, 'history'])->name('history');
            Route::get('billing', [PaymentController::class, 'billing'])->name('billing');
            Route::post('save-billing', [PaymentController::class, 'save_billing'])->name('save_billing');
            Route::get('invoice', [PaymentController::class, 'invoice'])->name('invoice');
        });

        Route::prefix('download')->name('download.')->group(function () {
            Route::get('file', [ParticipantDownloadController::class, 'index'])->name('document');
            Route::get('brochure', [ParticipantDownloadController::class, 'index'])->name('brochure');
        });

        Route::prefix('print')->name('print.')->group(function () {
            Route::get('registration-form', [PrintController::class, 'registration'])->name('registration');
            Route::prefix('registration')->name('registration.')->group(function () {
                Route::get('print', [PrintController::class, 'registration'])->name('print_register');
                Route::get('pdf', [PrintController::class, 'registration'])->name('print_pdf');
            });
            Route::get('registration-card', [PrintController::class, 'card'])->name('card');
            Route::prefix('registration-card')->name('card.')->group(function () {
                Route::get('print', [PrintController::class, 'card'])->name('print_register');
                Route::get('pdf', [PrintController::class, 'card'])->name('print_pdf');
            });
            Route::get('result-announcement', [PrintController::class, 'announcement'])->name('announcement');
            Route::prefix('result-announcement')->name('announcement.')->group(function () {
                Route::get('print', [PrintController::class, 'announcement'])->name('print_result');
                Route::get('pdf', [PrintController::class, 'announcement'])->name('print_pdf');
            });
        });

        Route::get('message', [ParticipantMessageController::class, 'index'])->name('message');
        Route::prefix('message')->name('message.')->group(function () {
            Route::post('send', [ParticipantMessageController::class, 'store'])->name('send');
            // Route::post('update', [MessageController::class, 'update'])->name('update');
            Route::get('detail', [ParticipantMessageController::class, 'detail'])->name('detail');
            Route::get('closed', [ParticipantMessageController::class, 'closed'])->name('closed');
            Route::delete('delete', [ParticipantMessageController::class, 'delete'])->name('delete');
            Route::get('preview', [ParticipantMessageController::class, 'preview'])->name('preview');
        });

        Route::prefix('response-message')->name('response-message.')->group(function () {
            Route::post('send', [ParticipantResponseMessageController::class, 'store'])->name('send');
        });
    });
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
