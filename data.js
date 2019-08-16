$(document).ready(function(){
    $.getJSON("http://pmon01.skp-dp.sde.dk/shoe-size-collection/api/sscInfo/read.php", function(data){
        var data_html = "";

        $.each(data.records, function(key, val){
            data_html += `
                    <tr>
                        <th scope="row">` + val.id + `</th>
                        <td>` + val.name + `</td>
                        <td>` + val.email + `</td>
                        <td>` + val.age + `</td>
                        <td>` + val.shoe_size + `</td>
                    </tr>
                    `
        });

        $("#databody").html(data_html);
    });
});