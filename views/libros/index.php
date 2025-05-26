<div class="container py-5">
    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body bg-gradient" style="background: linear-gradient(90deg, #f8fafc 60%, #e3f2fd 100%);">
                    <div class="mb-4 text-center">
                        <h5 class="fw-bold text-secondary mb-2">Registro de Libros</h5>
                        <h3 class="fw-bold text-primary mb-0">REGISTRAR NUEVO LIBRO</h3>
                    </div>
                    <form id="FormLibros" class="p-4 bg-white rounded-3 shadow-sm border">
                        <input type="hidden" id="libro_id" name="libro_id">
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="libro_titulo" class="form-label">Título del Libro</label>
                                <input type="text" class="form-control form-control-lg" id="libro_titulo" name="libro_titulo" placeholder="Ingrese el título del libro" required>
                            </div>
                            <div class="col-md-6">
                                <label for="libro_autor" class="form-label">Autor del Libro</label>
                                <input type="text" class="form-control form-control-lg" id="libro_autor" name="libro_autor" placeholder="Ingrese el autor del libro" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-success btn-lg px-4 shadow" type="submit" id="BtnGuardarLibro">
                                <i class="bi bi-save me-2"></i>Guardar Libro
                            </button>
                            <button class="btn btn-warning btn-lg px-4 shadow d-none" type="button" id="BtnModificarLibro">
                                <i class="bi bi-pencil-square me-2"></i>Modificar Libro
                            </button>
                            <button class="btn btn-secondary btn-lg px-4 shadow" type="reset" id="BtnLimpiarLibro">
                                <i class="bi bi-eraser me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row mb-5 justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-body bg-gradient" style="background: linear-gradient(90deg, #f8fafc 60%, #e3f2fd 100%);">
                    <div class="mb-4 text-center">
                        <h5 class="fw-bold text-secondary mb-2">Registro de Libros Prestados</h5>
                        <h3 class="fw-bold text-primary mb-0">REGISTRAR PRÉSTAMO DE LIBRO</h3>
                    </div>
                    <form id="FormPrestamos" class="p-4 bg-white rounded-3 shadow-sm border">
                        <input type="hidden" id="prestamo_id" name="prestamo_id">
                        <div class="row g-4 mb-3">
                            <div class="col-md-6">
                                <label for="libro_id_prestamo" class="form-label">Seleccionar Libro</label>
                                <select name="libro_id" class="form-select form-select-lg" id="libro_id_prestamo" required>
                                    <option value="">Seleccione un libro</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="persona_nombre" class="form-label">Nombre de la Persona</label>
                                <input type="text" class="form-control form-control-lg" id="persona_nombre" name="persona_nombre" placeholder="Ingrese el nombre completo" required>
                            </div>
                        </div>
                        <div class="row g-4 mb-4">
                            <div class="col-md-6">
                                <label for="fecha_prestamo" class="form-label">Fecha de Préstamo</label>
                                <input type="datetime-local" class="form-control form-control-lg" id="fecha_prestamo" name="fecha_prestamo" required>
                            </div>
                        </div>
                        <div class="d-flex justify-content-center gap-3">
                            <button class="btn btn-success btn-lg px-4 shadow" type="submit" id="BtnGuardar">
                                <i class="bi bi-save me-2"></i>Guardar Préstamo
                            </button>
                            <button class="btn btn-warning btn-lg px-4 shadow d-none" type="button" id="BtnModificar">
                                <i class="bi bi-pencil-square me-2"></i>Modificar Préstamo
                            </button>
                            <button class="btn btn-secondary btn-lg px-4 shadow" type="reset" id="BtnLimpiar">
                                <i class="bi bi-eraser me-2"></i>Limpiar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mt-5">
        <div class="col-lg-11">
            <div class="card shadow-lg border-primary rounded-4">
                <div class="card-body">
                    <h3 class="text-center text-primary mb-4">Libros prestados registrados en la base de datos</h3>

                    <div class="row g-4 mb-4">
                        <div class="col-md-4">
                            <label for="fecha_inicio" class="form-label">Fecha de inicio</label>
                            <input type="date" id="fecha_inicio" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4">
                            <label for="fecha_fin" class="form-label">Fecha de fin</label>
                            <input type="date" id="fecha_fin" class="form-control form-control-lg">
                        </div>
                        <div class="col-md-4 d-flex align-items-end">
                            <button class="btn btn-primary btn-lg w-100 shadow" id="btn_filtrar_fecha">
                                <i class="bi bi-funnel-fill me-2"></i>Buscar por fecha
                            </button>
                        </div>
                    </div>

                    <div class="table-responsive">
                        <table class="table table-striped table-hover table-bordered align-middle rounded-3 overflow-hidden" id="TablePrestamos">
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
<script src="<?= asset('build/js/libros/index.js') ?>"></script>