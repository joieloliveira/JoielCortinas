function persiana(cortina){
    
    var alt = parseFloat(document.getElementById('altura').value);
    var lag = parseFloat(document.querySelector('#largura').value);
    var tel = document.getElementById('tel');
    //var alt = $('#ltura').val();
    resltOrcamento = document.querySelector('#resltOrcamento');
    //var aviso = document.getElementById('aviso')
    var cortina = cortina;
    //var radioTecido=radioButtonTecido();
    //var radioBlackout=radioButtonBlackout();
    var radioRolo=radioButtonRolo();
    var verificaErro=verificaErroCortina();
    if((verificaErro!=false)&&(radioRolo!=false)){
        $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortina, radioRolo:radioRolo},function(retorno){
            resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
            tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
        });
    }else{alert('Preencha corretamento todos os dados, não use virgula para separar os numeros use um ponto. Escolha com blackout ou sem blackout, escolha o tecido');} 
}//-----------------------------------------------------------------

function radioButtonRolo(){
    if (document.getElementById('bk').checked == true) {
        return document.getElementById('bk').value;
    }else if(document.getElementById('tela').checked == true){
        return document.getElementById('tela').value;
    }else{return false;}
    
}//-----------------------------------------------------------------

/*function radioButtonTecido(){
    if (document.getElementById('voal').checked == true) {
        return document.getElementById('voal').value;
    }else if(document.getElementById('linho').checked == true){
        return document.getElementById('linho').value;
    }else{return false;}
}//-----------------------------------------------------------------

function radioButtonBlackout(){
    if (document.getElementById('comBlackout').checked == true) {
        return document.getElementById('comBlackout').value;
    }else if(document.getElementById('semBlackout').checked == true){
        return document.getElementById('semBlackout').value;
    }else{return false;}
    
}//-----------------------------------------------------------------*/

function verificaErroCortina(){
    alt = document.getElementById('altura').value;
    lag = document.querySelector('#largura').value;
    altura=alt;
    largura=lag;
    alt=alt*alt;
    lag=lag*lag;
    if(largura=="" || altura=="" || largura==0 || altura==0){
        return false;
    }else if(!alt || !lag){
        return false;
    }else{return true;}

}//-----------------------------------------------------------------