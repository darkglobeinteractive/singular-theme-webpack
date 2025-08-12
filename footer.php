      </div>
    </div>
    <footer id="footer">
      <div class="wrap">
        <?php include( locate_template( 'templates/vcard.php', false, false ) ); ?>
        <div class="copyright">&copy; <?php echo date('Y'); ?> <?php bloginfo(); ?>, All Rights Reserved.</div>
        <?php include( locate_template( 'templates/social-media.php', false, false ) ); ?>
      </div>
    </footer>
  </div>
<?php wp_footer(); ?>
<?php include( locate_template( 'inc/analytics-body-bottom.php', false, false ) ); ?>
</body>
</html>
