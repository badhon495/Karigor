#!/bin/bash

echo "Cleaning up unnecessary files..."

# Remove example test files
rm -f tests/Feature/ExampleTest.php
rm -f tests/Unit/ExampleTest.php

# Remove Revolution Slider (entire directory)
rm -rf public/js/js_temp/revolution/

# Remove unused CSS files
rm -f public/css/css_temp/animate.min.css
rm -f public/css/css_temp/default-skin.css
rm -f public/css/css_temp/font-awesome.min.css
rm -f public/css/css_temp/icomoon.css
rm -f public/css/css_temp/jquery-ui.css
rm -f public/css/css_temp/jquery.fancybox.min.css
rm -f public/css/css_temp/jquery.mCustomScrollbar.min.css
rm -f public/css/css_temp/meanmenu.css
rm -f public/css/css_temp/normalize.css
rm -f public/css/css_temp/owl.carousel.min.css
rm -f public/css/css_temp/slick.css

# Remove unused JavaScript files
rm -f public/js/js_temp/jquery.mCustomScrollbar.concat.min.js
rm -f public/js/js_temp/jquery.validate.js
rm -f public/js/js_temp/modernizer.js
rm -f public/js/js_temp/plugin.js
rm -f public/js/js_temp/slider-setting.js

# Remove Bootstrap redundant files
rm -f public/css/css_temp/bootstrap-grid.css*
rm -f public/css/css_temp/bootstrap-reboot.css*
rm -f public/js/js_temp/bootstrap.js*
rm -f public/js/js_temp/bootstrap.min.js*
rm -f public/js/js_temp/bootstrap.bundle.js
rm -f public/js/js_temp/popper.min.js

# Remove system files
rm -f public/js/js_temp/.DS_Store
rm -f public/css/css_temp/.DS_Store

# Remove misplaced PHP file
rm -f resources/views/admin/dashboard/AuthController.php

echo "Cleanup completed!"
echo "Estimated space saved: ~8-10MB"
