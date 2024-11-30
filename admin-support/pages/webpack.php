<?php include( locate_template( 'admin-support/inc/admin-support-header.php', false, false ) ); ?>
  <h1>Webpack Theme Configuration</h1>
  <p>This theme uses Webpack to compile and minify scss/css and JavaScript files.</p>

  <h2>Theme Structure</h2>
  <ul>
    <li><strong>/assets/</strong> - The minified assets used by the site -- <strong>DO NOT EDIT THESE DIRECTLY!!!</strong></li>
    <li><strong>/block-patterns/</strong> - The <em>/js/</em> and <em>/scss/</em> sub-directories of this folder are compiled into the <em>/assets/</em> directory.</li>
    <li><strong>/blocks/</strong> - The individual js and scss files throughout this directory are compiled into the <em>/assets/</em> directory.</li>
    <li><strong>/src/</strong> - The unminified, working files that are compiled into the <em>/assets/</em> directory</li>
    <li><strong>/svg/</strong> - The scss file in this directory is compiled into the <em>/assets/</em> directory</li>
  </ul>

  <h2>Development Procedure</h2>
  <h3>Step 1: Download All Theme Files To Local Environment</h3>
  <p>Using an SFTP client, download all contents of the theme folder.</p>
  <h3>Step 2: Run Install</h3>
  <p>Now that you've downloaded the theme files, you need to make your local installation functional. To do this, in your command line app, navigate to the theme directory and run the following command:</p>
  <code>npm install</code>
  <p><strong>Note:</strong> This will add a <em>/node_modules/</em> directory to your local theme. You <strong>do not</strong> need to upload this to the remote server. This directory contains the apps needed for webpack to work on your local machine.</p>
  <h3>Step 3: Do Your Work</h3>
  <p>Do any work you need to do on the site files.</p>
  <h3>Step 4: Rebuild Assets</h3>
  <p>Once you have made your changes, you need to rebuild the public assets to ensure they are up-to-date. To do this, run the following command in your command line app:</p>
  <code>npm run build-prod</code>
  <h3>Step 5: Upload All Modified Files</h3>
  <p>Upload all changed files to the remote server, including the newly rebuilt files in the <em>/assets/</em> directory, along with any changes js or scss file. The latter will be needed by other developers in order to rebuild their local instances accurately.</p>


  
<?php include( locate_template( 'admin-support/inc/admin-support-footer.php', false, false ) ); ?>