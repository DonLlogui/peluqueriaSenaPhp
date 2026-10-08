<section class="page-hero small">
    <div class="hero-overlay"></div>
    <div class="container">
        <span class="section-tag">ADMINISTRACIÓN</span>
        <h1>Crear <span class="text-accent">nuevo servicio</span></h1>
        <p>Agrega un nuevo servicio a nuestro catálogo</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-plus-circle"></i>
                </div>
                <h2>Información del servicio</h2>
                <p>Completa todos los campos para crear el servicio</p>
            </div>
            
            <form method="POST" action="<?php echo BASE_URL; ?>servicios/crear" class="form-moderno" id="formServicio">
                <div class="form-row">
                    <div class="form-group">
                        <label for="nombre">
                            <i class="fas fa-tag"></i> Nombre del servicio
                        </label>
                        <input type="text" id="nombre" name="nombre" 
                               placeholder="Ej: Corte Clásico" required>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="descripcion">
                            <i class="fas fa-align-left"></i> Descripción
                        </label>
                        <textarea id="descripcion" name="descripcion" 
                                  placeholder="Describe el servicio en detalle..." 
                                  rows="4" required></textarea>
                    </div>
                </div>
                
                <div class="form-row double">
                    <div class="form-group">
                        <label for="precio">
                            <i class="fas fa-dollar-sign"></i> Precio
                        </label>
                        <div class="input-icon">
                            <span class="input-prefix">$</span>
                            <input type="number" id="precio" name="precio" 
                                   placeholder="15000" step="0.01" min="0" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <label for="duracion">
                            <i class="fas fa-clock"></i> Duración (minutos)
                        </label>
                        <div class="input-icon">
                            <input type="number" id="duracion" name="duracion" 
                                   placeholder="30" min="5" required>
                            <span class="input-suffix">min</span>
                        </div>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Guardar servicio
                    </button>
                    <a href="<?php echo BASE_URL; ?>servicios" class="btn btn-outline-dark">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>