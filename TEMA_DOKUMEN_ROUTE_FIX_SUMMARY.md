# Tema Dokumen Route Fix Summary

## Issue
When accessing `/dashboard/tema-dokumen`, the page shows error: `Route [api.tema-dokumen.fetch] not defined.`

## Root Cause
The route was defined with a double prefix. It was named `api.tema-dokumen.fetch` but was inside a `Route::name('api.')->group()` which adds the `api.` prefix, resulting in `api.api.tema-dokumen.fetch` instead of `api.tema-dokumen.fetch`.

## Route Definition (FIXED)
In `routes/api.php`, line 128:
```php
Route::post('tema-dokumen/fetch', 'API\TemaDokumenController@fetch')
    ->name('tema-dokumen.fetch');
```

The route is inside the `Route::name('api.')->group()` which automatically adds the `api.` prefix, so we only need to specify `tema-dokumen.fetch` to get the final route name `api.tema-dokumen.fetch`.

This route is inside the `auth.api.or.web` middleware group, which is correct for admin operations.

## Controller Configuration (Already Correct)
In `app/Http/Controllers/Admin/TemaDokumenController.php`:
```php
public function index()
{
    $this->data['title'] = 'Tema Dokumen';
    $this->data['form'] = 'formtema-dokumen';
    $this->data['module'] = 'tema-dokumen';
    $this->data['button'] = 'btntema-dokumen';
    $this->data['fetch'] = 'api.' . $this->data['module'] . '.fetch'; // Creates 'api.tema-dokumen.fetch'
    $this->data['store'] = 'api.' . $this->data['module'] . '.store';
    $this->data['field'] = json_encode(['nama', 'deskripsi', 'icon', 'warna', 'status']);

    return view('admin.tema-dokumen.index', $this->data);
}
```

## Solution
The route name has been fixed to avoid the double prefix issue. No additional commands needed.

## Verification
After clearing the route cache, verify the route exists by running:

```bash
php artisan route:list --name=api.tema-dokumen.fetch
```

Expected output should show:
```
POST    api/tema-dokumen/fetch  api.tema-dokumen.fetch
```

## Related Files
- `routes/api.php` - Contains the route definition (already correct)
- `app/Http/Controllers/Admin/TemaDokumenController.php` - Sets up route name (already correct)
- `resources/views/admin/tema-dokumen/index.blade.php` - Uses the route (already correct)

## Summary
The issue was caused by a double prefix in the route name. The route was named `api.tema-dokumen.fetch` but was inside a `Route::name('api.')->group()` which resulted in the route being registered as `api.api.tema-dokumen.fetch`. This has been fixed by changing the route name to `tema-dokumen.fetch`, which when combined with the group prefix produces the correct `api.tema-dokumen.fetch` route name.

## Date
February 10, 2026

## Date
February 10, 2026