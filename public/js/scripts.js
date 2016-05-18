
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
    

    $("#next-step").on('click', function(){
        console.log("EIAFOI");
        // $(".baseinfo").fadeOut('slow');
        $(".exampletable").fadeIn();
    });


    $(".mbr-save-form").on('submit', function(e){
        // e.preventDefault();
        var mbr = $("#mbr-chosen").parent().attr("id");
        var res = mbr.split("mbr-choice-");
        $("input[name='_mbrid']").attr("value", res[1]);
    });

    $("a[name='mbr_selection']").on('click', function(){
        console.log("YES CLICK");
        console.log($(this));

        // $("a[name='mbr_selection']")
        var username = "aoiejfoiajfe";
        var token =  "AFOIKJOIAFE";
        var dataString = 'username='+username+'&token='+token; 

        $("#mbr-chosen").attr({'id': ''}).html('Pilih Member');

        // $.ajaxSetup({
        //   headers: {
        //     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //   }
        // });find
    $tt = $(this).parent();
    console.log($tt);

    // console.log("UEUEUE");


    // $("input[name='_mbrid']").attr("value", $("input[name='_memberkey']").val() );

        // var x = $('meta[name="_token"]').attr('content');
        // console.log(x);

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


        $(this)
            .attr({'id' : 'mbr-chosen'}).html('<i class="fa fa-check" aria-hidden="true"></i> Terpilih');


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
