const MudarClassP = input => {
    $('.menuWhatsApp .menuConversas .conversasSearch p').addClass('border border-top-0 border-left-0 border-right-0 border-info')
       
    
    setTimeout(()=>{
        $('#search').removeClass('using')
        $('#back').addClass('using')  
    },200)

    $('#back').on('click', e => {
        $('#searchConversas').val('')
    })
}


const VoltarClassP = input => {
    $('.menuWhatsApp .menuConversas .conversasSearch p').removeClass()

    setTimeout(()=>{
        $('#search').addClass('using')
        $('#back').removeClass('using')  
    },200)

    $('#searchConversas').change(e => {
        location.href =`#${$('#searchConversas').val()}`
    })
    
}