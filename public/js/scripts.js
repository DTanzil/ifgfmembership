
jQuery(document).ready(function() {
    
    // edit role page: show list of member after 'Next'
    $("#next-step").on('click', function(){
        $(".searchmembertable").fadeIn();
    });


    // delete item confirmation
    $("button.mty-delete").click(function(e) {
        var proceed = confirm("Are you sure you would like to delete this item ?");
        if(!proceed) {
            e.preventDefault();            
        }
    });

    // update hidden input for every selected member from list of member in a table 
    $(".mbr-save-mul-form").on('submit', function(e){
        var result = [];
        $( ".chosen" ).each(function( index ) {
            var item_id = getMyId($(this));
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
            var name = $(this).closest('tr').find("td.dtname").html();
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

     // extract id from list of #selectedmembers
    function getMyId(item)
    {   
        var mbr = item.attr("id");
        var res = mbr.split("mbr_chs_");
        return Number(res[1]);
    }

});
