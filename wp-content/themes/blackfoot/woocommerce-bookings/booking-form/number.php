<?php extract( $field ); ?>
<div class="form-field form-field-wide <?php echo implode( ' ', $class ); ?>">
  <label for="<?php echo $name; ?>"><span><?php echo $label; ?></span></label>
  <input
    type="number"
    class="form-control"
    value="<?php echo ( ! empty( $min ) ) ? $min : 0; ?>"
    step="<?php echo ( isset( $step ) ) ? $step : ''; ?>"
    min="<?php echo ( isset( $min ) ) ? $min : ''; ?>"
    max="<?php echo ( isset( $max ) ) ? $max : ''; ?>"
    name="<?php echo $name; ?>"
    id="<?php echo $name; ?>"
    /> <?php echo ( ! empty( $after ) ) ? $after : ''; ?>
</div>
