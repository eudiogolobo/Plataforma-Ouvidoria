      
/*------------------------------------------ FUNÇÕES LayoutStart  -----------------------------------------*/




/*------------------------------------------ INICIO ValidEmail -----------------------------------------*/
// funcao para validar email (vai ser utilizada no login e na criação de conta)
function validEmail(inputEmail)
{
    // modelo de como deve ser o email
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    // se o input for incompativel com o filtro retorna mensagem de erro
    // e remove a classe is-valid do input e da div de mensagem do input
    // e add a clase is-invalid no input e na div de mensagem do input
    if (!filter.test($('#'+inputEmail).val())) {

        showModalMesage('error', 'E-mail inválido', 'Por favor, insira um e-mail válido.','modal-create-account','email')
        $('#'+inputEmail).removeClass('is-valid')
        $('#validation-'+inputEmail).removeClass('is-valid')

        $('#'+inputEmail).addClass('is-invalid')
        $('#validation-'+inputEmail).addClass('is-invalid')
        $('#validation-'+inputEmail).html('Campo obrigatório.')


        return false
    }

    // se passar quer dizer q é válido
    // e remove a classe is-invalid do input e da div de mensagem do input
    // e add a clase is-valid no input e na div de mensagem do input
    $('#'+inputEmail).removeClass('is-invalid')
    $('#validation-'+inputEmail).removeClass('is-invalid')

    $('#validation-'+inputEmail).html('')

    $('#'+inputEmail).addClass('is-valid')
    $('#validation-'+inputEmail).addClass('is-valid')

    return
}
/*------------------------------------------ FIM ValidEmail -----------------------------------------*/




/*------------------------------------------ INICIO ShowModalMesage -----------------------------------------*/
// funcao para moldar e chamar meu modal de mensagens
function showModalMesage(typeModal, titleModal, htmlContent, modalTarget, nameInputFocus, redirectValue)
{
    // seleciono todos os modais
    var modals = $('.modal').each(function(){
    // fecho todos
    $(this).modal('hide')
    })
    
    // se o parametro typeModal for success coloco a classe btn-success no botao para deixar verde e coloco uma animação em html e css de sucesso
    if(typeModal == 'success') 
    {
    $('#body-modal-mesage').html('<div class="success-checkmark"><div class="check-icon"><span class="icon-line line-tip"></span><span class="icon-line line-long"></span><div class="icon-circle"></div><div class="icon-fix"></div></div></div><span style="margin-left: 1rem;">'+htmlContent+'</span></div>')
    $('#btn-ok-modal-mesage').addClass('btn btn-success')
    } 

    // se o parametro typeModal for error add a classe btn-danger no botao para deixar vermelho 
    if(typeModal == 'error')
    {
    $('#body-modal-mesage').html(htmlContent)
    $('#btn-ok-modal-mesage').addClass('btn btn-danger')
    $('#btn-ok-modal-mesage').attr('onclick', 'elementFocus("'+nameInputFocus+'")')
    

    }

    // passo o valor do parametro titleModal para o titulo do modal
    $('#modal-mesage-title').html(titleModal)


    // se houver valor no parametro modalTarget eu add o valor dele 
    // ao data-bs-target e add data-bs-toggle para abrir o modal quando clicarem em ok
    if(modalTarget != undefined)
    {
    $('#btn-ok-modal-mesage').attr('data-bs-target', '#'+modalTarget)
    $('#btn-ok-modal-mesage').attr('data-bs-toggle',"modal")
    }

    // abro o modal-mesage
    $('#modal-mesage').modal('show')


    // se houver valor ao redirectValue eu redireciono o usuario ao clicar no btn ok do modal-mesage
    if(redirectValue != undefined)
    {
    $('#btn-ok-modal-mesage').click(()=>{
        window.location.href = redirectValue
    })
    }

}



/*-------------------------------------- FIM ShowModalMesage ----------------------------------*/

/*------------------------------------------ INICIO ShowModalOptions -----------------------------------------*/
// funcao para moldar e chamar meu modal de opções
function ShowModalOptions(typeModal, titleModal, htmlContent, modalTargetOk, nameInputFocusOK,modalTargetCancel, nameInputFocusCancel, redirectValue)
{
    // seleciono todos os modais
    var modals = $('.modal').each(function(){
    // fecho um por um
    $(this).modal('hide')
    })
    
    // se o parametro typeModal for success coloco a classe btn-success no botao para deixar verde 
    if(typeModal == 'reenviarCodigo') 
    {
    $('#body-modal-options').html(htmlContent)
    
    $('#btn-ok-modal-options').addClass('reenviarCodigoVerificacao')
 
    $('#btn-cancel-modal-options').attr('onclick', 'elementFocus("'+nameInputFocusCancel+'")')

    } 

    // se o parametro typeModal for error add a classe btn-danger no botao para deixar vermelho 
    if(typeModal == 'error')
    {
    $('#body-modal-options').html(htmlContent)

    $('#btn-ok-modal-options').addClass('btn btn-danger')
    $('#btn-ok-modal-options').attr('onclick', 'elementFocus("'+nameInputFocusOK+'","normal")')

    $('#btn-cancel-modal-options').addClass('btn btn-danger')
    $('#btn-cancel-modal-options').attr('onclick', 'elementFocus("'+nameInputFocusCancel+'")')
    }

    // passo o valor do parametro titleModal para o titulo do modal
    $('#modal-options-title').html(titleModal)


    // se houver valor no parametro modalTargetOk eu add o valor dele 
    // ao data-bs-target e add data-bs-toggle para abrir o modal quando clicarem em ok
    if(modalTargetOk != undefined && modalTargetCancel != undefined )
    {
    $('#btn-ok-modal-options').attr('data-bs-target', '#'+modalTargetOk)
    $('#btn-ok-modal-options').attr('data-bs-toggle',"modal")

    $('#btn-cancel-modal-options').attr('data-bs-target', '#'+modalTargetCancel)
    $('#btn-cancel-modal-options').attr('data-bs-toggle',"modal")
    }

    // abro o modal-options
    $('#modal-options').modal('show')


    // se houver valor no parametro redirectValue eu redireciono o usuario ao clicar no btn ok do modal-options
    if(redirectValue != undefined)
    {
    $('#btn-ok-modal-options').click(()=>{
        window.location.href = redirectValue
    })
    }

}

