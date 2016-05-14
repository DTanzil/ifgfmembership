
jQuery(document).ready(function() {
	
    /*
        Fullscreen background
    */

    // $.backstretch("assets/img/backgrounds/1.jpg");
    
    // $('#top-navbar-1').on('shown.bs.collapse', function(){
    // 	$.backstretch("resize");
    // });
    // $('#top-navbar-1').on('hidden.bs.collapse', function(){
    // 	$.backstretch("resize");
    // });
    
    /*
        Form
    */

    // console.log("ready!");
    $('.registration-form fieldset').first().fadeIn('slow');
    
    $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    $("a[name='family-father-role']").on('click', function(){
        console.log("YES CLICK");
        console.log($(this));

        var username = "aoiejfoiajfe";
        var token =  "AFOIKJOIAFE";
        var dataString = 'username='+username+'&token='+token; 


        $.ajaxSetup({
          headers: {
            'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
          }
        });

        var x = $('meta[name="_token"]').attr('content');
        console.log(x);

        // $.ajax({
        //     type: "POST",
        //     // headers: {
        //     //     'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //     // },
        //     url : "http://localhost/ifgfbdg/public/family/user/profile/add",
        //     data : dataString,
        //     success : function(data){
        //         console.log(data);
        //     }
        // },"json");


        $(this).css({
           // 'font-size' : '10px',
           'background-color' : 'blue',
           // 'height' : '10px'
        }).html("Terpilih");


    });


    // next step
    $('.registration-form .btn-next').on('click', function() {
        console.log("IAJIA");
    	var parent_fieldset = $(this).parents('fieldset');
    	var next_step = true;
    	
    	parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			$(this).addClass('input-error');
    			next_step = false;
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    	if( next_step ) {
    		parent_fieldset.fadeOut(400, function() {
	    		$(this).next().fadeIn();
	    	});
    	}
    	
    });
    
    // previous step
    $('.registration-form .btn-previous').on('click', function() {
    	$(this).parents('fieldset').fadeOut(400, function() {
    		$(this).prev().fadeIn();
    	});
    });
    
    // submit
    $('.registration-form').on('submit', function(e) {
    	
    	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    		if( $(this).val() == "" ) {
    			e.preventDefault();
    			$(this).addClass('input-error');
    		}
    		else {
    			$(this).removeClass('input-error');
    		}
    	});
    	
    });
    
    
});
