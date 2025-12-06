

<?php
$placeholder = ($_GET["s"]) ? get_search_query() : "search worbot's blog";
?>
<!--
<form role="search" method="get" id="searchform" class="row justify-content-center" 
  action="<?php echo home_url( '/' ); ?>">
    <div class="col-auto">
      <div class="input-group input-group-lg">
        <span class="input-group-text" id="inputGroup-sizing-lg">
          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
            <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
          </svg>
        </span>
        <input class="form-control" value="" name="s" id="s" type="text" aria-describedby="inputGroup-sizing-lg" placeholder="<?php echo $placeholder; ?>">
        <input id="searchsubmit" value="Search" type="submit" class="btn btn-wb-blue">
      </div>   
    </div>
</form>
-->

<script>
  function submitForm() {
    jQuery("#search-glass").css("display", "none");
    jQuery("#search-gif").css("display", "");
    jQuery("#searchform").submit();
  }
</script>

<form role="search" method="get" id="searchform" class="row justify-content-center" action="<?php echo home_url( '/' ); ?>">
    <div class="col-auto">
      <div class="input-group">
        <input style='border-radius:20px;border:0px;width:250px;' class="form-control" value="" name="s" id="s" type="text" aria-describedby="inputGroup-sizing" placeholder="<?php echo $placeholder; ?>">
        <i id="search-glass" onClick="submitForm();" class="fa-solid fa-magnifying-glass fa-lg" style='cursor:pointer;position:relative;top:18px;left:-35px;z-index:99;'"></i>
        <img id="search-gif" src="<?php echo get_theme_file_uri('/images/loading.gif'); ?>" alt="loading search results" style="display:none;position:relative;left:-35px;top:5px;width:25px;height:25px;" />
      </div>   
    </div>
</form>

