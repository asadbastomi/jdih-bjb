# Perda dan Perwal CRUD Fields Update Summary

## Overview
Updated the CRUD fields for Perda (Peraturan Daerah) and Perwal (Peraturan Walikota) to match the specified input requirements.

## Required Fields Added
1. **Tipe Dokumen** - `tipe_dokumen`
2. **Judul** - `judul` (existing)
3. **T.E.U. Badan/Pengarang** - `teu_badan`
4. **Nomor Peraturan** - `nomor_peraturan` (existing)
5. **Jenis/Bentuk Peraturan** - `jenis_peraturan`
6. **Singkatan Jenis/Bentuk** - `singkatan_jenis_peraturan`
7. **Tempat Penetapan** - `tempat_penetapan`
8. **Tahun Penetapan/Pengundangan** - `tahun`, `tanggal_penetapan`, `tanggal_diundangkan` (existing)
9. **Sumber** - `sumber` (existing)
10. **Subjek** - `subjek` (existing)
11. **Status Peraturan** - `status_peraturan`
12. **Bahasa** - `bahasa`
13. **Lokasi** - `lokasi`
14. **Bidang Hukum** - `bidang_hukum` (existing)
15. **Lampiran** - `lampiran`

## Files Modified

### 1. Database Migration
**File:** `database/migrations/2026_02_04_000000_add_metadata_fields_to_regulasi_table.php`
- Added new columns to `regulasi` table:
  - `tipe_dokumen` (string, nullable)
  - `teu_badan` (string, nullable)
  - `jenis_peraturan` (string, nullable)
  - `singkatan_jenis_peraturan` (string, nullable)
  - `tempat_penetapan` (string, nullable)
  - `bahasa` (string, nullable)
  - `lokasi` (string, nullable)
  - `status_peraturan` (string, nullable)
  - `lampiran` (text, nullable) - for file attachments

### 2. Model
**File:** `app/Regulasi.php`
- Added `$fillable` properties for all new fields to allow mass assignment

### 3. API Controllers
**File:** `app/Http/Controllers/API/PerdaController.php`
- Updated `store()` method to handle new fields and `lampiran` file upload
- Updated `update()` method to handle new fields and `lampiran` file update
- Files are saved to `public/upload/lampiran/perda/{tahun}/`

**File:** `app/Http/Controllers/API/PerwalController.php`
- Updated `store()` method to handle new fields and `lampiran` file upload
- Updated `update()` method to handle new fields and `lampiran` file update
- Files are saved to `public/upload/lampiran/perwal/{tahun}/`

### 4. Admin Views
**File:** `resources/views/admin/perda/index.blade.php`
- Added form fields for all new inputs in the modal form
- Added Lampiran file upload section (multiple files support)

**File:** `resources/views/admin/perwal/index.blade.php`
- Added form fields for all new inputs in the modal form
- Added Lampiran file upload section (multiple files support)

## Implementation Details

### Lampiran File Handling
- Supports multiple file uploads
- Files are stored in `public/upload/lampiran/{type}/{tahun}/` directory
- Filenames are concatenated with semicolon (;) separator in the database
- File uploads are optional (nullable field)
- Update operation supports "nochange" value to preserve existing files

### New Fields Structure
All new fields are optional (nullable) except for the existing required fields:
- `nomor_peraturan` or `nomor` (required)
- `tahun` (required)
- `tanggal_penetapan` (required)
- `judul` (required)
- `tanggal_diundangkan` (required)
- `sumber` (required)
- `subjek` (required)
- `bidang_hukum` (required)
- `file` (required)

## Testing Recommendations
1. Test creating new Perda with all new fields
2. Test creating new Perda with lampiran file uploads
3. Test updating existing Perda with new fields
4. Test updating lampiran files
5. Test that "nochange" preserves existing files
6. Repeat tests for Perwal
7. Verify data is correctly saved to database
8. Verify files are uploaded to correct directories
9. Test form validation for required fields

## Migration Command
To apply the database changes, run:
```bash
php artisan migrate
```

## Notes
- The implementation maintains backward compatibility with existing data
- All new fields are optional and can be populated gradually
- File upload paths are organized by document type and year for better organization
- The `lampiran` field uses the same pattern as `file` and `abstrak` fields for consistency