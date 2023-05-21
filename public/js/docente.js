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


    $('#review_function_submit_approbed').click(() => {
        $('#frm_observaciones').attr('required', false)
        $('#input_state').val(3)
        $('#form_review_function').trigger( "submit" )
    })

    $('#review_function_submit_rejected').click(() => {
        $('#frm_observaciones').attr('required', true)
        $('#input_state').val(4)
        var reportValidity = form[0].reportValidity()
        if(reportValidity){
            $('#form_review_function').trigger( "submit" )
        }
    })


})