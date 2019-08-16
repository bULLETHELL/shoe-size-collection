// Convert to json format
$.fn.serializeObject = function()
{
    var o = {};
    var a = this.serializeArray();
    $.each(a, function() {
        if (o[this.name] !== undefined) {
            if (!o[this.name].push) {
                o[this.name] = [o[this.name]];
            }
            o[this.name].push(this.value || '');
        } else {
            o[this.name] = this.value || '';
        }
    });
    return o;
};

$('form').submit(function(){
    var form_data = JSON.stringify($('form').serializeObject());

    //console.log($(this));
    //console.log(form_data);

    $.ajax({
        url: "http://pmon01.skp-dp.sde.dk/shoe-size-collection/api/sscInfo/create.php",
        type: "POST",
        contentType: "application/json",
        data: form_data,
        success: function(result){
            window.location = "http://pmon01.skp-dp.sde.dk/shoe-size-collection/data.html";
        },
        error: function(xhr, resp, text){
            console.log(xhr, resp, text);
        }        
    });
});