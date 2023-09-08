<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    /**
     * The list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        //MATERI ERROR HANDLING - Error Reporter
        $this->reportable(function (Throwable $e) {
            //jadi kalo misal terjadi exception, maka code di dalam parameter callback reportable() di sini akan dijalankan 
            //kalo misal mau kirim laporan error ke Slack atau Telegram atau Sentry misalnya, maka code-nya taruh di sini
            //tapi sekarang kita cuma lakukan contoh sederhana saja yaitu melakukan var_dump()
            var_dump($e); //kita tampilkan saja isi variable $e (isi exceptionnya)
            return false; //kalo ada ini maka logic stop jalan, logic code yg di bawah tidak akan dikerjakan
        });
        //nah Error Reporter itu bisa lebih dari 1 seperti di bawah ada lagi
        //biasanya dipakai untuk cara kerjanya gini : di atas di cek exception-nya jenis apa? misal kalo jenis tertentu maka lanjut ke logic bawah saja
        //jadi seperti mem-filter jenis exception-nya apa dan dilakukan oleh logic yg mana (kemungkinan pakai if)
        $this->reportable(function (Throwable $e) {
            var_dump($e); 
        });
        $this->reportable(function (Throwable $e) {
            var_dump($e); 
        });
    }
}
