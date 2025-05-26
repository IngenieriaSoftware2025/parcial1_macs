import { Dropdown } from "bootstrap";
import Swal from "sweetalert2";
import { validarFormulario } from '../funciones';
import DataTable from "datatables.net-bs5";
import { lenguaje } from "../lenguaje";
import { data } from "jquery";

const FormLibros = document.getElementById('FormLibros');
const BtnGuardarLibro = document.getElementById('BtnGuardarLibro');
const BtnModificarLibro = document.getElementById('BtnModificarLibro');
const BtnLimpiarLibro = document.getElementById('BtnLimpiarLibro');
const FormPrestamos = document.getElementById('FormPrestamos');
const BtnGuardar = document.getElementById('BtnGuardar');
const BtnModificar = document.getElementById('BtnModificar');
const BtnLimpiar = document.getElementById('BtnLimpiar');
const libro_id_prestamo = document.getElementById('libro_id_prestamo');
const persona_nombre = document.getElementById('persona_nombre');
const FechaInicio = document.getElementById('fecha_inicio');
const FechaFin = document.getElementById('fecha_fin');
const BtnFiltrarFecha = document.getElementById('btn_filtrar_fecha');


const ValidarPersonaNombre = () => {

    const CantidadCaracteres = persona_nombre.value

    if (CantidadCaracteres.length < 1) {

        persona_nombre.classList.remove('is-valid', 'is-invalid');

    } else {

        if (CantidadCaracteres.length < 2) {
            Swal.fire({
                position: "center",
                icon: "error",
                title: "Revise el nombre de la persona",
                text: "La cantidad de caracteres debe ser mayor a 2",
                showConfirmButton: true,
            });

            persona_nombre.classList.remove('is-valid');
            persona_nombre.classList.add('is-invalid');

        } else {
            persona_nombre.classList.remove('is-invalid');
            persona_nombre.classList.add('is-valid');
        }

    }
}

const GuardarLibro = async (event) => {

    event.preventDefault();
    BtnGuardarLibro.disabled = true;

    if (!validarFormulario(FormLibros, ['libro_id'])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardarLibro.disabled = false;
        return;
    }

    const body = new FormData(FormLibros);

    const url = '/parcial1_macs/libros/guardarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        console.log(datos)
        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodoLibros();
            CargarLibros();
            BuscarLibros();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });

        }


    } catch (error) {
        console.log(error)
    }
    BtnGuardarLibro.disabled = false;

}

const CargarLibros = async () => {

    const url = '/parcial1_macs/libros/buscarAPI';
    const config = {
        method: 'GET'
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, data } = datos

        if (codigo == 1) {

            libro_id_prestamo.innerHTML = '<option value="">-- Seleccione un libro --</option>';
            
            if (data && data.length > 0) {
                data.forEach(libro => {
                    const option = document.createElement('option');
                    option.value = libro.libro_id;
                    option.textContent = `${libro.libro_titulo} - ${libro.libro_autor}`;
                    libro_id_prestamo.appendChild(option);
                });
            }

        }

    } catch (error) {
        console.log(error)
    }
}

const BuscarLibros = async () => {

    const url = '/parcial1_macs/libros/buscarAPI';
    const config = {
        method: 'GET'
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {

            datatableLibros.clear().draw();
            if (data && data.length > 0) {
                datatableLibros.rows.add(data).draw();
            }

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }


    } catch (error) {
        console.log(error)
    }
}

const GuardarPrestamo = async (event) => {

    event.preventDefault();
    BtnGuardar.disabled = true;

    if (!validarFormulario(FormPrestamos, ['prestamo_id'])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnGuardar.disabled = false;
        return;
    }

    const body = new FormData(FormPrestamos);

    const url = '/parcial1_macs/prestamos/guardarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        console.log(datos)
        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarPrestamos();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });

        }


    } catch (error) {
        console.log(error)
    }
    BtnGuardar.disabled = false;

}

const BuscarPrestamos = async () => {

    const fecha_inicio = FechaInicio?.value || '';
    const fecha_fin = FechaFin?.value || '';

    const params = new URLSearchParams();

    if (fecha_inicio) params.append('fecha_inicio', fecha_inicio);
    if (fecha_fin) params.append('fecha_fin', fecha_fin);

    const url = `/parcial1_macs/prestamos/buscarAPI?${params.toString()}`;
    const config = {
        method: 'GET'
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje, data } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            datatable.clear().draw();
            if (data && data.length > 0) {
                datatable.rows.add(data).draw();
            }

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });
        }


    } catch (error) {
        console.log(error)
    }
}

