function decodeHtml(html) {
    var txt = document.createElement("textarea");
    txt.innerHTML = html;
    return txt.value;
}

$(document).ready(function(){
    $('#token').click(function() {
        $('#token').attr("type","password");
    });
});
var contents = $('#thenote').html();
$('#thenote').blur(function() {
    if (contents!=$(this).html()){
        //alert('Handler for .change() called.');
        contents = $(this).html();
        put_data(contents);
    }
});

$( "#thenote" ).keyup(function() {
    //alert( "Handler for .keyup() called." );
    let contents = $( "#thenote" ).html()
    //$("#previewBox").html( decodeHtml(contents) );
    put_data(contents);
});

var put_data = (contents) => {
    var data = {};
    data.contents = contents;
    data.t = "<?php echo $t; ?>";
    var json = JSON.stringify(data);
    var xhr = new XMLHttpRequest();
    xhr.open("PUT", '_api.php', true);
    xhr.setRequestHeader('Content-type','application/json; charset=utf-8');
    xhr.onload = function () {
        var users = JSON.parse(xhr.responseText);
        if (xhr.readyState == 4 && xhr.status == "200") {
          //alert("received");
        } else {
            alert("error");
          console.error(users);
        }
    }
    xhr.send(json);
}
