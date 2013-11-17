<?php $dataForm['menu'] = "<table id='homeProfile'>";
							$seccion = $this->home_model->obtenerSecciones();
							foreach ($seccion as $arr1=>$sec) {
								$dataForm['menu'].= "	<tr><td colspan='5'>&nbsp;</td></tr>
														<tr><th colspan='5'>".$sec->nombre."</th></tr>
														<tr><td colspan='5'>&nbsp;</td></tr>";	
								$modulo = $this->home_model->obtenerSecciones(2, $sec->id);
								$i = 0;
								foreach ($modulo as $arr1=>$mod) {
									$i+=1;
									if($i == 1){
										$dataForm['menu'].= "<tr>";
									}
									$dataForm['menu'].= "<td width='20%' align='center'>".
															anchor($mod->vinculo, img( array('src' => 
															'multimedia/images/'.$mod->imagen, 
															'width' => '48', 'height' => '48', 'border' => '0')), 
															array('title' => $mod->nombre))."<br>".$mod->nombre."</td>";									
									if($i == 5){
										$dataForm['menu'].= "</tr>";
										$i=0;
									}
								}
							}
							echo $dataForm['menu'].= "<tr><td colspan='5'>&nbsp;</td></tr></table>";
							?>
							