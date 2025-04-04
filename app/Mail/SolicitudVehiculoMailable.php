<?php

namespace App\Mail;

use App\Models\asignacion;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SolicitudVehiculoMailable extends Mailable
{
    use Queueable, SerializesModels;

    public $asignacion;

    /**
     * 
     *
     * @param  \App\Models\asignacion  $asignacion
     * @return void
     */
    public function __construct(asignacion $asignacion)
    {
        $this->asignacion = $asignacion;
    }

    /**
     * 
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Nueva Solicitud de Vehículo')
        ->view('emails.solicitud_vehiculo') 
        ->with([
            'usuario' => $this->asignacion->usuarios->nombre,
            'app' => $this->asignacion->usuarios->app,
            'apm' => $this->asignacion->usuarios->apm,
            'vehiculo' => $this->asignacion->automovil->modelo,
            'marca' => $this->asignacion->automovil->marca,
            'motivo' => $this->asignacion->motivo,
            'fecha_salida' => date('d-m-Y', strtotime($this->asignacion->fecha_salida)), 
            'hora_salida' => date('H:i', strtotime($this->asignacion->hora_salida)),     
        ]);
    }
}
