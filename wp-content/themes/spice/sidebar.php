<aside class="sidebar col-md-3">
  <?php
  if ( class_exists( 'woocommerce' ) ) 
  {
      if (is_shop() || is_singular('product') || is_product_category())
      {
        if (is_active_sidebar('woocom-sidebar'))
        {
           dynamic_sidebar('woocom-sidebar');
        }
        
      }
  }
  
  if (is_active_sidebar('sidebar-1'))
  {
       dynamic_sidebar('sidebar-1');
  } 
  if (is_active_sidebar('without-title'))
  {
       dynamic_sidebar('without-title');
  } 
  

 ?>

</aside>