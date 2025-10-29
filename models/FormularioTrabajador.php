<?php
namespace Model;

class FormularioTrabajador extends ActiveRecord {
    protected static $tabla = 'planilla';
    protected static $columnasDB = [
        'id', 'empresa', 'nombres', 'apellidos', 'sexo', 'nacionalidad', 
        'fecha_nacimiento', 'cedula', 'edad', 'estado_civil', 'lugar_nacimiento',
        'numero_hijos', 'correo', 'telefono', 'telefono_emergencia', 'direccion',
        'talla_camisa', 'talla_pantalon', 'talla_calzado', 'peso', 'estatura',
        'tipo_sangre', 'alergias', 'tenencia_vivienda', 'vehiculo_propio',
        'licencia_conducir', 'informacion_familiar', 'informacion_academica',
        'formacion_complementaria', 'experiencia_laboral', 'areas_interes',
        'departamento', 'supervisor_inmediato', 'fecha_creacion', 'rif_archivo',
        'rif_vencimiento', 'cedula_archivo', 'cedula_vencimiento', 'registro_via_correo',
    ];

    public $id;
    public $empresa;
    public $nombres;
    public $apellidos;  
    public $sexo;
    public $nacionalidad;
    
    public $fecha_nacimiento;
    public $cedula;
    public $edad;
    public $estado_civil;
    public $lugar_nacimiento;
    public $numero_hijos;
    public $correo;
    public $telefono;
    public $telefono_emergencia;
    public $direccion;
    public $talla_camisa;
    public $talla_pantalon;
    public $talla_calzado;
    public $peso;
    public $estatura;
    public $tipo_sangre;
    public $alergias;
    public $tenencia_vivienda;
    public $vehiculo_propio;
    public $licencia_conducir;
    public $informacion_familiar;
    public $informacion_academica;
    public $formacion_complementaria;
    public $experiencia_laboral;
    public $areas_interes;
    public $departamento;
    public $supervisor_inmediato;
    public $fecha_ingreso;
    public $fecha_creacion;
    public $rif_archivo;
    public $rif_vencimiento;    
    public $cedula_archivo;
    public $cedula_vencimiento;
    public $registro_via_correo;


    // ... (declara todas las propiedades según columnasDB)

    public function __construct($args = []) {
        $this->id = $args['id'] ?? null;
        $this->empresa = $args['empresa'] ?? '';
        $this->nombres = $args['nombres'] ?? '';
        $this->apellidos = $args['apellidos'] ?? '';
        $this->sexo = $args['sexo'] ?? '';
        $this->nacionalidad = $args['nacionalidad'] ?? '';
        $this->fecha_nacimiento = $args['fecha_nacimiento'] ?? '';
        $this->cedula = $args['cedula'] ?? '';
        $this->edad = $args['edad'] ?? '';
        $this->estado_civil = $args['estado_civil'] ?? '';
        $this->lugar_nacimiento = $args['lugar_nacimiento'] ?? '';
        $this->numero_hijos = $args['numero_hijos'] ?? '';
        $this->correo = $args['correo'] ?? '';
        $this->telefono = $args['telefono'] ?? '';
        $this->telefono_emergencia = $args['telefono_emergencia'] ?? '';
        $this->direccion = $args['direccion'] ?? '';
        $this->talla_camisa = $args['talla_camisa'] ?? '';
        $this->talla_pantalon = $args['talla_pantalon'] ?? '';
        $this->talla_calzado = $args['talla_calzado'] ?? '';
        $this->peso = $args['peso'] ?? '';
        $this->estatura = $args['estatura'] ?? '';
        $this->tipo_sangre = $args['tipo_sangre'] ?? '';
        $this->alergias = $args['alergias'] ?? '';
        $this->tenencia_vivienda = $args['tenencia_vivienda'] ?? '';
        $this->vehiculo_propio = $args['vehiculo_propio'] ?? '';
        $this->licencia_conducir = $args['licencia_conducir'] ?? '';
        $this->informacion_familiar = $args['informacion_familiar'] ?? '';
        $this->informacion_academica = $args['informacion_academica'] ?? '';
        $this->formacion_complementaria = $args['formacion_complementaria'] ?? '';
        $this->experiencia_laboral = $args['experiencia_laboral'] ?? '';
        $this->areas_interes = $args['areas_interes'] ?? '';
        $this->departamento = $args['departamento'] ?? '';
        $this->supervisor_inmediato = $args['supervisor_inmediato'] ?? '';
        $this->fecha_ingreso = $args['fecha_ingreso'] ?? '';
        $this->fecha_creacion = $args['fecha_creacion'] ?? '';
        $this->rif_archivo = $args['rif_archivo'] ?? '';
        $this->rif_vencimiento = $args['rif_vencimiento'] ??  null;
        $this->cedula_archivo = $args['cedula_archivo'] ?? '';
        $this->cedula_vencimiento = $args['cedula_vencimiento'] ??  null;
        $this->registro_via_correo = $args['registro_via_correo'] ?? 0;
    
        // ... (inicializa todas las propiedades)
        $this->fecha_creacion = date('Y-m-d H:i:s');
    }

