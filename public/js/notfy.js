$('#recieve').on('click', e => {
    $('#send').removeClass('select')
    $('#recieve').addClass('select')
})
$('#send').on('click', e => {
    $('#send').addClass('select')
    $('#recieve').removeClass('select')
})

const recieve = () => {
    $.ajax({
        url: '/solicitacaoRecieve',
        method: 'post',
        dataType: 'json',
        success: response =>{
            console.log(response)
            $('.cardGroup').html('')
        recieveCreate(response)
        },
        erro: erro => {
            console.log(2)
            console.log(erro)
        }
    })
}

const send = () => {

    // console.log(1)

    $.ajax({
        
        url: '/solicitacaoSend',
        method: 'post',
        dataType: 'json',
        success: response =>{
            console.log(response)
            $('.cardGroup').html('')
            sendCreate(response)
        },
        erro: erro => {
            console.log(2)
            console.log(erro)
        }
    })
}

$('#openMenu').on('click', e => {
    $('.notificacao').toggleClass('OpenMenu')

    if($('.notificacao').hasClass('OpenMenu')){
        $('#openMenu').html('<i class="fa-solid fa-circle-xmark" style="font-size: 2.7rem; color: red;"></i>')
        recieve()
    }else{
        $('#openMenu').html('<i class="fa-solid fa-ellipsis-vertical"></i>')
    }
})