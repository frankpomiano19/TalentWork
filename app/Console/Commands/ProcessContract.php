<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Contract;
use Carbon\Carbon;


class ProcessContract extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'task:process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'este comando sirve para saber que un contrato pase a ejecución pasado un día de su inicio';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     *
     */
    public function handle()
    {
        $contracts = Contract::all();
        if ($contracts->count() > 0) {
            foreach ($contracts as $cont) {
                $hoy = Carbon::now();
                //$fecha = Carbon::parse($con->con_initial);
                if ($cont->con_status == 1 && $hoy->diffInHours($cont->con_initial,false) < -24) {
                    $cont->con_status = 2;
                    $cont->save();
                }
            }
        }
    }
}
