$(document).ready(function(){
    console.log("onmklkln k");
    $('#designation').on('change',function(){
        
        var dg_id=$(this).val();
        $.ajax({
            url: "getPosition.php",
            type: "POST",
            data: { dg_id: dg_id },
            success: function(data){
                $('#position').html('<option value="">Select Position</option>');
                $('#position').append(data);
                //1
                //$('#postion').html(data);
            }
        });
    });

    $('#position').on('change',function(){
        console.log("onmklkln k");
        
       var ps_id=$(this).val();
       console.log(ps_id);
       
       $.ajax({
        url: "getemployee.php",
        type: "POST",
        data: {ps_id: ps_id},
        success: function(data){
            $('#employee').html('<option value="">Select Employee</option>');
            $('#employee').append(data);
            //2
            //$('#employee').html(data);
        
        }
       });
    });
});