/*-------------------------------------- FIM ShowModalOptions ----------------------------------*/





/*------------------------------------------ INICIO elementFocus -----------------------------------------*/
// função que vai ser atribuida no evento onclick ao btn do modal-mesage quando o typeModal for ERROR
// para focar no campo inválido 
function elementFocus(idInputFocus, type)
{
 setTimeout(()=>{
  if(type == 'normal')
    {
      $('#'+idInputFocus).focus()
    }else{
      $('#'+idInputFocus).focus()
      $('#'+idInputFocus).removeClass('is-valid')
      $('#'+idInputFocus).addClass('is-invalid')
    }
  
  
 }, 300)

}
/*------------------------------------------ FIM elementFocus -----------------------------------------*/




/*------------------------------------------ INICIO validField -----------------------------------------*/
//funcao para validar os campos do formulário
function validField(idField, personalizedName,modalId)
{
 // se o valor do campo com o id que foi passado for vazio 
 // ele chama o modal do type error e adddiciona as classes is-invalid no input 
 // e na div da mensagem em baixo do input dai retorna false
 if($('#'+idField+'').val() == '')
       {
         showModalMesage('error','Campo inválido', 'Campo obrigatório '+personalizedName+' em branco',modalId,idField); 
         $('#'+idField).removeClass('is-valid')
         $('#validation-'+idField).removeClass('is-valid')

         $('#'+idField).addClass('is-invalid')
         $('#validation-'+idField).addClass('is-invalid')
         $('#validation-'+idField).html('Campo obrigatório.')
         return false
       } else{

         // se o campo é diferente de vazio ele add a classe is-valid no input
         // e remove o text da div de mensagem em baixo do input, então retorna true 
         $('#'+idField).removeClass('is-invalid')
         $('#validation-'+idField).removeClass('is-invalid')

         $('#validation-'+idField).html('')

         $('#'+idField).addClass('is-valid')
         $('#validation-'+idField).addClass('is-valid')
     
           return true
       }
}
/*------------------------------------------ FIM validField -----------------------------------------*/




/*------------------------------------------ INICIO validNameComplet -----------------------------------------*/
// validar nome completo
function validNameComplet()
{
 
 var nameVal = $('#name').val()         // recebe o valor do input name
 if(nameVal.split(" ").length > 1) {  // transforma em array sepadaras do espaço em branco, se der mais que uma entra no if
                                     // se der menor q uma cai no else e mostra o erro de nome incompleto
var contadorNome = nameVal.split(" ")[1]  // recebe o valor do segundo item do array

var cont = contadorNome.length // passa a quantidade de letras desse item

   if (cont == 1){  // se for igual a um quer dizer que ainda n está completo 
     showModalMesage('error','Nome Incompleto', 'Por favor, digite seu nome completo.','modal-create-account','name');
       return false;
   }
   if (cont > 1){ // se for maior que 1 passa como se fosse completo Ex: Maria Ana
       return true;
   }
}
showModalMesage('error','Nome Incompleto', 'Por favor, digite seu nome completo.','modal-create-account','name');
return false;

}
/*------------------------------------------ FIM validNameComplet -----------------------------------------*/




/*------------------------------------------ INICIO validatorModalCreateAccount -----------------------------------------*/
// funcao para validar o modal-account-create e ir para o próximo modal de criação de senha
function validatorModalCreateAccount()
  {
   

       // chama a função validFiel para ver se o campo está em branco -> retorno boll
       if(validField('name','nome','modal-create-account') == false || validNameComplet() == false ||validField('date-birth','data de nascimento','modal-create-account') == false || validField('telephone','telefone','modal-create-account') == false || validField('whatsapp','whatsapp','modal-create-account') == false || validField('email','e-mail','modal-create-account') == false || validEmail('email','modal-create-account') == false || validField('fu', 'UF','modal-create-account') == false || validField('city', 'cidade','modal-create-account') == false)
       {
         return false
       }


       /*---------------------------- INICIO validação maior de idade --------------------------------------*/

           //pego o valor do input date
           dt = $('#date-birth').val();

           //transformo em array separando cada indice pela barra, inverto e junto tudo de novo devolvendo a barra
           dt = dt.split('/').reverse().join('/');

           // atribuo o valor do objeto Date numa variaval
           dob = new Date(dt);

           // pedo a data de hoje
           var today = new Date();

           // calculo a idade diminuindo a data de hoje menos a data que o usuario digitou dai
           // o retorno vem em milissegundo, em seguida divido pela quantidade de milissegundo de um ano 
           // e obtenho essa divisão do menor numero inteiro usando o Floor
           var idade = Math.floor((today-dob) / (365.29 * 24 * 60 * 60 * 1000));

           // se a idade for menos que 18 retorna o erro
           if(idade < 18)
           {
           showModalMesage('error','Menor de idade', 'Para você se cadastrar, deve ter no mínimo 18 anos.','modal-create-account','date-birth');
           return false
           }
            /*---------------------------- FIM validação maior de idade --------------------------------------*/
       
        return true
   }

   /*------------------------------------------ FIM validatorModalCreateAccount -----------------------------------------*/