function cortina(cortina){
    
    var alt = parseFloat(document.getElementById('altura').value);
    var lag = parseFloat(document.querySelector('#largura').value);
    var tel = document.getElementById('tel');
    var resltOrcamento = document.querySelector('#resltOrcamento');
    var aviso = document.getElementById('aviso');

    var cortinaEscolhida = cortina;
    if (cortinaEscolhida=="americana"||cortinaEscolhida=="ilhoes"){
        var radioTecido=radioButtonTecido();
        var radioBlackout=radioButtonBlackout();
        var verificaErro=verificaErroCortina();
        if((verificaErro!=false)&&(radioBlackout!=false)&&(radioTecido!=false)){
            $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida, radioTecido:radioTecido, radioBlackout:radioBlackout},function(retorno){
                resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
            });
        }else{alert('Preencha corretamento todos os dados, não use virgula para separar os numeros use um ponto. Escolha com blackout ou sem blackout, escolha o tecido');} 
    }else if(cortinaEscolhida=="verticalPvc"||cortinaEscolhida=="verticalTecido"||cortinaEscolhida=="horizontal"){
        var verificaErro=verificaErroCortina();
        if(verificaErro!=false){
            $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida},function(retorno){
                resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
            });
        }else{alert('Preencha corretamento todos os dados, não use virgula para separar os numeros use um ponto. Escolha com blackout ou sem blackout, escolha o tecido');} 
    }else if(cortinaEscolhida=="rolo"){
        var radioRolo=radioButtonRolo();
        var verificaErro=verificaErroCortina();
        if(verificaErro!=false&&radioRolo!=false){
            $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida, radioRolo:radioRolo},function(retorno){
                resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
            });
        }else{alert('Preencha corretamento todos os dados, não use virgula para separar os numeros use um ponto. Escolha com blackout ou sem blackout, escolha o tecido');} 
    }

}//-----------------------------------------------------------------

function radioButtonRolo(){
    if (document.getElementById('bk').checked == true) {
        return document.getElementById('bk').value;
    }else if(document.getElementById('tela').checked == true){
        return document.getElementById('tela').value;
    }else{return false;}
    
}//-----------------------------------------------------------------

function radioButtonTecido(){
    if (document.getElementById('voal').checked == true) {
        return document.getElementById('voal').value;
    }else if(document.getElementById('linho').checked == true){
        return document.getElementById('linho').value;
    }else{return false;}
}//-----------------------------------------------------------------

function radioButtonBlackout(){
    if (document.getElementById('blackout').checked == true) {
        return document.getElementById('blackout').value;
    }else if(document.getElementById('microfibra').checked == true){
        return document.getElementById('microfibra').value;
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