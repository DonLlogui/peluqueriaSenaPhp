<section class="page-hero">
    <div class="hero-overlay"></div>
    <div class="container">
        <span class="section-tag">MIS CITAS</span>
        <h1>Gestión de <span class="text-accent">Citas</span></h1>
        <p>Administra tus reservas y consulta tu historial</p>
    </div>
</section>

<?php if (isset($_GET['exito'])): ?>
<div class="alert-success">
    <div class="container">
        <i class="fas fa-check-circle"></i>
        <span>¡Cita agendada exitosamente!</span>
    </div>
</div>
<?php endif; ?>

<section class="section">
    <div class="container">
        <div class="citas-header">
            <h2>
                <?php echo $es_admin ? 'Todas las citas' : 'Mis citas'; ?>
            </h2>
            <a href="<?php echo BASE_URL; ?>citas/crear" class="btn btn-primary">
                <i class="fas fa-plus"></i> Nueva cita
            </a>
        </div>

        <?php if (count($citas) > 0): ?>
            <div class="citas-grid">
                <?php foreach ($citas as $cita): ?>
                    <div class="cita-card estado-<?php echo $cita['estado']; ?>">
                        <div class="cita-status">
                            <span class="status-badge badge-<?php echo $cita['estado']; ?>">
                                <?php echo ucfirst($cita['estado']); ?>
                            </span>
                        </div>
                        
                        <div class="cita-body">
                            <div class="cita-servicio">
                                <i class="fas fa-cut"></i>
                                <div>
                                    <h3><?php echo htmlspecialchars($cita['servicio_nombre']); ?></h3>
                                    <p class="cita-precio">$<?php echo number_format($cita['servicio_precio'], 0, ',', '.'); ?></p>
                                </div>
                            </div>
                            
                            <div class="cita-info">
                                <div class="info-item">
                                    <i class="fas fa-user"></i>
                                    <span><?php echo htmlspecialchars($cita['barbero_nombre']); ?></span>
                                </div>
                                <?php if ($es_admin): ?>
                                <div class="info-item">
                                    <i class="fas fa-user-circle"></i>
                                    <span><?php echo htmlspecialchars($cita['usuario_nombre']); ?></span>
                                </div>
                                <?php endif; ?>
                                <div class="info-item">
                                    <i class="fas fa-calendar"></i>
                                    <span><?php echo date('d/m/Y', strtotime($cita['fecha'])); ?></span>
                                </div>
                                <div class="info-item">
                                    <i class="fas fa-clock"></i>
                                    <span><?php echo substr($cita['hora'], 0, 5); ?></span>
                                </div>
                            </div>
                        </div>
                        
                        <?php if ($es_admin && $cita['estado'] === 'pendiente'): ?>
                        <div class="cita-actions">
                            <form method="POST" action="<?php echo BASE_URL; ?>citas/actualizar-estado" style="display:inline;">
                                <input type="hidden" name="cita_id" value="<?php echo $cita['id']; ?>">
                                <input type="hidden" name="estado" value="confirmada">
                                <button type="submit" class="btn-action confirmar">
                                    <i class="fas fa-check"></i> Confirmar
                                </button>
                            </form>
                            <form method="POST" action="<?php echo BASE_URL; ?>citas/actualizar-estado" style="display:inline;">
                                <input type="hidden" name="cita_id" value="<?php echo $cita['id']; ?>">
                                <input type="hidden" name="estado" value="cancelada">
                                <button type="submit" class="btn-action cancelar">
                                    <i class="fas fa-times"></i> Cancelar
                                </button>
                            </form>
                        </div>
                        <?php endif; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        <?php else: ?>
            <div class="empty-state-citas">
                <i class="fas fa-calendar-alt"></i>
                <h3>No tienes citas agendadas</h3>
                <p>Reserva tu primera cita y disfruta de nuestros servicios</p>
                <a href="<?php echo BASE_URL; ?>citas/crear" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Agendar cita
                </a>
            </div>
        <?php endif; ?>
    </div>
</section>