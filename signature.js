/*************************************************

 Signsend - The signature capture webapp sample using HTML5 Canvas

 Author: Jack Wong <jack.wong@zetakey.com>
 Copyright (c): 2014 Zetakey Solutions Limited, all rights reserved

 * This library is free software; you can redistribute it and/or
 * modify it under the terms of the GNU Lesser General Public
 * License as published by the Free Software Foundation; either
 * version 2.1 of the License, or (at your option) any later version.
 *
 * This library is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the GNU
 * Lesser General Public License for more details.
 *
 * You should have received a copy of the GNU Lesser General Public
 * License along with this library; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA

 You may contact the author of Jack Wong by e-mail at:
 jack.wong@zetakey.com

 The latest version can obtained from:
 https://github.com/jackccwong/signsend

 The live demo is located at:
 http://apps.zetakey.com/signsend

 **************************************************/
var zkSignature = (function () {

	var empty = true;

	return {
		//public functions
		capture: function (){
				var parent = document.getElementById("canvas");
				parent.childNodes[0].nodeValue = "";

				var canvasArea = document.createElement("canvas");
				canvasArea.setAttribute("id", "newSignature");
				parent.appendChild(canvasArea);

				var canvas = document.getElementById("newSignature");
				var context = canvas.getContext("2d");

				if (!context) {
					throw new Error("Failed to get canvas' 2d context");
				}

				screenwidth = screen.width;

				if (screenwidth < 480) {
					canvas.width = screenwidth - 8;
					canvas.height = (screenwidth * 0.63);
				} else {
					canvas.width = 464;
					canvas.height = 304;
				}

				context.fillStyle = "#fff";
				context.strokeStyle = "#444";
				context.lineWidth = 1.2;
				context.lineCap = "round";

				context.fillRect(0, 0, canvas.width, canvas.height);

				context.fillStyle = "#3a87ad";
				context.strokeStyle = "#3a87ad";
				context.lineWidth = 1;
				context.moveTo((canvas.width * 0.042), (canvas.height * 0.7));
				context.lineTo((canvas.width * 0.958), (canvas.height * 0.7));
				context.stroke();

				context.fillStyle = "#fff";
				context.strokeStyle = "#444";

				var disableSave = true;
				var pixels = [];
				var cpixels = [];
				var xyLast = {};
				var xyAddLast = {};
				var calculate = false;
				//functions
				{
					function remove_event_listeners() {
						canvas.removeEventListener('mousemove', on_mousemove, false);
						canvas.removeEventListener('mouseup', on_mouseup, false);
						canvas.removeEventListener('touchmove', on_mousemove, false);
						canvas.removeEventListener('touchend', on_mouseup, false);

						document.body.removeEventListener('mouseup', on_mouseup, false);
						document.body.removeEventListener('touchend', on_mouseup, false);
					}

					function get_board_coords(e) {
						var x, y;

						if (e.changedTouches && e.changedTouches[0]) {
							var offsety = canvas.offsetTop || 0;
							var offsetx = canvas.offsetLeft || 0;

							x = e.changedTouches[0].pageX - offsetx;
							y = e.changedTouches[0].pageY - offsety;
						} else if (e.layerX || 0 == e.layerX) {
							x = e.layerX;
							y = e.layerY;
						} else if (e.offsetX || 0 == e.offsetX) {
							x = e.offsetX;
							y = e.offsetY;
						}

						return {
							x : x,
							y : y
						};
					};

					function on_mousedown(e) {
						e.preventDefault();
						e.stopPropagation();

						canvas.addEventListener('mousemove', on_mousemove, false);
						canvas.addEventListener('mouseup', on_mouseup, false);
						canvas.addEventListener('touchmove', on_mousemove, false);
						canvas.addEventListener('touchend', on_mouseup, false);

						document.body.addEventListener('mouseup', on_mouseup, false);
						document.body.addEventListener('touchend', on_mouseup, false);

						empty = false;
						var xy = get_board_coords(e);
						context.beginPath();
						pixels.push('moveStart');
						context.moveTo(xy.x, xy.y);
						pixels.push(xy.x, xy.y);
						xyLast = xy;
					};

					function on_mousemove(e, finish) {
						e.preventDefault();
						e.stopPropagation();

						var xy = get_board_coords(e);
						var xyAdd = {
							x : (xyLast.x + xy.x) / 2,
							y : (xyLast.y + xy.y) / 2
						};

						if (calculate) {
							var xLast = (xyAddLast.x + xyLast.x + xyAdd.x) / 3;
							var yLast = (xyAddLast.y + xyLast.y + xyAdd.y) / 3;
							pixels.push(xLast, yLast);
						} else {
							calculate = true;
						}

						context.quadraticCurveTo(xyLast.x, xyLast.y, xyAdd.x, xyAdd.y);
						pixels.push(xyAdd.x, xyAdd.y);
						context.stroke();
						context.beginPath();
						context.moveTo(xyAdd.x, xyAdd.y);
						xyAddLast = xyAdd;
						xyLast = xy;

					};

					function on_mouseup(e) {
						remove_event_listeners();
						disableSave = false;
						context.stroke();
						pixels.push('e');
						calculate = false;
					};

				}

				canvas.addEventListener('mousedown', on_mousedown, false);
				canvas.addEventListener('touchstart', on_mousedown, false);

		}
		,
		save : function(){

				var canvas = document.getElementById("newSignature");
				// save canvas image as data url (png format by default)
				var dataURL = canvas.toDataURL("image/png");
				document.getElementById("saveSignature").src = dataURL;

		}
		,
		clear : function(){

				var parent = document.getElementById("canvas");
				var child = document.getElementById("newSignature");
				parent.removeChild(child);
				empty = true;
				this.capture();

		}
		,
		send : function(){

				if (empty == false){

				var canvas = document.getElementById("newSignature");
				var dataURL = canvas.toDataURL("image/png");
				document.getElementById("saveSignature").src = dataURL;
				var sendemail = document.getElementById('sendemail').value;
				var replyemail = document.getElementById('replyemail').value;

				var entidad = document.getElementById("entidad").value;
				var nit = document.getElementById("nit").value;
				var direccion = document.getElementById("direccion").value;
				var telefono = document.getElementById("telefono").value;			
				
				var equipo = document.getElementById("equipo").value;
				var marca = document.getElementById("marca").value;
				var modelo = document.getElementById("modelo").value;
				var serie = document.getElementById("serie").value;
				var placa = document.getElementById("placa").value;


				var falla = document.getElementById("falla").value;
				var servicio = document.getElementById("servicio").value;
				var encargado = document.getElementById("encargado").value;
				var otros = document.getElementById("otros").value;
				var repuestos = document.getElementById("repuestos").value;
				var observaciones = document.getElementById("observaciones").value;

				var  trabajo_realizado = ""
				if (document.getElementById("preventivo").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("correctivo").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("instalacion").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("diagnostico").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("calibracion").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("entrenamiento").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}
				if (document.getElementById("verificacion").checked){
					trabajo_realizado += "1";
					} else {
						trabajo_realizado += "0";
					}

				console.log("trabajo_realizado:"+trabajo_realizado);

				var  puntos_inspeccion = "";

				if (document.getElementById("p_1_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_1_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_1_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}

				if (document.getElementById("p_2_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_2_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_2_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_3_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_3_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_3_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_4_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_4_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_4_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_5_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_5_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_5_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_6_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_6_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_6_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_7_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_7_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_7_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_8_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_8_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_8_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_9_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_9_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_9_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_10_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_10_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_10_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_11_a").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_11_b").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}
				if (document.getElementById("p_11_c").checked){
					puntos_inspeccion += "1";
					} else {
						puntos_inspeccion += "0";
					}

				console.log("puntos_inspeccion: "+puntos_inspeccion);

				var v1 = document.getElementById("v1").value;
				var v2 = document.getElementById("v2").value;
				var v3 = document.getElementById("v3").value;
				var v4 = document.getElementById("v4").value;
				var v5 = document.getElementById("v5").value;
				var v6 = document.getElementById("v6").value;
				var v7 = document.getElementById("otro").value;
				var v8 = document.getElementById("v_electricas").value;
				v='<input type="text" name="v1" value="' + v1 + '"/>'+				'<input type="text" name="v2" value="' + v2 + '"/>'+
				'<input type="text" name="v3" value="' + v3 + '"/>'+
				'<input type="text" name="v4" value="' + v4 + '"/>'+
				'<input type="text" name="v5" value="' + v5 + '"/>'+
				'<input type="text" name="v6" value="' + v6 + '"/>'+
				'<input type="text" name="v7" value="' + v7 + '"/>'+
				'<input type="text" name="v8" value="' + v8 + '"/>'

				var a = document.getElementById("1_e1_").value;
				var b = document.getElementById("1_p1_").value;

				var a2 = document.getElementById("1_e2_").value;
				var b2 = document.getElementById("1_p2_").value;

				var a3 = document.getElementById("1_e3_").value;
				var b3 = document.getElementById("1_p3_").value;

				var a4 = document.getElementById("1_e4_").value;
				var b4 = document.getElementById("1_p4_").value;

				var c1='<input type="text" name="a" value="' + a + '"/>'+
				'<input type="text" name="b" value="' + b + '"/>'+
				'<input type="text" name="a2" value="' + a2 + '"/>'+
				'<input type="text" name="b2" value="' + b2 + '"/>'+
				'<input type="text" name="a3" value="' + a3 + '"/>'+
				'<input type="text" name="b3" value="' + b3 + '"/>'+
				'<input type="text" name="a4" value="' + a4 + '"/>'+
				'<input type="text" name="b4" value="' + b4 + '"/>'

				var a_ = document.getElementById("2_e1_").value;
				var b_ = document.getElementById("2_p1_").value;

				var a2_ = document.getElementById("2_e2_").value;
				var b2_ = document.getElementById("2_p2_").value;

				var a3_ = document.getElementById("2_e3_").value;
				var b3_ = document.getElementById("2_p3_").value;

				var a4_ = document.getElementById("2_e4_").value;
				var b4_ = document.getElementById("2_p4_").value;

				var c2='<input type="text" name="a_" value="' + a_ + '"/>'+
				'<input type="text" name="b_" value="' + b_ + '"/>'+
				'<input type="text" name="a2_" value="' + a2_ + '"/>'+
				'<input type="text" name="b2_" value="' + b2_ + '"/>'+
				'<input type="text" name="a3_" value="' + a3_ + '"/>'+
				'<input type="text" name="b3_" value="' + b3_ + '"/>'+
				'<input type="text" name="a4_" value="' + a4_ + '"/>'+
				'<input type="text" name="b4_" value="' + b4_ + '"/>'


				var a_3 = document.getElementById("3_e1_").value;
				var b_3 = document.getElementById("3_p1_").value;

				var a2_3 = document.getElementById("3_e2_").value;
				var b2_3 = document.getElementById("3_p2_").value;

				var a3_3 = document.getElementById("3_e3_").value;
				var b3_3 = document.getElementById("3_p3_").value;

				var a4_3 = document.getElementById("3_e4_").value;
				var b4_3 = document.getElementById("3_p4_").value;

				var c3='<input type="text" name="a_3" value="' + a_3 + '"/>'+
				'<input type="text" name="b_3" value="' + b_3 + '"/>'+
				'<input type="text" name="a2_3" value="' + a2_3 + '"/>'+
				'<input type="text" name="b2_3" value="' + b2_3 + '"/>'+
				'<input type="text" name="a3_3" value="' + a3_3 + '"/>'+
				'<input type="text" name="b3_3" value="' + b3_3 + '"/>'+
				'<input type="text" name="a4_3" value="' + a4_3 + '"/>'+
				'<input type="text" name="b4_3" value="' + b4_3 + '"/>'


				var a_4 = document.getElementById("4_e1_").value;
				var b_4 = document.getElementById("4_p1_").value;

				var a2_4 = document.getElementById("4_e2_").value;
				var b2_4 = document.getElementById("4_p2_").value;

				var a3_4 = document.getElementById("4_e3_").value;
				var b3_4 = document.getElementById("4_p3_").value;

				var a4_4 = document.getElementById("4_e4_").value;
				var b4_4 = document.getElementById("4_p4_").value;

				var c4='<input type="text" name="a_4" value="' + a_4 + '"/>'+
				'<input type="text" name="b_4" value="' + b_4 + '"/>'+
				'<input type="text" name="a2_4" value="' + a2_4 + '"/>'+
				'<input type="text" name="b2_4" value="' + b2_4 + '"/>'+
				'<input type="text" name="a3_4" value="' + a3_4 + '"/>'+
				'<input type="text" name="b3_4" value="' + b3_4 + '"/>'+
				'<input type="text" name="a4_4" value="' + a4_4 + '"/>'+
				'<input type="text" name="b4_4" value="' + b4_4 + '"/>'				


				var a_5 = document.getElementById("5_e1_").value;
				var b_5 = document.getElementById("5_p1_").value;

				var a2_5 = document.getElementById("5_e2_").value;
				var b2_5 = document.getElementById("5_p2_").value;

				var a3_5 = document.getElementById("5_e3_").value;
				var b3_5 = document.getElementById("5_p3_").value;

				var a4_5 = document.getElementById("5_e4_").value;
				var b4_5 = document.getElementById("5_p4_").value;

				var c5='<input type="text" name="a_5" value="' + a_5 + '"/>'+
				'<input type="text" name="b_5" value="' + b_5 + '"/>'+
				'<input type="text" name="a2_5" value="' + a2_5 + '"/>'+
				'<input type="text" name="b2_5" value="' + b2_5 + '"/>'+
				'<input type="text" name="a3_5" value="' + a3_5 + '"/>'+
				'<input type="text" name="b3_5" value="' + b3_5 + '"/>'+
				'<input type="text" name="a4_5" value="' + a4_5 + '"/>'+
				'<input type="text" name="b4_5" value="' + b4_5 + '"/>'
				


				var a_6 = document.getElementById("6_e1_").value;
				var b_6 = document.getElementById("6_p1_").value;

				var a2_6 = document.getElementById("6_e2_").value;
				var b2_6 = document.getElementById("6_p2_").value;

				var a3_6 = document.getElementById("6_e3_").value;
				var b3_6 = document.getElementById("6_p3_").value;

				var a4_6 = document.getElementById("6_e4_").value;
				var b4_6 = document.getElementById("6_p4_").value;

				var c6='<input type="text" name="a_6" value="' + a_6 + '"/>'+
				'<input type="text" name="b_6" value="' + b_6 + '"/>'+
				'<input type="text" name="a2_6" value="' + a2_6 + '"/>'+
				'<input type="text" name="b2_6" value="' + b2_6 + '"/>'+
				'<input type="text" name="a3_6" value="' + a3_6 + '"/>'+
				'<input type="text" name="b3_6" value="' + b3_6 + '"/>'+
				'<input type="text" name="a4_6" value="' + a4_6 + '"/>'+
				'<input type="text" name="b4_6" value="' + b4_6 + '"/>'
				


				var a_7 = document.getElementById("7_e1_").value;
				var b_7 = document.getElementById("7_p1_").value;

				var a2_7 = document.getElementById("7_e2_").value;
				var b2_7 = document.getElementById("7_p2_").value;

				var a3_7 = document.getElementById("7_e3_").value;
				var b3_7 = document.getElementById("7_p3_").value;

				var a4_7 = document.getElementById("7_e4_").value;
				var b4_7 = document.getElementById("7_p4_").value;

				var c7='<input type="text" name="a_7" value="' + a_7 + '"/>'+
				'<input type="text" name="b_7" value="' + b_7 + '"/>'+
				'<input type="text" name="a2_7" value="' + a2_7 + '"/>'+
				'<input type="text" name="b2_7" value="' + b2_7 + '"/>'+
				'<input type="text" name="a3_7" value="' + a3_7 + '"/>'+
				'<input type="text" name="b3_7" value="' + b3_7 + '"/>'+
				'<input type="text" name="a4_7" value="' + a4_7 + '"/>'+
				'<input type="text" name="b4_7" value="' + b4_7 + '"/>'


				var a_8 = document.getElementById("8_v1_").value;
				var b_8 = document.getElementById("8_a1_").value;
				var c_8 = document.getElementById("8_r1_").value;

				var a2_8 = document.getElementById("8_v2_").value;
				var b2_8 = document.getElementById("8_a2_").value;
				var c2_8 = document.getElementById("8_r2_").value;

				var a3_8 = document.getElementById("8_v3_").value;
				var b3_8 = document.getElementById("8_a3_").value;
				var b3_8 = document.getElementById("8_r3_").value;

				var a4_8 = document.getElementById("8_v4_").value;
				var b4_8 = document.getElementById("8_a4_").value;
				var c4_8 = document.getElementById("8_r4_").value;

				var c8='<input type="text" name="a_8" value="' + a_8 + '"/>'+
				'<input type="text" name="b_8" value="' + b_8 + '"/>'+
				'<input type="text" name="a2_8" value="' + a2_8 + '"/>'+
				'<input type="text" name="b2_8" value="' + b2_8 + '"/>'+
				'<input type="text" name="a3_8" value="' + a3_8 + '"/>'+
				'<input type="text" name="b3_8" value="' + b3_8 + '"/>'+
				'<input type="text" name="a4_8" value="' + a4_8 + '"/>'+
				'<input type="text" name="b4_8" value="' + b4_8 + '"/>'

				//console.log("v:"+a4_8+" A:"+b4_8+" R:"+c4_8);
				//console.log("title:"+entidad);				
				//console.log(entidad == ''); // true
				//console.log(entidad == null); // false	
				alert("nit: "+nit+" telefono: "+telefono+" direccion: "+direccion);	
						

				var dataform = document.createElement("form");
				document.body.appendChild(dataform);
				dataform.setAttribute("action","upload_file.php");
				dataform.setAttribute("enctype","multipart/form-data");
				dataform.setAttribute("method","POST");
				dataform.setAttribute("target","_self");
				dataform.innerHTML =v+c1+c2+c3+c4+c5+c6+c7+c8+ '<input type="text" name="image" value="' + dataURL + '"/>'+ '<input type="text" name="falla" value="' + falla + '"/>'+ '<input type="text" name="placa" value="' + placa + '"/>'+ '<input type="text" name="serie" value="' + serie + '"/>'+ '<input type="text" name="modelo" value="' + modelo + '"/>'+ '<input type="text" name="marca" value="' + marca + '"/>'+ '<input type="text" name="telefono" value="' + telefono + '"/>'+ '<input type="text" name="direccion" value="' + direccion + '"/>'+ '<input type="text" name="nit" value="' + nit + '"/>'+ '<input type="text" name="equipo" value="' + equipo + '"/>'+ '<input type="text" name="entidad" value="' + entidad + '"/>' + '<input type="email" name="email" value="' + sendemail + '"/>' + '<input type="email" name="replyemail" value="' + replyemail + '"/>'+'<input type="submit" value="Click me" />';
				dataform.submit();

				}
		}

	}

})()

var zkSignature;
