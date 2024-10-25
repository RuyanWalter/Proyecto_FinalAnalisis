
<?php
//observers/GestorDeProduccion.php
class GestorDeProduccion {
    private $observadores = [];

    public function agregarObservador($observador) {
        $this->observadores[] = $observador;
    }

    public function notificar() {
        foreach ($this->observadores as $observador) {
            $observador->actualizar();
        }
    }
}
?>
