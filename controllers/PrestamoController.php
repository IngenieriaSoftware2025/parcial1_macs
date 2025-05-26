<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Prestamos;
use MVC\Router;

class PrestamoController extends ActiveRecord
{

    public function renderizarPagina(Router $router)
    {
        $router->render('libros/index', []);
    }

    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['libro_id'] = filter_var($_POST['libro_id'], FILTER_VALIDATE_INT);

        if ($_POST['libro_id'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe seleccionar un libro válido'
            ]);
            return;
        }

        $_POST['persona_nombre'] = ucwords(strtolower(trim(htmlspecialchars($_POST['persona_nombre']))));

        $cantidad_nombre = strlen($_POST['persona_nombre']);

        if ($cantidad_nombre < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['fecha_prestamo'] = date('Y-m-d H:i', strtotime($_POST['fecha_prestamo']));

        try {

            $data = new Prestamos([
                'libro_id' => $_POST['libro_id'],
                'persona_nombre' => $_POST['persona_nombre'],
                'fecha_prestamo' => $_POST['fecha_prestamo'],
                'fecha_devolucion' => null,
                'prestamo_situacion' => 1
            ]);

            $crear = $data->crear();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Exito el prestamo ha sido registrado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function buscarAPI()
    {
        try {
            $fecha_inicio = isset($_GET['fecha_inicio']) ? $_GET['fecha_inicio'] : null;
            $fecha_fin = isset($_GET['fecha_fin']) ? $_GET['fecha_fin'] : null;

            $condiciones = ["p.prestamo_situacion >= 0"];

            if ($fecha_inicio) {
                $condiciones[] = "p.fecha_prestamo >= '{$fecha_inicio} 00:00'";
            }

            if ($fecha_fin) {
                $condiciones[] = "p.fecha_prestamo <= '{$fecha_fin} 23:59'";
            }

            $where = implode(" AND ", $condiciones);

            $sql = "SELECT p.*, l.libro_titulo, l.libro_autor 
                    FROM prestamos p 
                    LEFT JOIN libros l ON p.libro_id = l.libro_id 
                    WHERE $where";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Prestamos obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los prestamos',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {

        getHeadersApi();

        $id = $_POST['prestamo_id'];
        $_POST['libro_id'] = filter_var($_POST['libro_id'], FILTER_VALIDATE_INT);

        if ($_POST['libro_id'] <= 0) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Debe seleccionar un libro válido'
            ]);
            return;
        }

        $_POST['persona_nombre'] = ucwords(strtolower(trim(htmlspecialchars($_POST['persona_nombre']))));

        $cantidad_nombre = strlen($_POST['persona_nombre']);

        if ($cantidad_nombre < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el nombre debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['fecha_prestamo'] = date('Y-m-d H:i', strtotime($_POST['fecha_prestamo']));

        try {

            $data = Prestamos::find($id);
            $data->sincronizar([
                'libro_id' => $_POST['libro_id'],
                'persona_nombre' => $_POST['persona_nombre'],
                'fecha_prestamo' => $_POST['fecha_prestamo'],
                'prestamo_situacion' => 1
            ]);
            $data->actualizar();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'La informacion del prestamo ha sido modificada exitosamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al guardar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function EliminarAPI()
    {

        try {

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $ejecutar = Prestamos::EliminarPrestamos($id);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El registro ha sido eliminado correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al Eliminar',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function devolverAPI()
    {

        try {

            $id = filter_var($_GET['id'], FILTER_SANITIZE_NUMBER_INT);

            $data = Prestamos::find($id);
            $data->sincronizar([
                'fecha_devolucion' => date('Y-m-d H:i'),
                'prestamo_situacion' => 0
            ]);
            $data->actualizar();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'El libro ha sido devuelto correctamente'
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al devolver',
                'detalle' => $e->getMessage(),
            ]);
        }
    }
}