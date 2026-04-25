  <!-- ═══════════════════════ COBERTURA ═══════════════════════ -->
  <section class="coverage section-pad" id="cobertura">
    <div class="container">
      <div class="coverage-inner">
        <div class="coverage-form">
          <h2>Verifica si tenemos cobertura en tu zona</h2>
          <p>Queremos asegurarnos de que disfrutes de la mejor conexión por fibra óptica. Ingresa tu dirección y
            descubre si tenemos cobertura disponible en tu área.</p>
          <label class="coverage-input-label" for="coverage-addr">Escribe tu dirección aquí</label>
          <div class="coverage-input-group">
            <?php include 'components/search_input.html'; ?>
            <button type="button" class="btn btn-primary" id="coverage-check">Verificar cobertura</button>
          </div>
          <div class="coverage-map-wrap">
            <div id="coverage-map"></div>
          </div>
        </div>

        <div class="coverage-visual">
          <div class="placeholder">
            <iconify-icon icon="uis:rocket" style="margin-bottom:12px" width="48" height="48"></iconify-icon>
            <div>Cobertura que llega<br>hasta tu puerta</div>
          </div>
        </div>
      </div>
    </div>
  </section>
