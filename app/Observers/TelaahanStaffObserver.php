<?php

namespace App\Observers;

use App\Models\TelaahanStaff;

class TelaahanStaffObserver
{
    /**
     * Handle the TelaahanStaff "created" event.
     */
    public function created(TelaahanStaff $telaahanStaff): void
    {
        //
    }

    /**
     * Handle the TelaahanStaff "updated" event.
     */
    public function updated(TelaahanStaff $telaahanStaff): void
    {
        //
    }

    /**
     * Handle the TelaahanStaff "deleted" event.
     */
    public function deleted(TelaahanStaff $telaahanStaff): void
    {
        //
    }

    /**
     * Handle the TelaahanStaff "restored" event.
     */
    public function restored(TelaahanStaff $telaahanStaff): void
    {
        //
    }

    /**
     * Handle the TelaahanStaff "force deleted" event.
     */
    public function forceDeleted(TelaahanStaff $telaahanStaff): void
    {
        //
    }

    public function saving(TelaahanStaff $telaahanStaff)
    {
        // Inisialisasi total harga
        $totalHarga = 0;

        // Logika perhitungan berdasarkan jenis_permintaan_id
        if ($telaahanStaff->jenis_permintaan_id == 1) { // Jenis Permintaan: Permintaan Barang
            foreach ($telaahanStaff->permintaanBarang as $barang) {
                $totalHarga += $barang->harga * $barang->kuantitas; // Harga * Kuantitas
            }
        } elseif ($telaahanStaff->jenis_permintaan_id == 2) { // Jenis Permintaan: Pemeliharaan
            foreach ($telaahanStaff->pemeliharaan as $pemeliharaan) {
                $totalHarga += $pemeliharaan->harga; // Hanya harga
            }
        } elseif ($telaahanStaff->jenis_permintaan_id == 3) { // Jenis Permintaan: Lainnya
            foreach ($telaahanStaff->lainnya as $lainnya) {
                $totalHarga += $lainnya->harga; // Hanya harga
            }
        }

        // Set total_harga_satuan sebelum menyimpan ke database
        $telaahanStaff->total_satuan_harga = $totalHarga;
    }
}
