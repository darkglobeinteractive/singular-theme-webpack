<?php 
$gi_company_info = [
  ...( get_field( 'company_info_name', 'option' ) ? ['name' => get_field( 'company_info_name', 'option' )] : [] ),
  ...( get_field( 'company_info_address_1', 'option' ) ? ['address1' => get_field( 'company_info_address_1', 'option' )] : [] ),
  ...( get_field( 'company_info_address_2', 'option' ) ? ['address2' => get_field( 'company_info_address_2', 'option' )] : [] ),
  ...( get_field( 'company_info_city', 'option' ) ? ['city' => get_field( 'company_info_city', 'option' )] : [] ),
  ...( get_field( 'company_info_state', 'option' ) ? ['state' => get_field( 'company_info_state', 'option' )] : [] ),
  ...( get_field( 'company_info_zip', 'option' ) ? ['zip' => get_field( 'company_info_zip', 'option' )] : [] ),
  ...( get_field( 'company_info_phone', 'option' ) ? ['phone' => get_field( 'company_info_phone', 'option' )] : [] ),
  ...( get_field( 'company_info_email', 'option' ) ? ['email' => get_field( 'company_info_email', 'option' )] : [] )
];
?>
<?php if ( count( $gi_company_info ) > 0 ): ?>
  <div class="vcard">
    <?php if ( array_key_exists( 'name', $gi_company_info ) ): ?>
      <div class="org"><?php echo $gi_company_info['name']; ?></div>
    <?php endif; ?>
    <?php if ( array_key_exists( 'address1', $gi_company_info ) && array_key_exists( 'city', $gi_company_info ) && array_key_exists( 'state', $gi_company_info ) && array_key_exists( 'zip', $gi_company_info ) ): ?>
      <div class="adr">
        <div class="street-address"><?php echo $gi_company_info['address1']; ?></div>
        <?php if ( array_key_exists( 'address2', $gi_company_info ) ): ?>
          <div class="street-address-2"><?php echo $gi_company_info['address2']; ?></div>
        <?php endif; ?>
        <span class="locality"><?php echo $gi_company_info['city']; ?></span>, <span class="region"><?php echo $gi_company_info['state']; ?></span> <span class="postal-code"><?php echo $gi_company_info['zip']; ?></span>
      </div>
    <?php endif; ?>
    <?php if ( array_key_exists( 'phone', $gi_company_info ) ): ?>
      <div class="tel"><a href="tel:<?php echo $gi_company_info['phone']; ?>"><?php echo $gi_company_info['phone']; ?></a></div>
    <?php endif; ?>
    <?php if ( array_key_exists( 'email', $gi_company_info ) ): ?>
      <div class="email"><a href="mailto:<?php echo $gi_company_info['email']; ?>"><?php echo $gi_company_info['email']; ?></a></div>
    <?php endif; ?>
  </div>
<?php endif; ?>