    public function validar() {
        self::$alertas = [];
        
        if(!$this->nombres) self::$alertas['error'][] = 'Los nombres son obligatorios';
        if(!$this->apellidos) self::$alertas['error'][] = 'Los apellidos son obligatorios';
        if(!$this->sexo) self::$alertas['error'][] = 'El sexo es obligatorio';
        if(!$this->nacionalidad) self::$alertas['error'][] = 'La nacionalidad es obligatoria';
        if(!$this->fecha_nacimiento) self::$alertas['error'][] = 'La fecha de nacimiento es obligatoria';
        if(!$this->cedula) self::$alertas['error'][] = 'La cédula es obligatoria';
        if(!$this->edad) self::$alertas['error'][] = 'La edad es obligatoria';
        if(!$this->estado_civil) self::$alertas['error'][] = 'El estado civil es obligatorio';
        if(!$this->lugar_nacimiento) self::$alertas['error'][] = 'El lugar de nacimiento es obligatorio';
        if(!$this->numero_hijos) self::$alertas['error'][] = 'El número de hijos es obligatorio';
        if(!$this->correo) self::$alertas['error'][] = 'El correo electrónico es obligatorio';
        if(!$this->telefono) self::$alertas['error'][] = 'El teléfono es obligatorio';
        if(!$this->telefono_emergencia) self::$alertas['error'][] = 'El teléfono de emergencia es obligatorio';
        if(!$this->direccion) self::$alertas['error'][] = 'La dirección es obligatoria';
        if(!$this->talla_camisa) self::$alertas['error'][] = 'La talla de camisa es obligatoria';
        if(!$this->talla_pantalon) self::$alertas['error'][] = 'La talla de pantalón es obligatoria';
        if(!$this->talla_calzado) self::$alertas['error'][] = 'La talla de calzado es obligatoria';
        if(!$this->peso) self::$alertas['error'][] = 'El peso es obligatorio';
        if(!$this->estatura) self::$alertas['error'][] = 'La estatura es obligatoria';
        if(!$this->tipo_sangre) self::$alertas['error'][] = 'El tipo de sangre es obligatorio';
        if(!$this->tenencia_vivienda) self::$alertas['error'][] = 'La tenencia de vivienda es obligatoria';
        if(!$this->vehiculo_propio) self::$alertas['error'][] = 'Indica si tienes vehículo propio';
        if(!$this->licencia_conducir) self::$alertas['error'][] = 'Indica si tienes licencia de conducir';
        if(!$this->informacion_familiar) self::$alertas['error'][] = 'La información familiar es obligatoria';
        if(!$this->informacion_academica) self::$alertas['error'][] = 'La información académica es obligatoria';
        
        if(!$this->departamento) self::$alertas['error'][] = 'El departamento es obligatorio';
        if(!$this->supervisor_inmediato) self::$alertas['error'][] = 'El supervisor inmediato es obligatorio';
        if(!$this->fecha_ingreso) self::$alertas['error'][] = 'La fecha de ingreso es obligatoria';
        if(!$this->empresa) self::$alertas['error'][] = 'La empresa es obligatoria';
        if(!$this->rif_archivo) self::$alertas['error'][] = 'El archivo del RIF es obligatorio';
        if(!$this->rif_vencimiento) self::$alertas['error'][] = 'La fecha de vencimiento del RIF es obligatoria';
        if(!$this->cedula_archivo) self::$alertas['error'][] = 'El archivo de la cédula es obligatorio';
        if(!$this->cedula_vencimiento) self::$alertas['error'][] = 'La fecha de vencimiento de la cédula es obligatoria';
        if(!$this->registro_via_correo) self::$alertas['error'][] = 'El registro vía correo es obligatorio';
        // ... (agrega validaciones para todos los campos requeridos)
        
        return self::$alertas;
    }
    
        public static function consultarSQL($query, $parametros = []) {
            $stmt = self::$db->prepare($query);
            if (!$stmt) {
                throw new \Exception("Error en la preparación de la consulta: " . self::$db->error);
            }

            // Si hay parámetros, los enlazamos dinámicamente
            if (!empty($parametros)) {
                // Extraer los valores y tipos
                $tipos = str_repeat('s', count($parametros)); // asume que todos son strings
                $stmt->bind_param($tipos, ...array_values($parametros));
            }

            $stmt->execute();
            $resultado = $stmt->get_result();

            $registros = [];
            while ($fila = $resultado->fetch_assoc()) {
                $registros[] = new static($fila);
            }

            $stmt->close();

            return $registros;
        }

