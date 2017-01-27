<?php

namespace Roscio;
use Carbon\Carbon;
use Roscio\Plato;
use Roscio\Rubro;
use Roscio\Menu;

Class MenuDia
{	
    public $fecha = null;
    public $desayuno = null;
    public $almuerzo = null;
    public $hayDesayuno = false;
    public $hayAlmuerzo = false;

	public function getMenu($fecha)
	{
		if ($fecha == null)
        {
            $fecha = new Carbon('Y-m-d');
        }else
        {
            $fecha = Carbon::parse($fecha);
            $fecha->format('Y-m-d');
        }

        $this->fecha = $fecha;


        #Obtengo el desayuno
        $this->getPlatos(1);

        #Obtengo el almuerzo
        $this->getPlatos(2);
	}

    private function getPlatos($tipo_ingreso)
    {
        #Busco los platos
        $mn = Menu::where('fecha', $this->fecha)
            ->where('tipo_ingreso_id', $tipo_ingreso)
            ->get();

        
        if (count($mn) > 0)
        {
            foreach ($mn as $m)
            {
                $plato = Plato::find($m->plato_id);
                foreach ($plato->PlatoRubro as $platoRubro)
                {
                    $rubros[] = array(
                        'cantidad' => $platoRubro->cantidad,
                        'medida' => $platoRubro->medida,
                        'rubro' => $platoRubro->rubro->rubro
                    );
                }
                $menu[] = array(
                    'plato' => $plato->plato,
                    'categoria' => $plato->categoriaPlato->categoria,
                    'rubros' => $rubros,
                );
                $rubros = '';
            }
            if ($tipo_ingreso == 1)
            {
                #desayuno
                $this->hayDesayuno = true;
                $this->desayuno = $menu;
            }else
            {
                #almuerzo
                $this->hayAlmuerzo = true;
                $this->almuerzo = $menu;
            }
        }
        
    }
	
}