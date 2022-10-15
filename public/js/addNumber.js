const addNumber = () => {
    $('.adicionarContato').toggleClass('onFocus')
    $('#codigoPais').toggleClass('onFocus')
    $('#codigoPais').on('change', e => {
        if($(e.target).val() != ""){
            $('#codigoEstado').toggleClass('onFocus')
            $('#codigoEstado').on('change', e => {
                if($(e.target).val() != ""){
                    $('#numero').removeClass('onFocus')
                    $('#addNumber').removeClass('onFocus')
                    $('#addNumber').addClass('desativado')
                    $('#numero').val('')
                    $('#numero').on('change', e=>{
                        if(e.target.value.toString().length>= 6){
                            $('#addNumber').removeClass('desativado')
                        }
                    })
                }
            })
        }
        
    })
    
    

    
}




const activeClass = item =>{
    if(item.value != ""){
        item.classList.add('ativado')
        item.classList.remove('desativado')
    }else{
        item.classList.add('desativado')
        item.classList.remove('ativado')
    }
}

$('#criarContato').submit(e => {
    e.preventDefault()
    if($('#numero').val().length >= 6){
        let ddi = $('#codigoPais').val()
        let ddd = $('#codigoEstado').val()
        let number = $('#numero').val()
        let telefone = $('#telefone').val()

        $.ajax({
            url: '/addContato',
            method: 'post',
            data: {ddi: ddi, ddd: ddd, telefone:number, telefoneUser: telefone},
        }).done((response) => {
            location.reload()
            // console.log(response)
        })

    }else{
        alert('Numero invalido')
    }

})