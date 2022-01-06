

<!--<div class="no-print" style="width:100%;
	height:50px;
	background-color:#A81717;
	text-align:center;
	vertical-align:center;
	padding-top:15px;
	color:white;"> Copyright © <?php //echo date("Y") ?> Human Resource </div>-->
    
<a href="#" id="back-to-top" title="Back to top" class="no-print"><span style="color:white" class="no-print">&uarr;</span></a>
<a href="#" id="back-to-bottom" title="Back to bottom" class="no-print"><span style="color:white" class="no-print">&darr;</span></a>
	<script>
    
	if ($('#back-to-top').length) {
    var scrollTrigger = 100, // px
        backToTop = function () {
            var scrollTop = $(window).scrollTop();
            if (scrollTop > scrollTrigger) {
                $('#back-to-top').addClass('show');
				$('#back-to-bottom').addClass('show');
            } else {
                $('#back-to-top').removeClass('show');
				$('#back-to-bottom').removeClass('show');
            }
        };
    backToTop();
    $(window).on('scroll', function () {
        backToTop();
    });
    $('#back-to-top').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: 0 //$(document).height() for bottom
        }, 700);
    });
	$('#back-to-bottom').on('click', function (e) {
        e.preventDefault();
        $('html,body').animate({
            scrollTop: $(document).height()
        }, 700);
    });
}
    
    </script>
    <script>
        var theToggle = document.getElementById('toggle');

// based on Todd Motto functions
// https://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
  return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
      elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
  var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
  if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
  var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0 ) {
            newClass = newClass.replace( " " + className + " " , " " );
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

theToggle.onclick = function() {
   toggleClass(this, 'on');
   return false;
}
     if (window.matchMedia('(max-width: 768px)').matches) 
    {
           $(".sidebar-offcanvas").addClass("collapse-left");
           
            
           
           
    }
    
    </script>
<!--<link href="selectLiberary/dist/css/select2.min.css" rel="stylesheet" />
<script src="selectLiberary/dist/js/select2.min.js"></script>
<script type="text/javascript">
  $('select').select2();
</script>-->