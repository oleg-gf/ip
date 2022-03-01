$(document).ready(function() {
    $('#ip-query').click(function (){
        let selector = "#ip-output";
        
        let string = '/components/ip_handler.php?ip=' + $("#ip-input").val() 
                        + '&service=' + $("#services").val();
        $.getJSON(string, function(data){
                console.log(data);
                if (data == "Неверный IP") {
                    $(selector).empty().append(data);
                } else {
                    $(selector).empty().append(data);
                }
                

            }
        );
   });
   myip();

    function myip(){
        let selector = "#myip-output";
        
        let string = '/components/ip_handler.php?myip=1';
        $.getJSON(string, function(data){
                    $(selector).empty().append(data);
        });
   }
});