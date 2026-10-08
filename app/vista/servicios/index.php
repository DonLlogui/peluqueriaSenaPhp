<!-- HERO DE SERVICIOS -->
<section class="page-hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <span class="section-tag">NUESTROS SERVICIOS</span>
        <h1>Descubre lo que <span class="text-accent">ofrecemos</span></h1>
        <p>Servicios profesionales para que luzcas tu mejor versión</p>
    </div>
</section>

<!-- FILTROS -->
<section class="filtros-section">
    <div class="container">
        <div class="filtros-bar">
            <div class="search-box">
                <i class="fas fa-search"></i>
                <input type="text" id="searchServicios" placeholder="Buscar servicio...">
            </div>
            <div class="filter-buttons">
                <button class="filter-btn active" data-filter="todos">Todos</button>
                <button class="filter-btn" data-filter="corte">Cortes</button>
                <button class="filter-btn" data-filter="barba">Barba</button>
                <button class="filter-btn" data-filter="tratamiento">Tratamientos</button>
            </div>
            <?php if (isset($_SESSION['usuario_rol']) && $_SESSION['usuario_rol'] === 'admin'): ?>
                <a href="<?php echo BASE_URL; ?>servicios/crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Nuevo servicio
                </a>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- GRID DE SERVICIOS -->
<section class="section servicios-listado">
    <div class="container">
        <div class="servicios-grid-moderno" id="serviciosGrid">
            <?php if (isset($servicios) && count($servicios) > 0): ?>
                <?php 
                $iconos = ['fa-cut', 'fa-user-tie', 'fa-beard', 'fa-spa', 'fa-child', 'fa-palette', 'fa-wind', 'fa-star'];
                $categorias = ['corte', 'corte', 'barba', 'corte', 'corte', 'tratamiento', 'tratamiento', 'tratamiento'];
                ?>
                <?php foreach ($servicios as $index => $servicio): ?>
                    <div class="servicio-card-moderno" 
                         data-categoria="<?php echo $categorias[$index % count($categorias)]; ?>"
                         data-nombre="<?php echo strtolower($servicio['nombre']); ?>">
                        
                        <div class="card-header">
                            <div class="servicio-icono">
                                <i class="fas <?php echo $iconos[$index % count($iconos)]; ?>"></i>
                            </div>
                            <span class="card-categoria"><?php echo ucfirst($categorias[$index % count($categorias)]); ?></span>
                        </div>
                        
                        <div class="card-body">
                            <h3><?php echo htmlspecialchars($servicio['nombre']); ?></h3>
                            <p><?php echo htmlspecialchars($servicio['descripcion']); ?></p>
                            
                            <div class="servicio-detalles">
                                <div class="detalle">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo $servicio['duracion_min']; ?> min</span>
                                </div>
                                <div class="detalle">
                                    <i class="fas fa-star"></i>
                                    <span>Profesional</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="card-footer">
                            <div class="precio">
                                <span class="moneda">$</span>
                                <span class="monto"><?php echo number_format($servicio['precio'], 0, ',', '.'); ?></span>
                            </div>
                            <a href="<?php echo BASE_URL; ?>citas?servicio=<?php echo $servicio['id']; ?>" class="btn-reservar">
                                <i class="fas fa-calendar-check"></i> Reservar
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="empty-state">
                    <i class="fas fa-cut"></i>
                    <h3>No hay servicios disponibles</h3>
                    <p>Pronto agregaremos nuevos servicios</p>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- CTA FINAL -->
<section class="cta-section">
    <div class="container">
        <div class="cta-content">
            <h2>¿No sabes qué servicio <span class="text-accent">elegir</span>?</h2>
            <p>Nuestros barberos te asesoran para encontrar el look perfecto para ti</p>
            <a href="<?php echo BASE_URL; ?>citas" class="btn btn-white">
                <i class="fas fa-calendar-check"></i> Agendar cita
            </a>
        </div>
    </div>
</section>