<div class="sidebar-filter">

  <div class="filter">
    <h3>Tipo</h3>
    <div class="box">
      <select name="formato" onchange="location = this.value;" id="select-tipo">
        <option value="#">Seleccionar tipo</option>
      <?php $formato = get_terms( array( 'taxonomy'   => 'product_cat',
              'hide_empty' => true, ) ); if ( ! empty( $formato ) && is_array( $formato ) ) { foreach ( $formato as $term ) { ?>
              <option value="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></option>
      <?php } } ?>
      </select>
    </div>
  </div>

  <div class="filter">
    <h3>Género</h3>
    <div class="box">
      <select name="genero" onchange="location = this.value;" id="select-tipo">
      <option value="#">Seleccionar género</option>
      <?php $genero = get_terms( array( 'taxonomy'   => 'genero',
              'hide_empty' => true, ) ); if ( ! empty( $genero ) && is_array( $genero ) ) { foreach ( $genero as $term ) { ?>
              <option value="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></option>
      <?php } } ?>
      </select>
    </div>
  </div>

  <div class="filter">
    <h3>Artista</h3>
    <div class="box">
      <select name="artista" onchange="location = this.value;" id="select-tipo">
      <option value="#">Seleccionar artista</option>
      <?php $artista = get_terms( array( 'taxonomy' => 'Artista', 'hide_empty' => true, ) ); if ( ! empty( $artista ) && is_array( $artista ) ) { foreach ( $artista as $term ) { ?>
              <option value="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></option>
      <?php } } ?>
      </select>
    </div>
  </div>

  <div class="filter">
    <h3>Sello</h3>
    <div class="box">
      <select name="sello" onchange="location = this.value;" id="select-tipo">
      <option value="#">Seleccionar sello</option>
      <?php $sello = get_terms( array( 'taxonomy' => 'sello',
              'hide_empty' => true, ) ); if ( ! empty( $sello ) && is_array( $sello ) ) { foreach ( $sello as $term ) { ?>
              <option value="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></option>
      <?php } } ?>
      </select>
    </div>
  </div>

  <div class="filter">
    <h3>Condición</h3>
    <div class="box">
      <select name="condicion" onchange="location = this.value;" id="select-tipo">
      <option value="#">Seleccionar condición</option>
      <?php $condicion = get_terms( array( 'taxonomy'   => 'condicion',
              'hide_empty' => true, ) ); if ( ! empty( $condicion ) && is_array( $condicion ) ) { foreach ( $condicion as $term ) { ?>
              <option value="<?php echo esc_url( get_term_link( $term ) ) ?>"><?php echo $term->name; ?></option>
      <?php } } ?>
      </select>
    </div>
  </div>


</div>