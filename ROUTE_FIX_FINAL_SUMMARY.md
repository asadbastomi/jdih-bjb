# Route Fix Summary - Tema Dokumen

## Issue
User reported error: `Route [http://localhost:8000/api/tema-dokumen/fetch] not defined` on `resources/views/admin/tema-dokumen/index.blade.php:134`

## Root Cause Analysis

The issue was caused by route naming inconsistency. The route for tema-dokumen fetch was defined inside a named group:

```php
Route::middleware('auth.api.or.web')->group(function () {
    Route::name('api.')->group(function () {
        // This adds 'api.' prefix to all route names inside this group
        Route::post('tema-dokumen/fetch', 'API\TemaDokumenController@fetch')
            ->name('admin.tema-dokumen.fetch');
    });
});
```

The route was accessed in the admin controller using `route('api.tema-dokumen.fetch')`, but the actual route name became `api.admin.tema-dokumen.fetch` due to the group prefix.

## Solution

### 1. Updated routes/api.php (Line 140)
Changed the route name to include admin prefix for clarity:

```php
// Before:
Route::post('tema-dokumen/fetch', 'API\TemaDokumenController@fetch')->name('tema-dokumen.fetch');

// After:
Route::post('tema-dokumen/fetch', 'API\TemaDokumenController@fetch')->name('admin.tema-dokumen.fetch');
```

Also updated related routes:
- `admin.tema-dokumen.link-regulasi`
- `admin.tema-dokumen.unlink-regulasi`

### 2. Updated app/Http/Controllers/Admin/TemaDokumenController.php (Line 19)

```php
// Before:
$this->data['fetch'] = route('api.tema-dokumen.fetch');

// After:
$this->data['fetch'] = route('api.admin.tema-dokumen.fetch');
```

## Route Naming Convention

The project follows this naming convention:

1. **Public routes** (outside auth group): `api.resource.action`
   - Example: `api.tema-dokumen.index`, `api.tema-dokumen.show`
   - Example: `api.perda.publicfetch`, `api.artikel.publicfetch`

2. **Admin routes** (inside api. named group): `api.admin.resource.action`
   - Example: `api.admin.tema-dokumen.fetch`
   - Example: `api.admin.perda.fetch`, `api.admin.buku.fetch`

3. **Resource routes** (inside api. named group): `api.resource.action`
   - Example: `api.buku.store`, `api.perda.update`
   - These use Laravel's resource naming

## Testing

After making these changes, clear Laravel cache:
```bash
php artisan route:clear
php artisan cache:clear
php artisan config:clear
```

Verify the route:
```bash
php artisan route:list --name=admin.tema-dokumen.fetch
```

## Related Files Changed

1. `routes/api.php` - Updated route names for tema-dokumen admin routes
2. `app/Http/Controllers/Admin/TemaDokumenController.php` - Updated fetch route reference

## Additional Context

This fix ensures that:
- Admin routes are clearly distinguished from public routes
- Route names are consistent across the application
- No route naming conflicts occur between admin and public access