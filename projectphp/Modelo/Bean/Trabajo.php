<?php
class Trabajo
{
    private $nombre;
    private $descripcion;
    private $fecha_inicio;
    private $fecha_fin;
    private $status;
    private $tipo_trabajo_id;

    public function getNombre() {
        return $this->nombre;
    }
    public function setNombre($nombre) {
        $this->nombre = $nombre;
        return $this;
    }


    public function getDescripcion() {
    	return $this->descripcion;
    }
    public function setDescripcion($descripcion) {
    	$this->descripcion = $descripcion;
    	return $this;
    }


    public function getFecha_inicio() {
    	return $this->fecha_inicio;
    }
    public function setFecha_inicio($fecha_inicio) {
    	$this->fecha_inicio = $fecha_inicio;
    	return $this;
    }


    public function getFecha_fin() {
    	return $this->fecha_fin;
    }
    public function setFecha_fin($fecha_fin) {
    	$this->fecha_fin = $fecha_fin;
    	return $this;
    }


    public function getStatus() {
    	return $this->status;
    }
    public function setStatus($status) {
    	$this->status = $status;
    	return $this;
    }


    public function getTipo_trabajo_id() {
    	return $this->tipo_trabajo_id;
    }
    public function setTipo_trabajo_id($tipo_trabajo_id) {
    	$this->tipo_trabajo_id = $tipo_trabajo_id;
    	return $this;
    }

}