const datatable = new DataTable('#TablePrestamos', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    columns: [
        {
            title: 'No.',
            data: 'prestamo_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Libro', data: 'libro_titulo' },
        { title: 'Autor', data: 'libro_autor' },
        { title: 'Persona', data: 'persona_nombre' },
        { title: 'Fecha Prestamo', data: 'fecha_prestamo'},
        { title: 'Fecha Devolucion', data: 'fecha_devolucion'},
        {
            title: 'Estado',
            data: 'prestamo_situacion',
            render: (data, type, row) => {

                const estado = row.prestamo_situacion

                if (estado == 1) {
                    return "<span class='badge bg-danger'>PRESTADO</span>"
                } else if (estado == 0) {
                    return "<span class='badge bg-success'>DEVUELTO</span>"
                }
            }
        },
        {
            title: 'Acciones',
            data: 'prestamo_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                
                const estado = row.prestamo_situacion;
                
                if (estado == 1) {
                    return `
                     <div class='d-flex justify-content-center'>
                         <button class='btn btn-success devolver mx-1' 
                             data-id="${data}">
                            <i class="bi bi-arrow-return-left me-1"></i>Devolver
                         </button>
                         <button class='btn btn-danger eliminar mx-1' 
                             data-id="${data}">
                            <i class="bi bi-trash3 me-1"></i>Eliminar
                         </button>
                     </div>`;
                } else {
                    return `
                     <div class='d-flex justify-content-center'>
                         <button class='btn btn-warning modificar mx-1' 
                             data-id="${data}" 
                             data-libro="${row.libro_id}"  
                             data-persona="${row.persona_nombre}"  
                             data-fecha="${row.fecha_prestamo}">
                             <i class='bi bi-pencil-square me-1'></i> Modificar
                         </button>
                         <button class='btn btn-danger eliminar mx-1' 
                             data-id="${data}">
                            <i class="bi bi-trash3 me-1"></i>Eliminar
                         </button>
                     </div>`;
                }
            }
        }
    ]
});

const datatableLibros = new DataTable('#TableLibros', {
    dom: `
        <"row mt-3 justify-content-between" 
            <"col" l> 
            <"col" B> 
            <"col-3" f>
        >
        t
        <"row mt-3 justify-content-between" 
            <"col-md-3 d-flex align-items-center" i> 
            <"col-md-8 d-flex justify-content-end" p>
        >
    `,
    language: lenguaje,
    data: [],
    columns: [
        {
            title: 'No.',
            data: 'libro_id',
            width: '%',
            render: (data, type, row, meta) => meta.row + 1
        },
        { title: 'Título', data: 'libro_titulo' },
        { title: 'Autor', data: 'libro_autor' },
        {
            title: 'Acciones',
            data: 'libro_id',
            searchable: false,
            orderable: false,
            render: (data, type, row, meta) => {
                return `
                 <div class='d-flex justify-content-center'>
                     <button class='btn btn-warning modificarLibro mx-1' 
                         data-id="${data}" 
                         data-titulo="${row.libro_titulo}"  
                         data-autor="${row.libro_autor}">
                         <i class='bi bi-pencil-square me-1'></i> Modificar
                     </button>
                     <button class='btn btn-danger eliminarLibro mx-1' 
                         data-id="${data}">
                        <i class="bi bi-trash3 me-1"></i>Eliminar
                     </button>
                 </div>`;
            }
        }
    ]
});

const llenarFormulario = (event) => {

    const datos = event.currentTarget.dataset

    document.getElementById('prestamo_id').value = datos.id
    document.getElementById('libro_id_prestamo').value = datos.libro
    document.getElementById('persona_nombre').value = datos.persona
    document.getElementById('fecha_prestamo').value = datos.fecha

    BtnGuardar.classList.add('d-none');
    BtnModificar.classList.remove('d-none');

    window.scrollTo({
        top: 0,
    })

}

const llenarFormularioLibros = (event) => {

    const datos = event.currentTarget.dataset

    document.getElementById('libro_id').value = datos.id
    document.getElementById('libro_titulo').value = datos.titulo
    document.getElementById('libro_autor').value = datos.autor

    BtnGuardarLibro.classList.add('d-none');
    BtnModificarLibro.classList.remove('d-none');

    window.scrollTo({
        top: 0,
    })

}

const limpiarTodo = () => {

    FormPrestamos.reset();
    BtnGuardar.classList.remove('d-none');
    BtnModificar.classList.add('d-none');
}

const limpiarTodoLibros = () => {

    FormLibros.reset();
    BtnGuardarLibro.classList.remove('d-none');
    BtnModificarLibro.classList.add('d-none');
}

const ModificarPrestamo = async (event) => {

    event.preventDefault();
    BtnModificar.disabled = true;

    if (!validarFormulario(FormPrestamos, [''])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnModificar.disabled = false;
        return;
    }

    const body = new FormData(FormPrestamos);

    const url = '/parcial1_macs/prestamos/modificarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodo();
            BuscarPrestamos();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });

        }


    } catch (error) {
        console.log(error)
    }
    BtnModificar.disabled = false;

}

