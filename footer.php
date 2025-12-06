<footer class="site-footer">
  <div style='background-color: #15202A'>  
    <br /><br /><br />
  </div>
  <div className="container" style='background-color: #1b2631;'>
    <div className="row">
      <div class="col-6 offset-3 text-white text-center p-4">
        &copy; <?php echo date("Y"); ?> Menyu LLC
        <!--
        The official blog of <br/>
        <a href='https://wordbot.io' class="footer-logo-link">
          wordbot.io
        </a>  -->
        <br/><br/><br/><br/>
        <div id="admin_url" style="display:none;"><?php echo esc_url( admin_url("admin-ajax.php") ); ?></div>
        <div id="theme_directory" style="display:none;"><?php bloginfo('template_directory'); ?></div>
      </div>
  <div>
</footer>

<?php wp_footer(); ?>
<div class='sticky-ads' id='sticky-ads'>
  <div class='sticky-ads-close' onclick='document.getElementById("sticky-ads").style.display="none"'><svg viewbox='0 0 512 512' xmlns='http://www.w3.org/2000/svg'><path d='M278.6 256l68.2-68.2c6.2-6.2 6.2-16.4 0-22.6-6.2-6.2-16.4-6.2-22.6 0L256 233.4l-68.2-68.2c-6.2-6.2-16.4-6.2-22.6 0-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3l68.2 68.2-68.2 68.2c-3.1 3.1-4.7 7.2-4.7 11.3 0 4.1 1.6 8.2 4.7 11.3 6.2 6.2 16.4 6.2 22.6 0l68.2-68.2 68.2 68.2c6.2 6.2 16.4 6.2 22.6 0 6.2-6.2 6.2-16.4 0-22.6L278.6 256z'/></svg></div>
  <div class='sticky-ads-content'>
    <ins class="adsbygoogle"
        style="display:inline-block;height:70px;width:100%;line-height:70px;"
        data-ad-client="ca-pub-4772813542518859"
        data-ad-slot="3330783450"></ins><script>
        (adsbygoogle = window.adsbygoogle || []).push({});
    </script>
  </div>
</div>
<style>
.sticky-ads{ position: fixed; bottom: 0; left: 0; width: 100%; min-height: 70px; max-height: 200px; padding: 5px 0; box-shadow: 0 -6px 18px 0 rgba(9,32,76,.1); -webkit-transition: all .1s ease-in; transition: all .1s ease-in; display: flex; align-items: center; justify-content: center; background-color: #fefefe; z-index: 20; }.sticky-ads-close { width: 30px; height: 30px; display: flex; align-items: center; justify-content: center; border-radius: 12px 0 0; position: absolute; right: 0; top: -30px; background-color: #fefefe; box-shadow: 0 -6px 18px 0 rgba(9,32,76,.08); } .sticky-ads .sticky-ads-close svg { width: 22px; height: 22px; fill: #000; } .sticky-ads .sticky-ads-content { overflow: hidden; display: block; position: relative; height: 70px; width: 100%; margin-right: 10px; margin-left: 10px;
</style>
<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-61e005657976ae4a"></script>
</body>
</html>