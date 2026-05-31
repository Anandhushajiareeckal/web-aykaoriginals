<?php
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TalentController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\InquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\AdminTalentController;
use App\Http\Controllers\Admin\AdminProjectController;
use App\Http\Controllers\Admin\AdminInquiryController;
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\Admin\AdminGalleryController;
use App\Http\Controllers\Admin\AdminServiceController;
use App\Http\Controllers\Admin\AdminPageController;
use App\Http\Controllers\Admin\AdminHomepageController;
use App\Http\Controllers\Admin\AdminAboutController;
use App\Http\Controllers\Admin\AdminServiceBuilderController;
use App\Http\Controllers\Admin\AdminSettingController;
use App\Http\Controllers\Admin\AdminModelController;
use App\Http\Controllers\Model\ModelAuthController;
use App\Http\Controllers\Model\ModelDashboardController;
use App\Http\Controllers\Model\ModelProfileController;
use App\Http\Controllers\Model\ModelCompCardController;
use App\Http\Controllers\Model\ModelPortfolioController;
use App\Http\Controllers\Model\ModelSettingsController;
use App\Http\Controllers\Model\ModelWorkController;
use App\Http\Controllers\Model\ModelInquiryController;
use App\Http\Controllers\TalentAuthController;
use Illuminate\Support\Facades\Route;

// Fallback for Laravel's default 'login' route name
Route::get('/login', function() {
    return redirect()->route('model.login');
})->name('login');

use App\Http\Controllers\AboutController;

// PUBLIC (tracked)
Route::middleware('track.views')->group(function() {
    Route::get('/', [HomeController::class, 'index'])->name('home');
    Route::get('/talent', [TalentController::class, 'index'])->name('talent.index');
    Route::get('/models', [TalentController::class, 'modelsIndex'])->name('model.index');
    Route::get('/talent/{talent:slug}', [TalentController::class, 'show'])->name('talent.show');
    Route::get('/work', [ProjectController::class, 'index'])->name('projects.index');
    Route::get('/work/{project:slug}', [ProjectController::class, 'show'])->name('projects.show');
    Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/services', [ServiceController::class, 'index'])->name('services.index');
    Route::get('/services/{slug}', [ServiceController::class, 'show'])->name('services.show');
    Route::get('/about', [AboutController::class, 'index'])->name('about');
    Route::get('/pages/{slug}', [PageController::class, 'show'])->name('page.show');
});
Route::get('/contact', [InquiryController::class, 'create'])->name('inquiries.create');
Route::post('/contact', [InquiryController::class, 'store'])->name('inquiries.store')->middleware('throttle:5,1');

