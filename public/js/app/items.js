(function($,session){

    session.isLooged();
    
    var alowLoadItems = [
        "/secure/items.html"
    ];

    if(alowLoadItems.indexOf($(location).attr('pathname')) != -1){
        loadItems();
    }

   // $('#alert_title').css('display','none');
    //$('#alert_description').css('display','none');
    //$('#alert_categoryid').css('display','none');
    //$('#alert_unitprice').css('display','none');
    //$('#alert_maxretailprice').css('display','none');
    //$('#alert_quantity').css('display','none');


    $('#frm_item').on('submit',function(e){
        e.preventDefault();

        var data = $(this).serialize();

        $.ajax({
            method: "POST",
            url: '/api/v1/saveItem',
            data: data,
            headers: { 'token': session.get().token }
        }).done(function( msg ) {

            if(msg.status == "SUCCESS"){
                location.href='/secure/items.html'
            }else if(msg.status == "F-TITLE"){
                //alert(msg.error);
                //$('#alert_title > .alert-body').html(msg.error);
              //  $('#alert_title').css('display','block');
//
            }

        });

    });

        function loadItems(){
        var tmpl = "",
            $listWrapper = $('#item_list');
    
    
        $listWrapper.html("");
        
        $.ajax({
            method  : "GET",
            url     : '/api/v1/getItem',
            headers : { 'token': session.get().token }
        }).done(function(data){
           
            if(data.status == 'SUCCESS'){
                
                data.items.forEach(function(item,index){
                    tmpl += '<tr class="gradeX">';
                    tmpl += '<td>'+id+'</td>';
                    tmpl += '<td>'+title+'</td>';
                    tmpl += '<td>'+unit_price+'</td>';
                    tmpl += '<td class="center">'+reorder_level+'</td>';
                    tmpl += '<td class="center">'+quantity+'</td>';
                    tmpl += '</tr>';                   
                    
                });
                $listWrapper.html(tmpl);
               
            }
        });
    
    }



})(jQuery,new Session());