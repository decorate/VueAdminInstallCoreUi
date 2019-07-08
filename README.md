
## vue-admin-install-coreui 
Coreui template using a Laravel passport

### Installation

With composer:

    composer require decorate/vue-admin-install-coreui
   
### Usage

    php artisan admin-install
    php artisan passport:install
    
### Published Files

- database/migrations/create_admin_table
- database/seeds/AdminsSeeder.php
- routes/admin.php
- app/Http/Controllers/Admin/LoginController.php
- app/Models/Admin.php
- resources/views/admin/index.blade.php
- resources/vue-admin

### Replace

#### app/Providers/RouteServiceProvider.php
    
```php
protected function mapAdminRoutes()
    {
        Route::prefix('admin')
            ->middleware('api')
            ->namespace($this->namespace)
            ->group(base_path('routes/admin.php'));
    }
```
     
#### webpack.mix.js

```js
mix
    .js('resources/js/app.js', 'public/dist/js')
    .js('resources/vue-admin/main.js', 'public/dist/js')
```

### Check
    /admin/pages/login