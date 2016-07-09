
jQuery(document).ready(function() {
	
    /*
        Form
    */
    // $('.registration-form fieldset').first().fadeIn('slow');
    
    $('.registration-form input[type="text"], .registration-form input[type="password"], .registration-form textarea').on('focus', function() {
    	$(this).removeClass('input-error');
    });
    
    // edit role page: show list of member after 'Next'
    $("#next-step").on('click', function(){
        $(".searchmembertable").fadeIn();
    });


    // delete item confirmation
    $("button.mty-delete").click( function(e) {
        var proceed = confirm("Are you sure you would like to delete this item ?");
        if(!proceed) {
            e.preventDefault();            
        }
    });

    // SINGLE SELECT
    // update hidden input for 1 selected member from list of member in a table 
    // $(".mbr-save-form").on('submit', function(e){
    //     var mbr = $("#mbr-chosen").parent().attr("id");
    //     var res = mbr.split("mbr-choice-");
    //     $("input[name='_mbrid']").attr("value", res[1]);
    // });

    // // change Choose Member text to Selected
    // $("a[name='mbr_selection']").on('click', function(){
        
    //     $("#mbr-chosen").attr({'id': ''}).html('Choose Member');
    //     $(this)
    //         .attr({'id' : 'mbr-chosen'}).html('<i class="fa fa-check" aria-hidden="true"></i> Selected');
    // });

    // MULTIPLE SELECTS


    // update hidden input for every selected member from list of member in a table 
    $(".mbr-save-mul-form").on('submit', function(e){
        // e.preventDefault();
        var result = [];
        $( ".mbr-mulchosen" ).each(function( index ) {
            // var mbr = $(this).parent().attr("id");
            // var res = mbr.split("mbr-choice-");
            var item_id = getId($(this));
            result.push(item_id);
        });
        result = JSON.stringify(result);
        $("input[name='_mbrids']").attr("value", result);
    });


    // change Choose Member text to Selected
    $("a[name='mbr_mulselection']").on('click', function(){
        var item_id = getId($(this));
        if($(this).hasClass('mbr-mulchosen')) {
            // deselect this member
            $(this).removeClass('mbr-mulchosen').html('Choose Member');
            $("#mbr_chs_"+item_id).remove();
            

        } else {
            // select this member
            $(this).addClass('mbr-mulchosen').html('<i class="fa fa-check" aria-hidden="true"></i> Selected');
            // console.log($(this));
            var name = $(this).closest('tr').find("td.dtname").html();
            // console.log(xx);
            $("#selectedmembers").append($("<span>").attr({"class" : "chosen", "id": "mbr_chs_"+item_id}).html(name));

        }       
    });

    // extract id from input id from search member table 
    function getId(item)
    {   
        var mbr = item.parent().attr("id");
        var res = mbr.split("mbr-choice-");
        return res[1];
    }

    

    // // redirect users if dropdown select is changed
    // $('select[name="_mbrole"]').on('change', function (e) {
    //     // console.log("CHANGED!!");
    //     var optionSelected = $("option:selected", this);
    //     var valueSelected = this.value;
    //     console.log(valueSelected);

    //     var jobs = JSON.parse("{{ json_encode($urls['edit']) }}");
    //     console.log(jobs);
    //     // window.location.replace("http://localhost/"); 

    // });




    // $("a.mbr-mulchosen").on('click', function(){
    //     console.log("CHOSEN ALREADY");
    //     // $("#mbr-chosen").attr({'id': ''}).html('Choose Member');
    //     // $(this).addClass('mbr-mulchosen')
    //     //     .html('<i class="fa fa-check" aria-hidden="true"></i> Selected');
    // });




    // next step
    // $('.registration-form .btn-next').on('click', function() {
    // 	var parent_fieldset = $(this).parents('fieldset');
    // 	var next_step = true;
    	
    // 	parent_fieldset.find('input[type="text"], input[type="password"], textarea').each(function() {
    // 		if( $(this).val() == "" ) {
    // 			$(this).addClass('input-error');
    // 			next_step = false;
    // 		}
    // 		else {
    // 			$(this).removeClass('input-error');
    // 		}
    // 	});
    	
    // 	if( next_step ) {
    // 		parent_fieldset.fadeOut(400, function() {
	   //  		$(this).next().fadeIn();
	   //  	});
    // 	}    	
    // });



    
    // previous step
    // $('.registration-form .btn-previous').on('click', function() {
    // 	$(this).parents('fieldset').fadeOut(400, function() {
    // 		$(this).prev().fadeIn();
    // 	});
    // });
    
    // submit
    // $('.registration-form').on('submit', function(e) {
    	
    // 	$(this).find('input[type="text"], input[type="password"], textarea').each(function() {
    // 		if( $(this).val() == "" ) {
    // 			e.preventDefault();
    // 			$(this).addClass('input-error');
    // 		}
    // 		else {
    // 			$(this).removeClass('input-error');
    // 		}
    // 	});
    	
    // });

     // $.ajaxSetup({
        //   headers: {
        //     'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
        //   }
        // });find

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

    
    
});
