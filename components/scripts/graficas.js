$('.select').select2({
	placeholder: 'Seleccione una fecha',
	minimumResultsForSearch: Infinity,
});

let year = (new Date().getFullYear())
datosGrafico(year)
$('#year').on('change', function (event) {
	
	event.preventDefault()
	let yearSeleccionado = $(this).val();
	datosGrafico(yearSeleccionado)
	
})

function datosGrafico(year) {
	
	let nombresDelMes = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	// console.log(nombresDelMes)
	$.ajax({
		url: 'http://localhost/ci3/getData',
		type: 'post',
		data: {year: year},
		dataType: 'json',
		success: function (data) {
			// console.log(data)
			let meses = [];
			let montos = [];
			
			$.each(data, function (key, value) {
				
				meses.push(nombresDelMes[value.mes - 1]);
				montos.push(value.monto)
				
			})
			graficar(meses, montos)
			
		}
	})
	
}


function graficar(meses, montos) {
	// Define element
	var columns_basic_element = echarts.init(document.getElementById('graficaServicioTecnico'));
	
	// Options
	var option = ({
		
		// Define colors
		color: ['#5ab1ef'],
		
		// Global text styles
		textStyle: {
			fontFamily: 'Roboto, Arial, Verdana, sans-serif',
			fontSize: 13
		},
		// Chart animation duration
		animationDuration: 3000,
		
		// Setup grid
		grid: {
			left: 0,
			right: 40,
			top: 35,
			bottom: 0,
			containLabel: true
		},
		
		// Add legend
		legend: {
			data: ['Ingresos Servicio Técnico'],
			itemHeight: 8,
			itemGap: 20,
			textStyle: {
				padding: [0, 5],
				color: '#FFF'
			}
		},
		
		// Add tooltip
		tooltip: {
			trigger: 'axis',
			backgroundColor: 'rgba(255,255,255,0.9)',
			padding: [10, 15],
			textStyle: {
				color: '#222',
				fontSize: 13,
				fontFamily: 'Roboto, sans-serif'
			},
			axisPointer: {
				type: 'shadow',
				shadowStyle: {
					color: 'rgba(255,255,255,0.1)'
				}
			}
		},
		
		// Horizontal axis
		xAxis: [{
			type: 'category',
			data: meses,
			axisLabel: {
				color: '#FFF'
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.25)'
				}
			},
			splitLine: {
				show: true,
				lineStyle: {
					color: 'rgba(255,255,255,0.1)',
					type: 'dashed'
				}
			}
		}],
		
		// Vertical axis
		yAxis: [{
			type: 'value',
			axisLabel: {
				color: '#FFF'
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.25)'
				}
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.1)'
				}
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ['rgba(255,255,255,0.01)', 'rgba(0,0,0,0.01)']
				}
			}
		}],
		
		// Axis pointer
		axisPointer: [{
			lineStyle: {
				color: 'rgba(255,255,255,0.25)'
			}
		}],
		
		// Add series
		series: [
			{
				name: 'Ingresos Servicio Técnico',
				type: 'bar',
				data: montos,
				itemStyle: {
					normal: {
						label: {
							show: true,
							position: 'top',
							textStyle: {
								fontWeight: 500
							}
						}
					}
				},
			},
		]
	});
	
	// Resize function
	var triggerChartResize = function () {
		columns_basic_element.resize();
	};
	
	// On sidebar width change
	var sidebarToggle = document.querySelector('.sidebar-control');
	sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);
	
	// On window resize
	var resizeCharts;
	window.addEventListener('resize', function () {
		clearTimeout(resizeCharts);
		resizeCharts = setTimeout(function () {
			triggerChartResize();
		}, 200);
	});
	
	
	//
	// Return objects assigned to module
	columns_basic_element.setOption(option)
}


/* GRAFICA PLOTEO */
$('.selectPloteo').select2({
	placeholder: 'Seleccione una fecha',
	minimumResultsForSearch: Infinity,
});

let yearPloteo = (new Date().getFullYear())