// ADMIN AUTH
Route::prefix('admin')->name('admin.')->group(function() {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// ADMIN PROTECTED
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function() {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/analytics', [DashboardController::class, 'analyticsApi'])->name('analytics');

    // Homepage Builder
    Route::get('/homepage', [AdminHomepageController::class, 'index'])->name('homepage.index');
    Route::post('/homepage/section/{key}', [AdminHomepageController::class, 'updateSection'])->name('homepage.section.update');
    Route::post('/homepage/clients', [AdminHomepageController::class, 'storeClient'])->name('homepage.clients.store');
    Route::delete('/homepage/clients/{client}', [AdminHomepageController::class, 'destroyClient'])->name('homepage.clients.destroy');

    // About Builder
    Route::get('/about-builder', [AdminAboutController::class, 'index'])->name('about.index');
    Route::post('/about-builder/section/{key}', [AdminAboutController::class, 'updateSection'])->name('about.section.update');

    // Service Page Builder
    Route::get('/service-builder', [AdminServiceBuilderController::class, 'index'])->name('service-builder.index');
    Route::post('/service-builder/section/{key}', [AdminServiceBuilderController::class, 'updateSection'])->name('service-builder.section.update');

    // Talent Builder Admin
    Route::get('/talent-builder', [\App\Http\Controllers\Admin\AdminTalentBuilderController::class, 'index'])->name('talent-builder.index');
    Route::post('/talent-builder/section/{key}', [\App\Http\Controllers\Admin\AdminTalentBuilderController::class, 'updateSection'])->name('talent-builder.section.update');

    // Work Page Builder Admin
    Route::get('/work-builder', [\App\Http\Controllers\Admin\AdminWorkBuilderController::class, 'index'])->name('work-builder.index');
    Route::post('/work-builder/section/{key}', [\App\Http\Controllers\Admin\AdminWorkBuilderController::class, 'updateSection'])->name('work-builder.update');


    Route::get('/talent',               [AdminTalentController::class, 'index'])->name('talent.index');
    Route::get('/talent/create',        [AdminTalentController::class, 'create'])->name('talent.create');
    Route::post('/talent',              [AdminTalentController::class, 'store'])->name('talent.store');
    Route::get('/talent/{talent}/edit', [AdminTalentController::class, 'edit'])->name('talent.edit');
    Route::put('/talent/{talent}',      [AdminTalentController::class, 'update'])->name('talent.update');
    Route::delete('/talent/{talent}',   [AdminTalentController::class, 'destroy'])->name('talent.destroy');

    Route::get('/work',               [AdminProjectController::class, 'index'])->name('projects.index');
    Route::get('/work/create',        [AdminProjectController::class, 'create'])->name('projects.create');
    Route::post('/work',              [AdminProjectController::class, 'store'])->name('projects.store');
    Route::get('/work/{project}/edit',[AdminProjectController::class, 'edit'])->name('projects.edit');
    Route::put('/work/{project}',     [AdminProjectController::class, 'update'])->name('projects.update');
    Route::delete('/work/{project}',  [AdminProjectController::class, 'destroy'])->name('projects.destroy');

    Route::get('/inquiries',             [AdminInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}',   [AdminInquiryController::class, 'show'])->name('inquiries.show');
    Route::put('/inquiries/{inquiry}',   [AdminInquiryController::class, 'update'])->name('inquiries.update');
    Route::delete('/inquiries/{inquiry}',[AdminInquiryController::class, 'destroy'])->name('inquiries.destroy');

    Route::get('/blog',             [AdminBlogController::class, 'index'])->name('blog.index');
    Route::get('/blog/create',      [AdminBlogController::class, 'create'])->name('blog.create');
    Route::post('/blog',            [AdminBlogController::class, 'store'])->name('blog.store');
    Route::get('/blog/{post}/edit', [AdminBlogController::class, 'edit'])->name('blog.edit');
    Route::put('/blog/{post}',      [AdminBlogController::class, 'update'])->name('blog.update');
    Route::delete('/blog/{post}',   [AdminBlogController::class, 'destroy'])->name('blog.destroy');

    Route::get('/gallery',              [AdminGalleryController::class, 'index'])->name('gallery.index');
    Route::post('/gallery',             [AdminGalleryController::class, 'store'])->name('gallery.store');
    Route::delete('/gallery/{item}',    [AdminGalleryController::class, 'destroy'])->name('gallery.destroy');

    Route::get('/services',                [AdminServiceController::class, 'index'])->name('services.index');
    Route::get('/services/create',         [AdminServiceController::class, 'create'])->name('services.create');
    Route::post('/services',               [AdminServiceController::class, 'store'])->name('services.store');
    Route::get('/services/{service}/edit', [AdminServiceController::class, 'edit'])->name('services.edit');
    Route::put('/services/{service}',      [AdminServiceController::class, 'update'])->name('services.update');
    Route::delete('/services/{service}',   [AdminServiceController::class, 'destroy'])->name('services.destroy');

    Route::get('/pages',             [AdminPageController::class, 'index'])->name('pages.index');
    Route::get('/pages/create',      [AdminPageController::class, 'create'])->name('pages.create');
    Route::post('/pages',            [AdminPageController::class, 'store'])->name('pages.store');
    Route::get('/pages/{page}/edit', [AdminPageController::class, 'edit'])->name('pages.edit');
    Route::put('/pages/{page}',      [AdminPageController::class, 'update'])->name('pages.update');
    Route::delete('/pages/{page}',   [AdminPageController::class, 'destroy'])->name('pages.destroy');

    Route::get('/settings',  [AdminSettingController::class, 'index'])->name('settings.index');
    Route::post('/settings', [AdminSettingController::class, 'update'])->name('settings.update');

    // Model Portal Management (admin side)
    Route::get('/models',                                              [AdminModelController::class, 'index'])->name('models.index');
    Route::get('/models/{talent}',                                     [AdminModelController::class, 'show'])->name('models.show');
    Route::get('/models/{talent}/edit',                                [AdminModelController::class, 'edit'])->name('models.edit');
    Route::put('/models/{talent}',                                     [AdminModelController::class, 'update'])->name('models.update');
    Route::patch('/models/{talent}/approve',                           [AdminModelController::class, 'approve'])->name('models.approve');
    Route::patch('/models/{talent}/reject',                            [AdminModelController::class, 'reject'])->name('models.reject');
    Route::patch('/models/{talent}/feature',                           [AdminModelController::class, 'feature'])->name('models.feature');
    Route::delete('/models/{talent}',                                  [AdminModelController::class, 'destroy'])->name('models.destroy');
    Route::patch('/models/{talent}/inquiries/{inquiry}/approve',       [AdminModelController::class, 'approveInquiry'])->name('models.inquiry.approve');
});

// ── MODEL PORTAL AUTH (public) ──────────────────────────────────────────────
Route::prefix('model')->name('model.')->group(function () {
    Route::get('/login',    [ModelAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [ModelAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [ModelAuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[ModelAuthController::class, 'register'])->name('register.post');
    Route::post('/logout',  [ModelAuthController::class, 'logout'])->name('logout');
});

// ── MODEL PORTAL PROTECTED ──────────────────────────────────────────────────
Route::prefix('model')->name('model.')->middleware(['auth', 'model.auth'])->group(function () {
    Route::get('/dashboard', [ModelDashboardController::class, 'index'])->name('dashboard');

    // Profile
    Route::get('/profile/edit', [ModelProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',      [ModelProfileController::class, 'update'])->name('profile.update');
    Route::get('/profile/check-slug', [ModelProfileController::class, 'checkSlug'])->name('profile.check-slug');

    // Highlight Works
    Route::get('/works',               [ModelWorkController::class, 'index'])->name('works.index');
    Route::post('/works',              [ModelWorkController::class, 'store'])->name('works.store');
    Route::put('/works/{work}',        [ModelWorkController::class, 'update'])->name('works.update');
    Route::delete('/works/{work}',     [ModelWorkController::class, 'destroy'])->name('works.destroy');
    Route::delete('/works/{work}/image/{mediaId}', [ModelWorkController::class, 'deleteImage'])->name('works.image.delete');
    // Comp Card
    Route::get('/comp-card',                          [ModelCompCardController::class, 'index'])->name('comp-card.index');
    Route::post('/comp-card/upload',                  [ModelCompCardController::class, 'upload'])->name('comp-card.upload');
    Route::delete('/comp-card/image/{mediaId}',       [ModelCompCardController::class, 'deleteImage'])->name('comp-card.delete');
    Route::get('/comp-card/download',                 [ModelCompCardController::class, 'download'])->name('comp-card.download');

    // Portfolio
    Route::get('/portfolio',                          [ModelPortfolioController::class, 'index'])->name('portfolio.index');
    Route::post('/portfolio/upload',                  [ModelPortfolioController::class, 'upload'])->name('portfolio.upload');
    Route::post('/portfolio/reorder',                 [ModelPortfolioController::class, 'reorder'])->name('portfolio.reorder');
    Route::delete('/portfolio/image/{mediaId}',       [ModelPortfolioController::class, 'destroy'])->name('portfolio.destroy');
    Route::patch('/portfolio/image/{mediaId}/meta',   [ModelPortfolioController::class, 'updateMeta'])->name('portfolio.meta');

    // Inquiries
    Route::get('/inquiries',                          [ModelInquiryController::class, 'index'])->name('inquiries.index');
    Route::get('/inquiries/{inquiry}',                [ModelInquiryController::class, 'show'])->name('inquiries.show');

    // Settings
    Route::get('/settings',             [ModelSettingsController::class, 'index'])->name('settings.index');
    Route::put('/settings',             [ModelSettingsController::class, 'update'])->name('settings.update');
    Route::put('/settings/password',    [ModelSettingsController::class, 'updatePassword'])->name('settings.password');
    Route::patch('/settings/visibility',[ModelSettingsController::class, 'updateVisibility'])->name('settings.visibility');
});

// Public Model Profile (moved to end to avoid route conflicts)
Route::get('/model/{talent:slug}', [TalentController::class, 'showModel'])->name('model.show')->middleware('track.views');

// ── TALENT PORTAL AUTH (public) ──────────────────────────────────────────────
Route::prefix('talent-portal')->name('talent.portal.')->group(function () {
    Route::get('/login',    [TalentAuthController::class, 'showLogin'])->name('login');
    Route::post('/login',   [TalentAuthController::class, 'login'])->name('login.post');
    Route::get('/register', [TalentAuthController::class, 'showRegister'])->name('register');
    Route::post('/register',[TalentAuthController::class, 'register'])->name('register.post');
    Route::post('/logout',  [TalentAuthController::class, 'logout'])->name('logout');
});

// ── TALENT PORTAL PROTECTED ──────────────────────────────────────────────────
Route::prefix('talent-portal')->name('talent.portal.')->middleware(['auth', 'model.auth'])->group(function () {
    Route::get('/dashboard', [ModelDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile/edit', [ModelProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile',      [ModelProfileController::class, 'update'])->name('profile.update');
    Route::get('/portfolio', [ModelPortfolioController::class, 'index'])->name('portfolio.index');
    Route::get('/settings', [ModelSettingsController::class, 'index'])->name('settings.index');
});

