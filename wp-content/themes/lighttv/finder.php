<!-- channel finder form -->
<section class="section-finder">
  <div class="container">
    <div class="flex">
      <div class="finder-close hidden js_button-finder-close"></div>
      <h1><span>FIND</span> <img src="<?php echo site_url(); ?>/wp-content/themes/lighttv/img/LOGOS/LTV_LOGO_WHITE.png" alt="LIGHTtv"> <span>IN YOUR AREA</span></h1>
      <form name="localizeForm" id="localizeForm" class="zip-lookup" method="get" action="#">
        <input type="hidden" name="aid" value="zap2it" />
        <input type="hidden" name="stnlt" value="59987,71484,84543,55337,68615,97965" />
        <input type="hidden" name="nstnlt" value="true" />
        <label for="zip" class="screen-reader-text">ZIP Code</label>
        <input type="text" name="zip" placeholder="ZIP Code" class="zip-lookup__input">
        <div class="zip-lookup__submit">
          <img src="<?php echo site_url(); ?>/wp-content/themes/lighttv/img/White_CarrotArrow.svg" alt="Search">
        </div>
      </form>
      <div class="lookup-result">
        <div>Watch LIGHTtv on:</div>
        <div>Broadcast Channel 42.0</div>
      </div>
    </div>
  </div>
</section>
<!-- 
<input type="image" name="submit" onclick="document.localizeForm.submit();" id="zccSubmit" src="http://api.zap2it.com/channelfinder/btn_find.gif" /> -->

