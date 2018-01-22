$(document).ready(function() {
	var tiempo = 30;
	setInterval(function(){--tiempo;},1000);
	
	function crearPlaga(){
		if(tiempo<1){ $('#final').modal({backdrop: 'static', keyboard: false});    $("#final").modal("show"); return false;}
		var cantidad = Math.floor((Math.random() * 20) + 10);
		for(var i=1;i<cantidad;i++){
			var posY = Math.floor((Math.random() * 9) + 1);
			var velocidad = Math.floor((Math.random() * 5) + 1);
			var elBicho = Math.floor((Math.random() * 4) + 1);
			var vel = 3000 * velocidad;
			var theBicho = $('<div class="bicho bicho'+elBicho+'"></div>');
			$('body').append(theBicho);
			var pY = '50%';
			var pY2 = '110%';
			if(posY==1){$(theBicho).css('top','5%');}
			else if(posY==2){$(theBicho).css('top','20%');}
			else if(posY==3){$(theBicho).css('top','35%');}
			else if(posY==4){$(theBicho).css('top','40%');}
			else if(posY==5){$(theBicho).css('top','55%');}
			else if(posY==6){$(theBicho).css('top','60%');}
			else if(posY==7){$(theBicho).css('top','65%');}			
			else if(posY==8){$(theBicho).css('top','70%');}			
			else if(posY==9){$(theBicho).css('top','75%');}												
			
			$(theBicho).animate({left:pY2},vel,function(){
				$(theBicho).remove();
			})
		}		
	}
	
	var inicio=true;
	 $("#mostrarmodal").on('click',function(){
		 if(inicio){
			 inicio=false;
			setInterval(crearPlaga,7000);
			crearPlaga();
		 }
		 return false;
	 })

	
	
	var total = 0;
	$('body').on('click','.bicho',function(){
		++total;
		$('.total').html(total);
		$(this).remove();
	})

	$(document).bind('selectstart dragstart', function(e) {
	  e.preventDefault();
	  return false;
	});
	
	
	
})