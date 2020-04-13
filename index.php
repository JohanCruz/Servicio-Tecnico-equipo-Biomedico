<?php include ("db.php") ?>
<?php include ("includes/header.php") ?>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<meta name="viewport" content="initial-scale=1, maximum-scale=1">

<script src="signature.js"></script>
<script src="includes/equipos.js"></script>
<style type="text/css">

	#global {
		height: 300px;
		width: auto;
		border: 1px solid #ddd;
		background: #f1f1f1;
		overflow-y: scroll;
	}
	#mensajes {
		height: auto;
	}
	.texto {
		padding:4px;
		background:#fff;

}
</style>

	<div class="container p-12">
		<div class="row">
			<div class="col-md-12">
				<?php if (isset($_SESSION["message"])) { ?>
					
					<div class="alert alert-<?= $_SESSION["message_type"] ?> alert-dismissible fade show" role="alert">
					   <?= $_SESSION["message"] ?>
					  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
					    <span aria-hidden="true">&times;</span>
					  </button>
					</div>

				<?php session_unset(); } ?>							

					<?php 
					$query= "SELECT * FROM task";
					$result = mysqli_query($conn, $query);
					?>

				<form autocomplete="off">
					<div class="row">
						<div class="col-sm">
						<div class="card card-body">
							<br style="display: block; margin: -10px 0;">
							
							<div class="p-0 mb-2 bg-primary text-white text-center rounded" style="margin-top: -17px;">CERTIFICADO DE EQUIPO BIOMÉDICO</div>

							<div class="form-group">
								
								<br style="display: block; margin: -3px 0;">
								<input type="text" class="form-control" name="title" id="title" list="ti" placeholder="Entidad" autofocus style="background-color: #b0dfe5; border-color:#ffffff" hidden>
								<input type="text" class="form-control" name="entidad" id="entidad" list="ti" placeholder="Entidad" autofocus style="background-color: #b0dfe5; border-color:#ffffff" onkeyup="showUser(this.value)" onchange="showUser(this.value)" onclick="showUser(this.value)" oninput="showUser(this.value)">

								<datalist id="ti">					  						
								  <?php
								  if (is_array($result) || is_object($result))
								  { 
								  	foreach ($result as $r): ?>
								  <option value="<?php echo $r['entidad']?>"> <?php echo $r['entidad'] ?> </option>
								  <?php endforeach;
								  } 
								  ?>						  
								</datalist>
							
								<br style="display: block; margin: 1px 0;">

								<input type="number" class="form-control" name="nit" id="nit"  placeholder="N.I.T" style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: 1px 0;">

								<input type="text" name="description"  class="form-control" placeholder="Dirección" style="background-color: #b0dfe5; border-color:#ffffff" hidden>
								
								<input type="text" name="direccion" id="direccion"  class="form-control" placeholder="Dirección" style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: 1px 0;">

								<input type="number" name="telefono" id="telefono"  class="form-control" placeholder="Teléfono" style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: 1px 0;">
							
								<input type="text" name="servicio" id="servicio"  class="form-control" placeholder="Servicio" style="background-color: #b0dfe5; border-color:#ffffff">
								<br style="display: block; margin: 1px 0;">

								<input type="text" name="encargado" id="encargado"  class="form-control" placeholder="Encargado" style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: -16px 0;">
							</div>
							
						</div>
						</div>

						<div class="col-sm">
						<div class="card card-body">

							<div style="margin-top: -17px;" class="p-0 mb-2 bg-primary text-primary rounded">.</div>

							<div class="form-group">
								<br style="display: block; margin: -3px 0;">
								<input type="date" name="fecha" class="form-control" placeholder="Fecha" style="background-color: #b0dfe5; border-color:#ffffff">								
							
								<br style="display: block; margin: 1px 0;">

								<div id="equipos"><input name="equipo" id="equipo" class="form-control" placeholder="Equipo" style="background-color: #b0dfe5; border-color:#ffffff">
								</div>
								<br style="display: block; margin: 1px 0;">

								<input name="marca" id="marca"  class="form-control" placeholder="Marca" style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: 1px 0;">

								<input name="modelo" id="modelo"  class="form-control" placeholder="Modelo" style="background-color: #b0dfe5; border-color:#ffffff">
								
								<br style="display: block; margin: 1px 0;">

								<input name="serie" id="serie"  class="form-control" placeholder="Serie" style="background-color: #b0dfe5;  border-color:#ffffff">
								
								<br style="display: block; margin: 1px 0;">

								<input type="text" name="placa" id="placa"  class="form-control" placeholder="Placa Inv." style="background-color: #b0dfe5; border-color:#ffffff">

								<br style="display: block; margin: -16px 0;">

							</div>
							
						</div>
						</div>
					</div>


					<div class="card card-body" style="margin-top: -12px;">
						<br style="display: block; margin-top: -12px;">
						<div class="form-group">
						<br style="display: block; margin: -13px 0;">
						<div class="p-0 mb-2 bg-primary text-white text-center rounded">FALLA REPORTADA</div>

						<style type="text/css">
							textarea {
							    resize: none;
							    overflow: hidden;						    
							}
						</style>
						
						<script type="text/javascript">
						function auto_grow(element) {
						    element.style.height = "5px";
						    element.style.height = (element.scrollHeight)+"px";
						}
						</script>

						<br style="display: block; margin: -5px 0;">

						<textarea class="form-control" rows="1.5" name="falla" id="falla" placeholder="Falla" onchange="auto_grow(this)" onkeyup="auto_grow(this)" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;"></textarea>
						<div class="p-0 mb-2 bg-primary text-white text-center rounded">TRABAJO REALIZADO</div>

						<br style="display: block; margin: -3px 0;">

						<div class="d-flex table-responsive">

						 <label class="p-2 flex-fill rounded" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;">Preventivo <input type="checkbox" name="preventivo" id="preventivo" value="1"></label>
						<label class="p-2 flex-fill">Correctivo <input type="checkbox" name="correctivo" id="correctivo" value="1"></label>
						<label class="p-2 flex-fill rounded" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;">Intalación <input type="checkbox" name="instalacion" id="instalacion"></label>
						<label class="p-2 flex-fill">Diagnóstico <input type="checkbox" name="diagnostico" id="diagnostico"></label>
						<label class="p-2 flex-fill rounded" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;">Calibración <input type="checkbox" name="calibracion" id="calibracion"></label>
						<label class="p-2 flex-fill">Entrenamiento <input type="checkbox" name="entrenamiento" id="entrenamiento"></label>
						<label class="p-2 flex-fill rounded" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;">Verificación <input type="checkbox" name="verificacion" id="verificacion"></label>

						</div>

						<style type="text/css">
											
							
							
						</style>

					</div>

					
						

					<div class="" style="margin-top: -15px;">
						   <strong style="margin-top: -15px;" >PUNTOS DE INSPECCIÓN</strong>

							<div id="global">
							  	<div id="mensajes">
								  	<div class="table-responsive">
										<table class="table">								
											
											<tbody>	
													<tr>
														<td>Prueba de Funcionamiento Inicial</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_1_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_1_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_1_c"> No Aplica
														</td>
													</tr>
													<tr class="table-info rounded">
														<td>Estado Físico</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_2_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_2_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_2_c"> No Aplica
														</td>
													</tr>
													<tr>
														<td>Estado de Accesorios</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_3_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_3_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_3_c"> No Aplica
														</td>
													</tr>
													<tr class="table-info">
														<td>Estado de Alarmas</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_4_a"> Aprobó 
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_4_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_4_c"> No Aplica
														</td>
													</tr>
													<tr>
														<td>Estado contactos y conexiones eléctricas</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_5_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_5_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_5_c"> No Aplica
														</td>
													</tr>
													<tr class="table-info">
														<td>Ajuste y Limpieza del Sistema</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_6_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_6_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_6_c"> No Aplica
														</td>
													</tr>
													<tr>
														<td>Estado Baterias</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_7_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_7_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_7_c"> No Aplica
														</td>
													</tr>
													<tr class="table-info">
														<td>Estado Sistema Mecánico</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_8_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_8_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_8_c"> No Aplica
														</td>
													</tr>
													<tr>
														<td>Estado Sistema Hidráulico y Neumático</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_9_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_9_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_9_c"> No Aplica
														</td>
													</tr>
													<tr class="table-info">
														<td>Estado Sistema Óptico</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_10_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_10_b"> No Aprobó
														</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_10_c"> No Aplica
														</td>
													</tr>
													<tr>
														<td>Prueba de Funcionamiento Final</td>
														<td style="text-align: center;" >  
															<input type="checkbox" id="p_11_a"> Aprobó
														</td>
														<td style="text-align: center;" > 
															<input type="checkbox" id="p_11_b"> No Aprobó
														</td>
														<td style="text-align: center;" > 
															<input class="centered" type="checkbox" id="p_11_c"> No Aplica
														</td>
													</tr>								

												
											</tbody>
										</table>
								   
								  	</div>
								</div>
							</div>

                          <br style="display: block; margin: -10px 0;">
						</div>						
					</div>

					<div class="table-responsive centered">


						<div class="row">
							<div class="col-sm-4"></div>
						
							<label class="col-sm-4 centered" style="text-align: center;">Variables</label>
						</div>

						<br style="display: block; margin: -8px 0;">
						

						<table>
							<tr>
								<td colspan="2">
									<input class="form-control" type="Text" id="v1" placeholder="V. 1" >
								</td>
								<td colspan="2">
									<input class="form-control" type="Text" id="v2" placeholder="V. 2" >
								</td >
								<td colspan="2">
									<input class="form-control" type="Text" id="v3" placeholder="V. 3" >
								</td>
								<td colspan="2">
									<input class="form-control" type="Text" id="v4" placeholder="V. 4" >
								</td>
								<td colspan="2">
									<input class="form-control" type="Text" id="v5" placeholder="V. 5" >
								</td>
								<td colspan="2">
									<input class="form-control" type="Text" id="v6" placeholder="V. 6" >
								</td>
								<td colspan="2">
									<input class="form-control" type="Text" id="otro" placeholder="Otro" >
								</td>
								<td colspan="3">
									<input class="form-control" type="Text" id="v_electricas" placeholder="V. Eléctricas" >
								</td>
							</tr>
							<tr class="bg-primary text-white centered text-center">								
									<td class="border">Equipo</td>
									<td class="border">Patrón</td>
								
									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">Equipo</td>
									<td class="border">Patrón</td>

									<td class="border">V</td>
									<td class="border">A</td>
									<td class="border">R</td>								
								
							</tr>
							<tr class="bg-primary text-white centered text-center">								
									<td class="border">
										<input class="form-control" type="text" id="1_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="1_p1_">
									</td>
								
									<td class="border">
										<input class="form-control" type="text" id="2_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="2_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="3_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="3_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="4_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="4_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="5_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="5_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="6_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="6_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="7_e1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="7_p1_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="8_v1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_a1_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_r1_">
									</td>								
								
							</tr>
							<tr class="bg-primary text-white centered text-center">								
									<td class="border">
										<input class="form-control" type="text" id="1_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="1_p2_">
									</td>
								
									<td class="border">
										<input class="form-control" type="text" id="2_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="2_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="3_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="3_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="4_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="4_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="5_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="5_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="6_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="6_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="7_e2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="7_p2_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="8_v2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_a2_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_r2_">
									</td>								
								
							</tr>
							<tr class="bg-primary text-white centered text-center">								
									<td class="border">
										<input class="form-control" type="text" id="1_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="1_p3_">
									</td>
								
									<td class="border">
										<input class="form-control" type="text" id="2_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="2_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="3_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="3_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="4_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="4_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="5_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="5_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="6_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="6_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="7_e3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="7_p3_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="8_v3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_a3_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_r3_">
									</td>								
								
							</tr>
							<tr class="bg-primary text-white centered text-center">								
									<td class="border">
										<input class="form-control" type="text" id="1_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="1_p4_">
									</td>
								
									<td class="border">
										<input class="form-control" type="text" id="2_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="2_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="3_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="3_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="4_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="4_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="5_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="5_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="6_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="6_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="7_e4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="7_p4_">
									</td>

									<td class="border">
										<input class="form-control" type="text" id="8_v4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_a4_">
									</td>
									<td class="border">
										<input class="form-control" type="text" id="8_r4_">
									</td>								
								
							</tr>

						</table>
					</div>

					<br style="display: block; margin: -1px 0;">

					<textarea class="form-control" rows="1.5" name="otros" id="otros" placeholder="Otros" onchange="auto_grow(this)" onkeyup="auto_grow(this)" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;"></textarea>

					<div class="p-0 mb-2 bg-primary text-white text-center rounded">REPUESTOS SOLICITADOS</div>

					<br style="display: block; margin: -5px 0;">

					<textarea class="form-control" name="repuestos" id="repuestos" rows="1.5" placeholder="Repuestos" onchange="auto_grow(this)" onkeyup="auto_grow(this)" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;"></textarea>
					<div class="p-0 mb-2 bg-primary text-white text-center rounded">OBSERVACIONES</div>

					<br style="display: block; margin: -5px 0;">

					<textarea class="form-control" name="observaciones" id="observaciones" rows="1.5" placeholder="Observaciones" onchange="auto_grow(this)" onkeyup="auto_grow(this)" style="background-color: #b0dfe5; border-color:#ffffff; height: auto;"></textarea>


					<br style="display: block; margin: -3px 0;">
						
					<br>
					<br>

					<div class="row rounded" style="background-color: #eeffff">	

						<style>
							body, canvas, div, form, input {
								margin: 0;
								padding: 0;
							}
							#wrapper {
								width: 100%;
								padding: 1px;
							}
							canvas {
								position: relative;
								margin: 1px;
								margin-left: 0px;
								border: 1px solid #3a87ad;
							}
							h1, p {
								padding-left: 2px;
								width: 100%;
								margin: 0 auto;
							}
							#controlPanel {
								margin: 2px;
							}
							#saveSignature {
								display: none;
							}
						</style>

						<div id="wrapper" class="text-center">
							<div class="p-0 mb-2 bg-primary text-white text-center rounded">FIRMA</div>							
							<div id="canvas">
								Canvas is not supported.
							</div>

							<script>
								zkSignature.capture();
							</script>

							<button type="button" onclick="zkSignature.clear()">
								Borrar firma
							</button>
							<br />
							<img id="saveSignature" alt="Saved image png"/>

							
					





								<label for="Email"></label>
								<input type="email" id="sendemail" size="35" placeholder="Send to email" autocomplete="on" hidden/><br />
								<label for="Email"></label>
								<input type="email" id="replyemail"  size="35" value="ct@zey.com" disabled hidden/>
								<br />
														
						</div>
						

						<div class="col-sm-4 rounded" style="background-color: #eeffff"></div>
						<div class="col-sm centered" style="text-align: center;">
							<input type="submit" class="btn btn-primary center" name="save_task" value="Guardar Orden de Servicio" onclick="zkSignature.send()" hidden>
							<button type="button" class="btn btn-primary center" onclick="zkSignature.send()">Guardar Orden de Servicio</button>
						</div>
						<div class="col-sm-4 rounded" style="background-color: #eeffff"></div>

						<button type="button" onclick="zkSignature.send()" hidden>Enviar</button>	

					</form>






				
			</div>

			<br>
			<br>

			<div class="col-md">
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead>
							<tr>
								<th>Entidad</th>
								<th>N.I.T.</th>
								<th>Created at</th>
								<th>Actions</th>
							</tr>
						</thead>
						<tbody>
							<?php 

							$query= "SELECT * FROM task";
							$result_tasks = mysqli_query($conn, $query);

							while ($row= mysqli_fetch_array($result_tasks)) { ?>
								<tr>
									<td><?php echo $row["entidad"]; ?> </td>
									<td><?php echo $row["nit"]; ?> </td>
									<td><?php echo $row["created_at"]; ?> </td>
									<td>
										<a href="edit.php?id=<?php echo $row["id"]; ?> " class="btn btn-primary">
											<i class="fas fa-marker"></i>
										</a>

										<a href="delete_task.php?id=<?php echo $row["id"]; ?> " class="btn btn-warning">
											<i class="fas fa-trash-alt"></i>
										</a>
									</td>
								</tr>

							

							<?php } ?> 
						</tbody>
					</table>
				</div>
				
			</div>
		</div>
		
	</div>

	

	
		
	

	


	

<?php include ("includes/footer.php") ?>






