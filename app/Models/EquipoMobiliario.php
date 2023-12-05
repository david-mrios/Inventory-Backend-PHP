<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoMobiliario extends Model
{
    protected $table = 'EquipoMobiliario';
    protected $primaryKey = 'idEquipoMobiliario';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'inss', 'numeroArticulo', 'etiqueta', 'codigo', 'cantidad', 'descripcion', 'costo',
        'idEstado', 'observacion'
    ];

    // Validation
    protected $validationRules = [
        'inss' => 'required|min_length[1]',
        'numeroArticulo' => 'required|min_length[1]|is_unique[EquipoMobiliario.numeroArticulo]',
        'etiqueta' => 'required|min_length[1]|is_unique[EquipoMobiliario.etiqueta]',
        'codigo' => 'required|min_length[1]|is_unique[EquipoMobiliario.codigo]',
        'cantidad' => 'required|min_length[1]',
        'descripcion' => 'required|alpha_numeric_space',
        'costo' => 'required',
        'idEstado' => 'required|is_natural_no_zero',
        'observacion' => 'alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'inss' => [
            'required' => 'Por favor ingresar el INSS',
            'min_length' => 'Por favor ingrese un número de INSS válido',
        ],

        'numeroArticulo' => [
            'required' => 'Por favor ingresar el número de artículo',
            'min_length' => 'Ingrese un número de artículo válido',
            'is_unique' => 'El número de artículo ya existe'
        ],

        'etiqueta' => [
            'min_length' => 'Número de etiqueta no válido',
            'required' => 'Por favor ingrese la etiqueta del equipo',
            'is_unique' => 'Este número de etiqueta ya existe'
        ],

        'codigo' => [
            'min_length' => 'Código no válido',
            'required' => 'Por favor ingresar el código del equipo',
            'is_unique' => 'El código del equipo ya existe'
        ],

        'cantidad' => [
            'required' => 'Por favor ingrese la cantidad de equipos',
            'min_length' => 'Cantidad nula'
        ],

        'descripcion' => [
            'required' => 'Se requiere una descripción del equipo',
            'alpha_numeric_space' => 'Ingrese una descripción válida'
        ],

        'costo' => [
            'required' => 'Por favor ingresar el costo',
        ],

        'idEstado' => [
            'required' => 'Este campo es requerido',
            'is_natural_no_zero' => 'El ID ingresado es nulo'
        ],

        'observacion' => [
            'alpha_numeric_space' => 'Por favor ingresar una observación válida'
        ],
    ];

    protected $skipValidation = false;
}// FIN DE LA CLASE
