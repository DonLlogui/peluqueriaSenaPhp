<section class="page-hero small">
    <div class="hero-overlay"></div>
    <div class="container">
        <span class="section-tag">RESERVA TU CITA</span>
        <h1>Agendar <span class="text-accent">cita</span></h1>
        <p>Completa el formulario para reservar tu espacio</p>
    </div>
</section>

<section class="section">
    <div class="container">
        <div class="form-container">
            <div class="form-header">
                <div class="form-icon">
                    <i class="fas fa-calendar-check"></i>
                </div>
                <h2>Información de la cita</h2>
                <p>Selecciona el servicio, barbero y horario preferido</p>
            </div>
            
            <?php if (isset($error)): ?>
                <div class="alert-error">
                    <i class="fas fa-exclamation-circle"></i>
                    <?php echo $error; ?>
                </div>
            <?php endif; ?>
            
            <form method="POST" action="<?php echo BASE_URL; ?>citas/crear" class="form-moderno" id="formCita">
                <div class="form-row">
                    <div class="form-group">
                        <label for="servicio_id">
                            <i class="fas fa-cut"></i> Servicio
                        </label>
                        <select id="servicio_id" name="servicio_id" required>
                            <option value="">Selecciona un servicio</option>
                            <?php foreach ($servicios as $servicio): ?>
                                <option value="<?php echo $servicio['id']; ?>" 
                                    <?php echo ($servicio_seleccionado == $servicio['id']) ? 'selected' : ''; ?>>
                                    <?php echo htmlspecialchars($servicio['nombre']); ?> - 
                                    $<?php echo number_format($servicio['precio'], 0, ',', '.'); ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="barbero_id">
                            <i class="fas fa-user-tie"></i> Barbero / Estilista
                        </label>
                        <select id="barbero_id" name="barbero_id" required>
                            <option value="">Selecciona un profesional</option>
                            <?php foreach ($barberos as $barbero): ?>
                                <option value="<?php echo $barbero['id']; ?>">
                                    <?php echo htmlspecialchars($barbero['nombre']); ?>
                                    <?php if (!empty($barbero['especialidad'])): ?>
                                        - <?php echo htmlspecialchars($barbero['especialidad']); ?>
                                    <?php endif; ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-row double">
                    <div class="form-group">
                        <label for="fecha">
                            <i class="fas fa-calendar-day"></i> Fecha
                        </label>
                        <input type="date" id="fecha" name="fecha" required min="<?php echo date('Y-m-d'); ?>">
                    </div>
                    
                    <div class="form-group">
                        <label for="hora">
                            <i class="fas fa-clock"></i> Hora
                        </label>
                        <select id="hora" name="hora" required>
                            <option value="">Selecciona hora</option>
                            <?php for ($h = 9; $h <= 19; $h++): ?>
                                <option value="<?php echo sprintf('%02d:00', $h); ?>">
                                    <?php echo sprintf('%02d:00', $h); ?>
                                </option>
                                <?php if ($h < 19): ?>
                                <option value="<?php echo sprintf('%02d:30', $h); ?>">
                                    <?php echo sprintf('%02d:30', $h); ?>
                                </option>
                                <?php endif; ?>
                            <?php endfor; ?>
                        </select>
                    </div>
                </div>
                
                <div class="form-row">
                    <div class="form-group">
                        <label for="observaciones">
                            <i class="fas fa-comment"></i> Observaciones (opcional)
                        </label>
                        <textarea id="observaciones" name="observaciones" 
                                  placeholder="Alguna preferencia o indicación especial..." 
                                  rows="3"></textarea>
                    </div>
                </div>
                
                <div class="form-actions">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-calendar-check"></i> Confirmar cita
                    </button>
                    <a href="<?php echo BASE_URL; ?>citas" class="btn btn-outline-dark">
                        <i class="fas fa-arrow-left"></i> Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</section>