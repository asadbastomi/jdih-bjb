<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\UploadedFile;

class PreventMaliciousUploads
{
    /**
     * Daftar ekstensi file yang di-blacklist (Dilarang keras)
     */
    protected $blockedExtensions = [
        'php', 'php3', 'php4', 'php5', 'php7', 'php8', 'phtml', 'phar',
        'sh', 'cgi', 'pl', 'py', 'inc', 'asp', 'aspx', 'jsp', 'shtml'
    ];

    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        // Ambil semua file yang dikirim dalam request ini
        $files = $request->allFiles();

        if (!empty($files)) {
            $this->checkFilesRecursively($files, $request);
        }

        return $next($request);
    }

    /**
     * Cek file secara rekursif (mendukung multiple upload / array file)
     */
    protected function checkFilesRecursively($files, Request $request)
    {
        foreach ($files as $file) {
            if (is_array($file)) {
                $this->checkFilesRecursively($file, $request);
            } elseif ($file instanceof UploadedFile) {
                if ($this->isMalicious($file)) {
                    // Catat IP Hacker ke dalam file laravel.log
                    Log::critical('BLOCKED: Percobaan upload file berbahaya (Webshell/Malware).', [
                        'ip' => $request->ip(),
                        'url' => $request->fullUrl(),
                        'filename' => $file->getClientOriginalName()
                    ]);
                    
                    // Langsung tolak request dengan error 403 Forbidden
                    abort(403, 'Akses Ditolak: Anda mencoba mengunggah ekstensi file yang dilarang oleh sistem keamanan JDIH.');
                }
            }
        }
    }

    /**
     * Logika deteksi file berbahaya
     */
    protected function isMalicious(UploadedFile $file)
    {
        // 1. Cek ekstensi asli file (contoh: file.php)
        $extension = strtolower($file->getClientOriginalExtension());
        if (in_array($extension, $this->blockedExtensions)) {
            return true;
        }

        // 2. Cek nama file untuk "Double Extension" (Bypass trik hacker)
        // Hacker sering memakai trik: shell.php.jpg atau shell.php%00.png
        $originalName = strtolower($file->getClientOriginalName());
        foreach ($this->blockedExtensions as $ext) {
            // Jika ada ".php." di tengah-tengah nama file
            if (preg_match("/\." . $ext . "\./i", $originalName)) {
                return true;
            }
        }

        // 3. Cek MIME Type asli yang dibaca oleh sistem, bukan yang diklaim browser
        $mimeType = $file->getMimeType();
        if ($mimeType === 'text/x-php' || $mimeType === 'application/x-httpd-php') {
            return true;
        }

        return false;
    }
}
