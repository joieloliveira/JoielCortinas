function cortina(cortina){
    
    var alt = parseFloat(document.getElementById('altura').value);
    var lag = parseFloat(document.querySelector('#largura').value);
    var tel = document.getElementById('tel');
    //var alt = $('#ltura').val();
    resltOrcamento = document.querySelector('#resltOrcamento');
    var aviso = document.getElementById('aviso')
    var cortina = cortina;
    var radioTecido=radioButtonTecido();
    var radioBlackout=radioButtonBlackout();
    var verificaErro=verificaErroCortina();
    if((verificaErro!=false)&&(radioBlackout!=false)&&(radioTecido!=false)){
        $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortina, radioTecido:radioTecido, radioBlackout:radioBlackout},function(retorno){
            resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
            tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
        });
    }else{alert('Preencha corretamento todos os dados, não use virgula para separar os numeros use um ponto. Escolha com blackout ou sem blackout, escolha o tecido');} 
}//-----------------------------------------------------------------

function radioButtonTecido(){
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
    
}//-----------------------------------------------------------------

function verificaErroCortina(){
    alt = document.getElementById('altura').value;
    lag = document.querySelector('#largura').value;
    altura=alt;
    largura=lag;
    alt=alt*alt;
    lag=lag*lag;
    if(altura>2.7){
        aviso.textContent = 'Presado cliente para a confecção de uma cortina acima de 2,70 de altura solicite um orçamento personalizado, entrando em contato pelo numero(zap): (91)-98936-2851. Falar com Joiel.';
        return false;
    }else if(largura=="" || altura=="" || largura==0 || altura==0){
        return false;
    }else if(!alt || !lag){
        return false;
    }else{return true;}

}//-----------------------------------------------------------------