<?php

namespace App\Models;

use CodeIgniter\Model;

class EquipoTecnologico extends Model
{
    protected $table = 'EquipoTecnologico';
    protected $primaryKey = 'idEquipoTecnologico';
    protected $useAutoIncrement = true;
    protected $returnType = 'array';
    protected $useSoftDeletes = true;

    protected $allowedFields = [
        'inss', 'numeroArt', 'codigo', 'etiqueta', 'cantidad', 'descripcion', 'modelo',
        'idMarca', 'serie', 'costo', 'idEstado', 'observacion'
    ];

    // Validation
    protected $validationRules = [
        'inss' => 'required|min_length[8]',
        'numeroArt' => 'required|min_length[1]|is_unique[EquipoTecnologico.numeroArt]',
        'codigo' => 'required|min_length[1]|is_unique[EquipoTecnologico.codigo]',
        'etiqueta' => 'required|min_length[4]|is_unique[EquipoTecnologico.etiqueta]',
        'cantidad' => 'required|min_length[1]',
        'descripcion' => 'required|alpha_numeric_space',
        'modelo' => 'required|alpha_numeric_space',
        'idMarca' => 'required|is_natural_no_zero',
        'serie' => 'required|alpha_numeric_space',
        'costo' => 'required',
        'idEstado' => 'required|is_natural_no_zero',
        'observacion' => 'alpha_numeric_space'
    ];

    // Aplicar regla de validación previo a la inserción
    protected $validationMessages = [
        'inss' => [
            'required' => 'Por favor ingresar el INSS',
            'min_length' => 'Por favor ingrese un número de INSS válido'
        ],

        'numeroArt' => [
            'required' => 'Por favor ingresar el número de artículo',
            'min_length' => 'Ingrese un número de artículo válido',
            'is_unique' => 'El número de artículo ya existe'
        ],

        'codigo' => [
            'min_length' => 'Código no válido',
            'required' => 'Por favor ingresar el código del equipo',
            'is_unique' => 'El código del equipo ya existe'
        ],

        'etiqueta' => [
            'min_length' => 'Número de etiqueta no válido',
            'required' => 'Por favor ingrese la etiqueta del equipo',
            'is_unique' => 'Este número de etiqueta ya existe'
        ],

        'cantidad' => [
            'required' => 'Por favor ingrese la cantidad de equipos',
            'min_length' => 'Cantidad nula'
        ],

        'descripcion' => [
            'required' => 'Se requiere una descripción del equipo',
             'alpha_numeric_space' => 'Ingrese una descripción válida'
        ],

        'modelo' => [
            'required' => 'Por favor ingrese el modelo del equipo',
            'alpha_numeric_space' => 'Ingrese un modelo válido'
        ],

        'idMarca' => [
            'required' => 'El id de la marca es requerido',
            'is_natural_no_zero' => 'El ID ingresado es nulo'
        ],

        'serie' => [
            'required' => 'Por favor ingresar el número de serie',
            'alpha_numeric' => 'Ingrese un número de serie válido'
        ],

        'costo' => [
            'required' => 'Por favor ingresar el costo'
        ],

        'idEstado' => [
            'required' => 'Este campo es requerido',
            'is_natural_no_zero' => 'El ID ingresado es nulo'
        ],

        'observacion' => [
            'alpha_numeric_space' => 'Por favor ingresar una observación válida'
        ]
    ];

    protected $skipValidation = false;
}
