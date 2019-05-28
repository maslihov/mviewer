$(document).ready(function(){
    $('div.image-bar img').css('display', 'inline');
    $ol = $('ol.breadcrumb li').last().addClass('active');
    $nt = $ol.children('a').text();
    $ol.text($nt);
    
    $col_img = $('div.image-bar img').length;
    $('img').click(function(event) {
        $img = $(this);
        $myModal = $('#modal-imgs');
        $myModal.modal('show');
        $myModal.find('img').attr('src', $img.attr('src'));
        $myModal.find('img').attr('alt', $img.attr('alt'));
        $myModal.find('img').attr('id', $img.attr('id'));
    });
    
    $('#modal-imgs img').click(function(event) {
        $img = $(this);
        $id = $img.attr('id');
        $id++;
        if($id == $col_img) $id = 0;
        $next_img = $('div.image-bar img[id='+$id+']');
        console.log($id);
        $myModal.find('img').attr('src', $next_img.attr('src'));
        $myModal.find('img').attr('alt', $next_img.attr('alt'));
        $myModal.find('img').attr('id', $next_img.attr('id'));
    });
    
    $('div.exit').click(function(){
        $('body').html('<h1 class="exit">Можно закрыть окно</h1>');
        $pid = $(this).attr('pid');
        $.ajax({
            url:"kill.php?pid="+$pid,
        });
        setTimeout('window.close', 1000);
    });

    var newDate = new Date();
    newDate.setDate(newDate.getDate());

    setInterval( function() {
            var seconds = new Date().getSeconds();
            $("#sec").html(( seconds < 10 ? "0" : "" ) + seconds);
    },1000);

    setInterval( function() {
            var minutes = new Date().getMinutes();
            $("#min").html(( minutes < 10 ? "0" : "" ) + minutes);
    },1000);

    setInterval( function() {
            var hours = new Date().getHours();
            $("#hours").html(( hours < 10 ? "0" : "" ) + hours);
    }, 1000);
    $('div.clock').css('display', 'inline');
    
});
