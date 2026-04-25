  <!-- ═══════════════════════ CONTACTO ═══════════════════════ -->
  <section class="contact section-pad" id="contacto">
    <div class="container">
      <div class="contact-inner">

        <div class="contact-visual">
          <div class="contact-visual-content">
            <div class="contact-visual-brand">
              <div class="logo-big">cidata</div>
              <div class="tagline">internet por <em>Fibra Óptica</em></div>
            </div>

            <div class="contact-info-list">
              <a href="https://wa.me/" class="contact-info-item contact-info-item--wa" target="_blank" rel="noopener">
                <span class="contact-info-icon"><iconify-icon icon="uis:comment-dots" width="18" height="18"></iconify-icon></span>
                <div>
                  <span class="contact-info-label">WhatsApp</span>
                  <span class="contact-info-value">Atención inmediata</span>
                </div>
              </a>
              <a href="tel:" class="contact-info-item">
                <span class="contact-info-icon"><iconify-icon icon="uis:record-audio" width="18" height="18"></iconify-icon></span>
                <div>
                  <span class="contact-info-label">Teléfono</span>
                  <span class="contact-info-value">Llámanos directamente</span>
                </div>
              </a>
              <div class="contact-info-item">
                <span class="contact-info-icon"><iconify-icon icon="uis:clock" width="18" height="18"></iconify-icon></span>
                <div>
                  <span class="contact-info-label">Horario de atención</span>
                  <span class="contact-info-value">Lun–Vie 8:00–18:00 / Sáb 9:00–13:00</span>
                </div>
              </div>
              <div class="contact-info-item">
                <span class="contact-info-icon"><iconify-icon icon="uis:direction" width="18" height="18"></iconify-icon></span>
                <div>
                  <span class="contact-info-label">Cobertura</span>
                  <span class="contact-info-value">Consulta disponibilidad en tu zona</span>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="contact-form-wrap">
          <span class="contact-badge"><iconify-icon icon="uis:rocket" width="12" height="12"></iconify-icon> Contacto</span>
          <h2>Hablemos de tu conexión</h2>
          <p class="contact-intro">¿Tienes dudas sobre planes, cobertura o soporte técnico? Completá el formulario y te respondemos a la brevedad.</p>

          <?php if ($status === 'ok'): ?>
            <div class="flash success">
              <iconify-icon icon="uis:check-circle" style="flex-shrink:0" width="16" height="16"></iconify-icon>
              <span><strong>¡Listo!</strong> Recibimos tu solicitud. Te contactamos muy pronto.</span>
            </div>
          <?php elseif ($status === 'error'): ?>
            <div class="flash error">
              <iconify-icon icon="uis:exclamation-circle" style="flex-shrink:0" width="16" height="16"></iconify-icon>
              <span>Hubo un problema al enviar. Intenta de nuevo o escríbenos por WhatsApp.</span>
            </div>
          <?php endif; ?>

          <form action="send-mail.php" method="post" novalidate>
            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="nombre">Nombre <span class="form-required">*</span></label>
                <input class="form-input" type="text" id="nombre" name="nombre" required maxlength="80" placeholder="Tu nombre">
              </div>
              <div class="form-group">
                <label class="form-label" for="apellido">Apellido</label>
                <input class="form-input" type="text" id="apellido" name="apellido" maxlength="80" placeholder="Tu apellido">
              </div>
            </div>

            <div class="form-row">
              <div class="form-group">
                <label class="form-label" for="email">Email</label>
                <input class="form-input" type="email" id="email" name="email" maxlength="120" placeholder="correo@ejemplo.com">
              </div>
              <div class="form-group">
                <label class="form-label" for="telefono">Teléfono <span class="form-required">*</span></label>
                <input class="form-input" type="tel" id="telefono" name="telefono" required maxlength="20" placeholder="+54 381 000-0000">
              </div>
            </div>

            <div class="form-group">
              <label class="form-label" for="direccion">Dirección <span class="form-required">*</span></label>
              <input class="form-input" type="text" id="direccion" name="direccion" required maxlength="200" placeholder="Calle, sector, ciudad">
            </div>

            <div class="form-group">
              <label class="form-label" for="mensaje">Mensaje</label>
              <textarea class="form-textarea" id="mensaje" name="mensaje" maxlength="1000" placeholder="¿En qué podemos ayudarte?"></textarea>
            </div>

            <div class="contact-form-actions">
              <button type="submit" class="btn btn-primary btn-lg contact-submit">
                <iconify-icon icon="uis:rocket" width="16" height="16"></iconify-icon>
                Enviar consulta
              </button>
              <a href="https://wa.me/" class="btn btn-whatsapp btn-lg" target="_blank" rel="noopener">
                <iconify-icon icon="uis:comment-dots" width="16" height="16"></iconify-icon>
                WhatsApp
              </a>
            </div>
          </form>
        </div>

      </div>
    </div>
  </section>
