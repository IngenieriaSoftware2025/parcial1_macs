<style>
        body {
            background: linear-gradient(135deg,rgb(109, 109, 109) 0%,rgb(179, 188, 204) 100%);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            min-height: 100vh;
            background-color: #f8f9fa;
        }

        .header {
            padding: 2rem;
            text-align: center;
            border-radius: 15px;
            margin-top: 2rem;
            margin-bottom: 2rem;
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .logo {
            font-size: 3rem;
            font-weight: bold;
            color: #2d3748;
            margin-bottom: 1rem;
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .container {
            max-width: 1140px;
            margin-left: auto;
            margin-right: auto;
        }
        
        .product-img {
          border-radius: 10px;
          width: 100%;
          height: 100%;
          max-height: 300px;
          object-fit: cover;
          transition: transform 0.3s ease, box-shadow 0.3s ease;
          box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
          margin-bottom: 1rem;
        }

        .product-img:hover {
          transform: scale(1.05) rotate(-2deg);
          box-shadow: 0 8px 24px rgba(0, 0, 0, 0.3);
          cursor: pointer;
        }
        
    </style>
<body>
    <div class="header">
        <div class="logo">Bienvenido a tu Aplicación de Libros</div>
    </div>
    
    <div class="container">
        <div class="row mb-5">
            <div class="col-md-8 mx-auto text-center">
                <p class="lead">
                    Simplifica tu vida y organiza fácilmente tus libros prestados, para hacer tu día a día más sencillo y eficiente."
                </p>
            </div>
        </div>
        
        <div class="row mb-4">
            <div class="col-12 text-center mb-4">
                <h2 class="text-uppercase fw-bold">Categorias de Libros</h2>
                <p class="text-muted">Organiza tus libros prestados de una forma mas util y ordenada para ti.</p>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://i.blogs.es/5e1e56/portada_nieve-en-marte_pablo-tebar-goyanes_201709121110/450_1000.jpg" class="card-img-top product-img" alt="Ficción">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Libros de Ficción</h5>
                        <p class="card-text text-muted">Organiza tus libros de ficción de una mejor forma y eficiente.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://www.educaciontrespuntocero.com/wp-content/uploads/2021/04/humanizar-la-educacion.jpg" class="card-img-top product-img" alt="Educación">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Libros Educativos</h5>
                        <p class="card-text text-muted">Controla tus libros educativos de una mejor forma y eficiente para el aprendizaje.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mb-4">
                <div class="card border-0 shadow-sm h-100">
                    <img src="https://s.libertaddigital.com/fotos/noticias/mercado_de_invierno_300x452.jpg" class="card-img-top product-img" alt="Técnicos">
                    <div class="card-body text-center">
                        <h5 class="card-title fw-bold">Libros Técnicos</h5>
                        <p class="card-text text-muted">Organiza tus libros técnicos de una mejor forma y eficiente.</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row mt-5">
            <div class="col-md-6 mx-auto text-center">
                <h2 class="mb-4 text-uppercase fw-bold">Aspectos Importantes</h2><br>
                <p><strong>Organiza:</strong> distribuye y busca los mejores libros para un mejor control de préstamos.</p>
                <p><strong>Prioriza:</strong> determina la importancia o urgencia de prestar ciertos libros sobre otros.</p>
                <p><strong>Planifica:</strong> identifica necesidades específicas para garantizar un control ordenado y eficiente.</p>
                <a href="/parcial1_macs/libros" class="btn btn-primary mt-3">Conoce tu aplicación</a>
            </div>
        </div>
    </div>
        <script src="build/js/inicio.js"></script>
  </body>