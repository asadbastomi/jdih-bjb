<?php

namespace App\Console\Commands;

use App\Regulasi;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class UpdateRegulasiFromJson extends Command
{
    protected $signature = 'regulasi:update-from-json {path=regulasi.json}';

    protected $description = 'Update nomor, nomor_tahun, and instansi_pemrakarsa fields from a JSON mapping file';

    public function handle(): int
    {
        $path = base_path($this->argument('path'));

        if (!file_exists($path)) {
            $this->error("File not found: {$path}");
            return 1;
        }

        $payload = json_decode(file_get_contents($path), true);
        if (!is_array($payload)) {
            $this->error('Invalid JSON structure. Expected an array of items.');
            return 1;
        }

        $hasNomor = Schema::hasColumn('regulasi', 'nomor');
        $hasNomorPeraturan = Schema::hasColumn('regulasi', 'nomor_peraturan');
        $hasNomorTahun = Schema::hasColumn('regulasi', 'nomor_tahun');
        $hasInstansi = Schema::hasColumn('regulasi', 'instansi_pemrakarsa');

        $updated = 0;
        $missing = 0;

        foreach ($payload as $row) {
            if (!is_array($row) || !isset($row['id'])) {
                continue;
            }

            $regulasi = Regulasi::find($row['id']);
            if (!$regulasi) {
                $missing++;
                continue;
            }

            $changed = false;

            if ($hasNomor && array_key_exists('nomor', $row)) {
                $regulasi->nomor = $row['nomor'];
                $changed = true;
            }

            if ($hasNomorPeraturan && array_key_exists('nomor', $row)) {
                $regulasi->nomor_peraturan = $row['nomor'];
                $changed = true;
            }

            if ($hasNomorTahun && array_key_exists('nomor_tahun', $row)) {
                $regulasi->nomor_tahun = $row['nomor_tahun'];
                $changed = true;
            }

            if ($hasInstansi && array_key_exists('skpd', $row)) {
                $regulasi->instansi_pemrakarsa = $row['skpd'];
                $changed = true;
            }

            if ($changed) {
                $regulasi->save();
                $updated++;
            }
        }

        $this->info("Updated {$updated} record(s). Missing IDs: {$missing}.");

        return 0;
    }
}