        //notificaciones
        public static function totalRegistradasPorLink(): int {
        $query = "SELECT COUNT(*) FROM " . static::$tabla . " WHERE registro_via_correo = 1";
        $resultado = self::$db->query($query);
        $fila = $resultado->fetch_assoc();
        return (int) $fila['COUNT(*)'];
        }
        
        public static function trabajadoresNoNotificados() {
        $query = "SELECT * FROM " . static::$tabla . " WHERE registro_via_correo = 1 AND notificado = 0";
        return self::consultarSQL($query);
         }

        public static function marcarNotificacionesComoVistas() {
            $query = "UPDATE " . static::$tabla . " SET notificado = 1, registro_via_correo = 0 WHERE registro_via_correo = 1 AND notificado = 0";
            return self::$db->query($query);
        }

    // Estadísticas comunes
    // Devuelve estadísticas comunes de trabajadores: sexo, empresa y edades agrupadas
        public static function estadisticasComunes() {
    // Sexo
        $sqlSexo = "SELECT sexo, COUNT(*) as cantidad FROM " . static::$tabla . " GROUP BY sexo";
        $resultadoSexo = self::$db->query($sqlSexo);
        $sexo = ['Masculino' => 0, 'Femenino' => 0, 'Otro' => 0];
        while($row = $resultadoSexo->fetch_assoc()) {
            $key = ucfirst(strtolower($row['sexo']));
            if(isset($sexo[$key])) {
                $sexo[$key] = (int)$row['cantidad'];
            } else {
                $sexo['Otro'] += (int)$row['cantidad'];
            }
        }

        // Empresa
        $sqlEmpresa = "SELECT empresa, COUNT(*) as cantidad FROM " . static::$tabla . " GROUP BY empresa";
        $resultadoEmpresa = self::$db->query($sqlEmpresa);
        $empresa = [];
        while($row = $resultadoEmpresa->fetch_assoc()) {
            $empresa[$row['empresa']] = (int)$row['cantidad'];
        }

        // Edades (agrupadas)
        $sqlEdad = "SELECT edad FROM " . static::$tabla;
        $resultadoEdad = self::$db->query($sqlEdad);
        $edades = [0, 0, 0, 0]; // 18-25, 26-35, 36-45, 46+
        while($row = $resultadoEdad->fetch_assoc()) {
            $edad = (int)$row['edad'];
            if($edad >= 18 && $edad <= 25) $edades[0]++;
            elseif($edad >= 26 && $edad <= 35) $edades[1]++;
            elseif($edad >= 36 && $edad <= 45) $edades[2]++;
            else $edades[3]++;
        }

        return [
            'sexo' => array_values($sexo),
            'empresa' => $empresa,
            'edades' => $edades
        ];
    }
        public static function estadisticasPorMes() {
        $sql = "SELECT DATE_FORMAT(fecha_creacion, '%Y-%m') as mes, COUNT(*) as cantidad FROM " . static::$tabla . " GROUP BY mes ORDER BY mes ASC";
        $resultado = self::$db->query($sql);

        $fechas = [];
        $ingresos = [];
        while($row = $resultado->fetch_assoc()) {
            $fechas[] = $row['mes'];
            $ingresos[] = (int) $row['cantidad'];
        }

        return array_merge(self::estadisticasComunes(), [
            'fechas' => $fechas,
            'ingresosPorDia' => $ingresos
        ]);
    }

            public static function estadisticasPorDia() {
            $sql = "SELECT DATE(fecha_creacion) as fecha, COUNT(*) as cantidad FROM " . static::$tabla . " GROUP BY DATE(fecha_creacion) ORDER BY fecha ASC";
            $resultado = self::$db->query($sql);

            $fechas = [];
            $ingresos = [];
            while($row = $resultado->fetch_assoc()) {
                $fechas[] = $row['fecha'];
                $ingresos[] = (int) $row['cantidad'];
            }

            return array_merge(self::estadisticasComunes(), [
                'fechas' => $fechas,
                'ingresosPorDia' => $ingresos
            ]);
        }
        public static function estadisticasPorAnio() {
        $sql = "SELECT YEAR(fecha_creacion) as anio, COUNT(*) as cantidad FROM " . static::$tabla . " GROUP BY anio ORDER BY anio ASC";
        $resultado = self::$db->query($sql);

        $fechas = [];
        $ingresos = [];
        while($row = $resultado->fetch_assoc()) {
            $fechas[] = $row['anio'];
            $ingresos[] = (int) $row['cantidad'];
        }

        return array_merge(self::estadisticasComunes(), [
            'fechas' => $fechas,
            'ingresosPorDia' => $ingresos
        ]);
    }



}