datosGraficoPloteo(yearPloteo)
$('#yearPloteo').on('change', function (event) {
	
	event.preventDefault()
	let yearSeleccionado = $(this).val();
	datosGraficoPloteo(yearSeleccionado)
	
})

function datosGraficoPloteo(yearPloteo) {
	
	let nombresDelMesPloteo = ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'];
	// console.log(nombresDelMesPloteo)
	$.ajax({
		url: 'http://localhost/ci3/getDataPloteo',
		type: 'post',
		data: {yearPloteo: yearPloteo},
		dataType: 'json',
		success: function (data) {
			// console.log(data)
			let mesesPloteo = [];
			let montosPloteo = [];
			
			$.each(data, function (key, value) {
				
				mesesPloteo.push(nombresDelMesPloteo[value.mesPloteo - 1]);
				montosPloteo.push(value.montoPloteo)
				
			})
			graficarPloteo(mesesPloteo, montosPloteo)
			
		}
	})
	
}


function graficarPloteo(mesesPloteo, montosPloteo) {
	// Define element
	var columns_basic_element = echarts.init(document.getElementById('graficaPloteo'));
	
	// Options
	var option = ({
		
		// Define colors
		color: ['#d87a80'],
		
		// Global text styles
		textStyle: {
			fontFamily: 'Roboto, Arial, Verdana, sans-serif',
			fontSize: 13
		},
		// Chart animation duration
		animationDuration: 3000,
		
		// Setup grid
		grid: {
			left: 0,
			right: 40,
			top: 35,
			bottom: 0,
			containLabel: true
		},
		
		// Add legend
		legend: {
			data: ['Ingresos Ploteo'],
			itemHeight: 8,
			itemGap: 20,
			textStyle: {
				padding: [0, 5],
				color: '#FFF'
			}
		},
		
		// Add tooltip
		tooltip: {
			trigger: 'axis',
			backgroundColor: 'rgba(255,255,255,0.9)',
			padding: [10, 15],
			textStyle: {
				color: '#222',
				fontSize: 13,
				fontFamily: 'Roboto, sans-serif'
			},
			axisPointer: {
				type: 'shadow',
				shadowStyle: {
					color: 'rgba(255,255,255,0.1)'
				}
			}
		},
		
		// Horizontal axis
		xAxis: [{
			type: 'category',
			data: mesesPloteo,
			axisLabel: {
				color: '#FFF'
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.25)'
				}
			},
			splitLine: {
				show: true,
				lineStyle: {
					color: 'rgba(255,255,255,0.1)',
					type: 'dashed'
				}
			}
		}],
		
		// Vertical axis
		yAxis: [{
			type: 'value',
			axisLabel: {
				color: '#FFF'
			},
			axisLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.25)'
				}
			},
			splitLine: {
				lineStyle: {
					color: 'rgba(255,255,255,0.1)'
				}
			},
			splitArea: {
				show: true,
				areaStyle: {
					color: ['rgba(255,255,255,0.01)', 'rgba(0,0,0,0.01)']
				}
			}
		}],
		
		// Axis pointer
		axisPointer: [{
			lineStyle: {
				color: 'rgba(255,255,255,0.25)'
			}
		}],
		
		// Add series
		series: [
			{
				name: 'Ingresos Ploteo',
				type: 'bar',
				data: montosPloteo,
				itemStyle: {
					normal: {
						label: {
							show: true,
							position: 'top',
							textStyle: {
								fontWeight: 500
							}
						}
					}
				},
			},
		]
	});
	
	// Resize function
	var triggerChartResize = function () {
		columns_basic_element.resize();
	};
	
	// On sidebar width change
	var sidebarToggle = document.querySelector('.sidebar-control');
	sidebarToggle && sidebarToggle.addEventListener('click', triggerChartResize);
	
	// On window resize
	var resizeCharts;
	window.addEventListener('resize', function () {
		clearTimeout(resizeCharts);
		resizeCharts = setTimeout(function () {
			triggerChartResize();
		}, 200);
	});
	
	
	//
	// Return objects assigned to module
	columns_basic_element.setOption(option)
}


let nuevavariable
let otraVariable