$(document).ready(function(){
    $('#docente_today_tab').click(function(){
        $('#docente_previous_tab').removeClass('active')
        $('#docente_previous_container').addClass('d-none')
        $('#docente_incoming_tab').removeClass('active')
        $('#docente_incoming_container').addClass('d-none')
        $(this).addClass('active')
        $('#docente_today_container').removeClass('d-none')
    })
    $('#docente_previous_tab').click(function(){
        $('#docente_today_tab').removeClass('active')
        $('#docente_today_container').addClass('d-none')
        $('#docente_incoming_tab').removeClass('active')
        $('#docente_incoming_container').addClass('d-none')
        $(this).addClass('active')
        $('#docente_previous_container').removeClass('d-none')
    })
    $('#docente_incoming_tab').click(function(){
        $('#docente_today_tab').removeClass('active')
        $('#docente_today_container').addClass('d-none')
        $('#docente_previous_tab').removeClass('active')
        $('#docente_previous_container').addClass('d-none')
        $(this).addClass('active')
        $('#docente_incoming_container').removeClass('d-none')
    })

    $("#evidencias_input").click(function(){
        var $fileUpload = $("input[type='file']");
        if (parseInt($fileUpload.get(0).files.length)>2){
            
        }
    })
})