const ModificarLibro = async (event) => {

    event.preventDefault();
    BtnModificarLibro.disabled = true;

    if (!validarFormulario(FormLibros, [''])) {
        Swal.fire({
            position: "center",
            icon: "info",
            title: "FORMULARIO INCOMPLETO",
            text: "Debe de validar todos los campos",
            showConfirmButton: true,
        });
        BtnModificarLibro.disabled = false;
        return;
    }

    const body = new FormData(FormLibros);

    const url = '/parcial1_macs/libros/modificarAPI';
    const config = {
        method: 'POST',
        body
    }

    try {

        const respuesta = await fetch(url, config);
        const datos = await respuesta.json();
        const { codigo, mensaje } = datos

        if (codigo == 1) {

            await Swal.fire({
                position: "center",
                icon: "success",
                title: "Exito",
                text: mensaje,
                showConfirmButton: true,
            });

            limpiarTodoLibros();
            CargarLibros();
            BuscarLibros();

        } else {

            await Swal.fire({
                position: "center",
                icon: "info",
                title: "Error",
                text: mensaje,
                showConfirmButton: true,
            });

        }


    } catch (error) {
        console.log(error)
    }
    BtnModificarLibro.disabled = false;

}

const EliminarPrestamos = async (e) => {

    const idPrestamo = e.currentTarget.dataset.id

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que desea eliminar este registro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: 'red',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {

        const url =`/parcial1_macs/prestamos/eliminar?id=${idPrestamo}`;
        const config = {
            method: 'GET'
        }

        try {

            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {

                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
                BuscarPrestamos();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }

        } catch (error) {
            console.log(error)
   }

}

}

const EliminarLibros = async (e) => {

    const idLibro = e.currentTarget.dataset.id

    const AlertaConfirmarEliminar = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea ejecutar esta acción?",
        text: 'Esta completamente seguro que desea eliminar este registro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Eliminar',
        confirmButtonColor: 'red',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarEliminar.isConfirmed) {

        const url =`/parcial1_macs/libros/eliminar?id=${idLibro}`;
        const config = {
            method: 'GET'
        }

        try {

            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {

                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
                CargarLibros();
                BuscarLibros();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }

        } catch (error) {
            console.log(error)
   }

}

}

const DevolverPrestamo = async (e) => {

    const idPrestamo = e.currentTarget.dataset.id

    const AlertaConfirmarDevolucion = await Swal.fire({
        position: "center",
        icon: "info",
        title: "¿Desea marcar como devuelto?",
        text: 'Esta completamente seguro que desea devolver este libro',
        showConfirmButton: true,
        confirmButtonText: 'Si, Devolver',
        confirmButtonColor: 'green',
        cancelButtonText: 'No, Cancelar',
        showCancelButton: true
    });

    if (AlertaConfirmarDevolucion.isConfirmed) {

        const url =`/parcial1_macs/prestamos/devolver?id=${idPrestamo}`;
        const config = {
            method: 'GET'
        }

        try {

            const consulta = await fetch(url, config);
            const respuesta = await consulta.json();
            const { codigo, mensaje } = respuesta;

            if (codigo == 1) {

                await Swal.fire({
                    position: "center",
                    icon: "success",
                    title: "Exito",
                    text: mensaje,
                    showConfirmButton: true,
                });
                
                BuscarPrestamos();
            } else {
                await Swal.fire({
                    position: "center",
                    icon: "error",
                    title: "Error",
                    text: mensaje,
                    showConfirmButton: true,
                });
            }

        } catch (error) {
            console.log(error)
   }

}

}

CargarLibros();
BuscarPrestamos();
BuscarLibros();
datatable.on('click', '.eliminar', EliminarPrestamos);
datatable.on('click', '.modificar', llenarFormulario);
datatable.on('click', '.devolver', DevolverPrestamo);
datatableLibros.on('click', '.eliminarLibro', EliminarLibros);
datatableLibros.on('click', '.modificarLibro', llenarFormularioLibros);
FormLibros.addEventListener('submit', GuardarLibro);
FormPrestamos.addEventListener('submit', GuardarPrestamo);
persona_nombre.addEventListener('change', ValidarPersonaNombre);
BtnLimpiar.addEventListener('click', limpiarTodo);
BtnLimpiarLibro.addEventListener('click', limpiarTodoLibros);
BtnModificar.addEventListener('click', ModificarPrestamo);
BtnModificarLibro.addEventListener('click', ModificarLibro);
BtnFiltrarFecha.addEventListener('click', BuscarPrestamos);