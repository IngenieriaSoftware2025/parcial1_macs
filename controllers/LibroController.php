<?php

namespace Controllers;

use Exception;
use Model\ActiveRecord;
use Model\Libros;
use MVC\Router;

class LibroController extends ActiveRecord
{

    public function renderizarPagina(Router $router)
    {
        $router->render('libros/index', []);
    }

    public static function guardarAPI()
    {

        getHeadersApi();

        $_POST['libro_titulo'] = ucwords(strtolower(trim(htmlspecialchars($_POST['libro_titulo']))));

        $cantidad_titulo = strlen($_POST['libro_titulo']);

        if ($cantidad_titulo < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el titulo debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['libro_autor'] = ucwords(strtolower(trim(htmlspecialchars($_POST['libro_autor']))));

        $cantidad_autor = strlen($_POST['libro_autor']);

        if ($cantidad_autor < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el autor debe de ser mayor a dos'
            ]);
            return;
        }

        try {

            $data = new Libros([
                'libro_titulo' => $_POST['libro_titulo'],
                'libro_autor' => $_POST['libro_autor'],
                'libro_situacion' => 1
            ]);

            $crear = $data->crear();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Exito el libro ha sido registrado correctamente'
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

            $condiciones = ["libro_situacion = 1"];

            $where = implode(" AND ", $condiciones);

            $sql = "SELECT * FROM libros WHERE $where";
            $data = self::fetchArray($sql);

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'Libros obtenidos correctamente',
                'data' => $data
            ]);
        } catch (Exception $e) {
            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'Error al obtener los libros',
                'detalle' => $e->getMessage(),
            ]);
        }
    }

    public static function modificarAPI()
    {

        getHeadersApi();

        $id = $_POST['libro_id'];
        $_POST['libro_titulo'] = ucwords(strtolower(trim(htmlspecialchars($_POST['libro_titulo']))));

        $cantidad_titulo = strlen($_POST['libro_titulo']);

        if ($cantidad_titulo < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el titulo debe de ser mayor a dos'
            ]);
            return;
        }

        $_POST['libro_autor'] = ucwords(strtolower(trim(htmlspecialchars($_POST['libro_autor']))));

        $cantidad_autor = strlen($_POST['libro_autor']);

        if ($cantidad_autor < 2) {

            http_response_code(400);
            echo json_encode([
                'codigo' => 0,
                'mensaje' => 'La cantidad de digitos que debe de contener el autor debe de ser mayor a dos'
            ]);
            return;
        }

        try {

            $data = Libros::find($id);
            $data->sincronizar([
                'libro_titulo' => $_POST['libro_titulo'],
                'libro_autor' => $_POST['libro_autor'],
                'libro_situacion' => 1
            ]);
            $data->actualizar();

            http_response_code(200);
            echo json_encode([
                'codigo' => 1,
                'mensaje' => 'La informacion del libro ha sido modificada exitosamente'
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

            $data = Libros::find($id);
            $data->sincronizar([
                'libro_situacion' => 0
            ]);
            $data->actualizar();

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
}