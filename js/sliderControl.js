	// TODO: Automate this using 
	  var environment = document.getElementById('env_slide'),
	    wattage = document.getElementById('wattage_slide'),
	    lighting = document.getElementById('lighting_slide'),
	  	noisiness = document.getElementById('noisiness_slide'),
	  	water = document.getElementById('water_slide'),
	  	coffee = document.getElementById('coffee_slide'),
	  	comfort = document.getElementById('comfort_slide'),
	  	pc = document.getElementById('pc_slide');

	  noUiSlider.create(environment, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 2
	  	}
	  });

	  noUiSlider.create(wattage, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 100
	  	}
	  });

	  noUiSlider.create(lighting, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 2
	  	}
	  });

	  noUiSlider.create(noisiness, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 55
	  	}
	  });

	  noUiSlider.create(water, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 100
	  	}
	  });

	  noUiSlider.create(coffee, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 3
	  	}
	  });

	  noUiSlider.create(comfort, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 1
	  	}
	  });

	  noUiSlider.create(pc, {
	  	start: [ 0 ],
	  	connect: 'lower',
	  	range: {
	  		'min': 0,
	  		'max': 1.75
	  	}
	  });

	  environment.noUiSlider.on('update', function(){
	    $('#Environment').attr('value', environment.noUiSlider.get());
	  });

	  wattage.noUiSlider.on('update', function(){
	    $('#Wattage').attr('value', wattage.noUiSlider.get());
	  });

	  lighting.noUiSlider.on('update', function(){
	    $('#Lighting').attr('value', lighting.noUiSlider.get());
	  });

	  noisiness.noUiSlider.on('update', function(){
	    $('#Noisiness').attr('value', noisiness.noUiSlider.get());
	  });

	  water.noUiSlider.on('update', function(){
	    $('#Water').attr('value', water.noUiSlider.get());
	  });

	  coffee.noUiSlider.on('update', function(){
	    $('#Coffee').attr('value', coffee.noUiSlider.get());
	  });

	  comfort.noUiSlider.on('update', function(){
	    $('#Comfort').attr('value', comfort.noUiSlider.get());
	  });

	  pc.noUiSlider.on('update', function(){
	    $('#ComputerPower').attr('value', pc.noUiSlider.get());
	  });
