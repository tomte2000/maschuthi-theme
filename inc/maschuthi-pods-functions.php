<?php
	///pods function  show gallerie with bootstap 5 modal fullscreeen
	function show_me ($id) {
		$bilder = get_post_meta($id,'bild',false);
		$output = ''; 
		if (!empty($bilder)) {
			$output .= 
			'<div class="row carousel-template">
				<!--carousel-indicators-->
				<div class="col-12 col-sm-8 col-md-6 col-lg-4 icons" >
					<div class="row pr-3">';
					foreach($bilder as $key => $bild) {
						//bootstrap 5 befehle aus dem carousel card geht zum bild klick auf bild öffnet modal
						$output .= '<div class="icon col-4 pr-0 pb-3" data-bs-target="#item' . $id . '" data-bs-slide-to="' . $key . '" >'
						. wp_get_attachment_image( $bild['ID'], 'thumb', "", array( "class" => "img-fluid" ) ) .
						'</div>';
					}
			$output .= 
					'</div>
				</div>';
			$output .= 
				'<!--carousel-inner-->
				<div class="col-12 col-lg-8 pl-lg-5">
					<div id="item' . $id . '" class="carousel slide" data-bs-ride="carousel" data-bs-interval="50000">
						<div class="carousel-inner">';
						foreach($bilder as $key=> $bild) {
							$activ = $key==0?'active':'passiv';
							$output .= '
							<div class="carousel-item ' .$activ . '" >
								<figure class="pr-3">'
									 . wp_get_attachment_image($bild["ID"],"full","", ["class" => "d-block"]) . 
								'</figure>	
								<div class="carousel-caption row">
									<div class="txt col-6">
										<h3>' . get_the_title($bild["ID"]) . '</h3>
										' . get_the_content($bild["ID"]) .'
									</div>
									<!-- Button trigger modal -->
									<div class="col-6 d-flex ml-auto" data-bs-target="#item-modal' . $id . '" data-bs-slide-to="' . $key . '" >
										<button type="button" class="btn plus ml-auto" data-bs-toggle="modal" data-bs-target="#MyModal' . $id . '"> </button>
									</div>
								</div>
							</div>';
						}
			$output .= '
					</div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#item' . $id . '" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#item' . $id . '" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
				</div>
			</div>
		</div>';

	$output .=
		'<div class="modal fade" id="MyModal'. $id .'" tabindex="-1" role="dialog" aria-labelledby="MyModal'. $id .'" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content custom-background">
					<div class="modal-header">
						<h2 class="modal-title"></h2>
						<button type="button" class="modal-close" data-dismiss="modal" aria-label="Close"></button>
					</div>
					<div class="modal-body">
						<div id="item-modal'. $id .'" class="carousel slide" data-ride="carousel" data-interval="50000">
							<div class="carousel-inner">';
							foreach($bilder as $key=> $bild) {
								$activ = $key==0?'active':'passiv';
								$output .=
								'<div class="carousel-item '. $activ .'" >
									<figure class="d-flex ml-3 mr-3">'
									. wp_get_attachment_image($bild["ID"],"full","", ["class" => "d-block"]) . 
									'</figure>	
									<div class="carousel-caption mt-4">
										<div class="txt">
											<h3>' . get_the_title($bild["ID"]) . '</h3>' 
											. get_the_content($bild["ID"]) .
										'</div>
									</div>
								</div>';
							}
							$output .=
							'</div>
							<a class="carousel-control-prev" href="#item-modal'. $id .'" role="button" data-slide="prev">
								<span class="carousel-control-prev-icon" aria-hidden="true"></span>
								<span class="sr-only">Previous</span>
							</a>
							<a class="carousel-control-next" href="#item-modal'. $id .'" role="button" data-slide="next">
								<span class="carousel-control-next-icon" aria-hidden="true"></span>
								<span class="sr-only">Next</span>
							</a>
						</div>
					</div>
				</div>
			</div>
		</div>';
		}
		//echo($output);
		return ($output);
	}