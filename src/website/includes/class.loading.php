<?php

class Loading {
	public function addCss($images){
		echo '<style>
				.no-js #loader { display: none;  }
				.js #loader { display: block; position: absolute; left: 100px; top: 0; }
				.se-pre-con {
					position: fixed;
					left: 0px;
					top: 0px;
					width: 100%;
					height: 100%;
					z-index: 9999;
					background: url('.$images.') center no-repeat #fff;
				}
			</style>';
	}
	public function addBody(){
		echo '<div class="se-pre-con"></div>';
	}

	public function addJS($delay){
		echo '<script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.js"></script>
	<script type="text/Javascript">
		$(document).ready(function() {
			window.setTimeout("fadeMyDiv();", '.$delay.'); //call fade in 2 seconds
		})

		function fadeMyDiv() {
			$(".se-pre-con").fadeOut("slow");;
		}
	</script>';	
	}
}

?>