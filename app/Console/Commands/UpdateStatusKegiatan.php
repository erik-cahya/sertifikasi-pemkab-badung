<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\KegiatanModel;
use Carbon\Carbon;

class UpdateStatusKegiatan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:update-status-kegiatan';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $today = Carbon::today();

        $updated = KegiatanModel::where('selesai_kegiatan', '<', $today)
            ->where('status', 1)
            ->update([
                'status' => 0
            ]);

        $this->info("Berhasil update {$updated} kegiatan.");
    }
}
