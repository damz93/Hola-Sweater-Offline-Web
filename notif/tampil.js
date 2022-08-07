$(document).ready(function() {
    selesai();
});
 

function selesai() {
    setTimeout(function() {
        jumlah();
        selesai();
        pesan();
    }, 200);
}


function jumlah() {
    $.getJSON("data.php", function(datas) {
        $("#notif").html(datas.jumlah);
    });
}



function pesan() {
    $.getJSON("data_pesan.php", function(data) {
        $("#pesan").empty();
        var no = 1;
        $.each(data.result, function() {
            $("#pesan").append(`<a id="pesan" class="dropdown-item" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-envelope-fill" viewBox="0 0 16 16">
            <path fill-rule="evenodd" d="M.05 3.555A2 2 0 0 1 2 2h12a2 2 0 0 1 1.95 1.555L8 8.414.05 3.555zM0 4.697v7.104l5.803-3.558L0 4.697zM6.761 8.83l-6.57 4.027A2 2 0 0 0 2 14h12a2 2 0 0 0 1.808-1.144l-6.57-4.027L8 9.586l-1.239-.757zm3.436-.586L16 11.801V4.697l-5.803 3.546z"/>
            </svg>&nbsp;`+this['pesan'].substr(0, 20)+`...</a>`);
        });
    });
}