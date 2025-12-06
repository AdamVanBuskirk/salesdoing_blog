<!DOCTYPE html>
<html <?php language_attributes(); ?>>
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <?php wp_head(); ?>
    <?php $protocol = (empty($_SERVER['HTTPS']) ? 'http' : 'https'); ?>

    <script>
      function goToCat() {
        window.location.href = '<?php echo home_url("/"); ?>category/' + document.getElementById("category_dropdown").value;
      }  
      function sortPage() {
        window.location.href = "<?php echo parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); ?>?sort=" + document.getElementById("sort_dropdown").value;
      }  
    </script>

    <?php
    global $wp;
    if(strpos(home_url($wp->request),"//tag/")){ ?>
      <meta name="robots" content="noindex">
    <?php } ?>
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-1Q9E2H3ZEQ"></script>
    <script>
      window.dataLayer = window.dataLayer || [];
      function gtag(){dataLayer.push(arguments);}
      gtag('js', new Date());
      gtag('config', 'G-1Q9E2H3ZEQ');
    </script>

    <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-4772813542518859" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/e5f9d476c9.js" crossorigin="anonymous"></script>
    <script id="mcjs">!function(c,h,i,m,p){m=c.createElement(h),p=c.getElementsByTagName(h)[0],m.async=1,m.src=i,p.parentNode.insertBefore(m,p)}(document,"script","https://chimpstatic.com/mcjs-connected/js/users/86daa9f3267c9d4de034c1059/4b62b594b845cf30ddb3c6be4.js");</script>
  </head>
  <body <?php body_class(); ?>>
   
    <header class="mainBackground sticky-top">
      <nav class="navbar navbar-expand-md navbar-toggleable-md">
        <div class="container ms-15 me-15 ps-15 pe-15 mt-2 mb-2">
          <!--
          <a class="navbar-brand" href="/">
            <span style='color: #fff; font-size: 24pt;'>word</span><span style='color: #fff; font-weight: bold; font-size: 24pt;'>Bot</span>
            <span style='padding-left: 5px;color: #3498DB; font-weight: bold; font-size: 24pt;'>BLOG</span>
          </a>
          -->
          <?php get_search_form(); ?>

          <button class=" navbar-toggler custom-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarItems" aria-controls="navbarItems" 
            aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          
          <div class="collapse navbar-collapse d-md-inline-flex flex-md-row-reverse" id="navbarItems">
            <ul class="navbar-nav flex-grow">
            <li class="nav-item mt-2 mb-2 me-3">
                <a href="/" style='text-decoration:none;'>
                  <span class="text-white pe-4">Home</span>
                </a>
              </li>
              <!--
              <li class="nav-item mt-2 mb-2 me-3">
                <a href="https://wordbot.io" style='text-decoration:none;'>
                  <span class="text-white pe-4">Wordbot.io</span>
                </a>
              </li>
              <li class="nav-item mt-2 mb-2 me-3">
                <a href="https://wordbot.io/ai" style='text-decoration:none;'>
                  <span class="text-white pe-4">AI</span>
                </a>
              </li>
              <li class="nav-item mt-2 mb-2 me-3">
                  <a href="https://wordbot.io/login" style='text-decoration:none;'>
                    <span class="text-white pe-4">Login</span>
                  </a>
              </li>
              <li id="signup-button" class="nav-item mt-2 mb-2">
                <a href="https://wordbot.io/register/seo" class="mt-3 mt-md-0 mb-3 mb-md-0" style='text-decoration:none;'>
                  <span class="btn-free-trial">Sign Up</span>
                </a>
              </li>
              -->
            </ul>
          </div>
        </div>
      </nav>
    </header>
    <!--
    <div class="mt-4 text-center">
      <?php //get_search_form(); ?>
    </div>
    -->
  <div class="row justify-content-center category_tile_row">
    <div style='margin-top:30px;'>
      <div class="form-inline;">
        <?php if ( is_category() ) : 
          $cats = get_the_category();
          $cat_name = $cats[0]->name;
          ?>
          <h1 style='display:inline-block;font-weight:700;font-size: 2rem;'>
            <?php echo $cat_name; ?>
          </h1>
        <?php endif; ?>
        <select id="category_dropdown" class="form-control" onChange="goToCat()">
          <option value='0'>-- jump to category --</option>
            <?php
            $cat_args = array(
              'orderby' => 'name',
              'order' => 'ASC'
             );
            $categories = get_categories( $cat_args );
            foreach( $categories as $category ) {
              echo "<option value='" . $category->slug . "'>" . $category->name . "</option>";
            }
            ?>
        </select>
        <?php
        $sort = get_query_var('sort');
        if ("votes" == $sort) {
          $sVotes = "selected='selected'";
        } else if ("date" == $sort) {
          $sDate = "selected='selected'";
        } else {
          $sDefault = "selected='selected'";
        }
        ?>
        <select id="sort_dropdown" class="form-control" onChange="sortPage()">
          <option value='' <?php echo $sDefault; ?>>-- sort by --</option>
          <option value='date' <?php echo $sDate; ?>>Newest</option>
          <option value='votes' <?php echo $sVotes; ?>>Up Votes</option>
        </select>
      </div>  
    </div>
  </div>