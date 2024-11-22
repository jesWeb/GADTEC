<?php

namespace App\Console\Commands;

use App\Models\asignacion;
use Carbon\Carbon;
use Illuminate\Console\Command;

class EliminarReservasExpiradas extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'reservas:eliminar-expiradas';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Eliminar las reservas expiradas y mantener las vigentes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //obtenerla fecha y hora
        $obTime  = Carbon::now();

        //buscar y eliminar las asignaciones que ya han pasado
        $reservasExpiradas = asignacion::whereDate('fecha_salida', '<', $obTime->toDateString())
            ->orWhere(function ($query) use ($obTime) {
                //misma fecha
                $query->whereDate('fecha_salida', '=', $obTime->toDateString())
                    ->whereTime('hora_salida', '<', $obTime->toTimeString());
            })->delete();

        //actulizar el estatus del carro
        $reservasEnCurso = asignacion::whereDate('fecha_salida', '<=', $obTime->toDateString())
            //reserva inicializada
            ->whereTime('hora_salida', '=', $obTime->toTimeString())
            ->where(function ($query) use ($obTime) {
                $query->where('fecha_estimada_dev', '>=', $obTime->toDateString())
                    ->orWhere(function ($query) use ($obTime) {
                        $query->where('fecha_estimada_dev', '=', $obTime->toDateString())
                            ->whereTime('hora_llegada', '>=', $obTime->toTimeString());
                    });
            })->get();

        // Cambiar el estatus a 'ocupado'
        foreach ($reservasEnCurso as $reserva) {
            $reserva->update(['estatus' => 'ocupado']);
        }

        //menaje de las resrevas eliminadas
        if ($reservasExpiradas) {
            $this->info('Se han eliminado las reservas expiradas.');
        } else {
            $this->info('No se encontraron reservas expiradas.');
        }
        //pone el actual
        if ($reservasEnCurso->count() > 0) {
            $this->info('Se han actualizado los estatus de los automóviles a "ocupado" para las reservas en curso.');
        } else {
            $this->info('No hay automóviles en curso para actualizar.');
        }
    }
}
