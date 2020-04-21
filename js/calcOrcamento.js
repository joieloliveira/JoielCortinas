function cortina(cortina){
    
    var alt = document.getElementById('altura').value;
    var lag = document.querySelector('#largura').value;
    var tel = document.getElementById('tel');
    var resltOrcamento = document.querySelector('#resltOrcamento');
    var aviso = document.getElementById('aviso');
    var forro = document.getElementById('forro');
    var tecido = document.getElementById('tecido');
    var tecidoRolo = document.getElementById('tecidoRolo');
    //verifica se digitou virgula
    //var lag = lag.replace(/,/g,"."); forma global.
    largura=lag*lag;
    if(!largura){
        var lag = lag.replace(",",".");
        parseFloat(lag);
    }
    altura=alt*alt;
    if(!altura){
        var alt = alt.replace(",",".");
        parseFloat(alt);
    }


    var cortinaEscolhida = cortina;
    //prega americana
    if (cortinaEscolhida=="americana"){
        var radioTecido=radioButtonTecido();
        var verificaErro=verificaErroCortina();
            if(alt<=2.7){aviso.innerHTML = '<h6>Neste espaço vc pode simular um orçamento.</h6>';}

            if(alt>2.7){aviso.innerHTML = '<h6 class="text-danger" >Presado cliente para a confecção de uma cortina acima de 2,70 de altura solicite um orçamento personalizado, entrando em contato pelo numero(zap): (91)-98936-2851. Falar com Joiel.</h6>';
            
            }else if((verificaErro!=false)&&(radioTecido!=false)){
                $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida, radioTecido:radioTecido},function(retorno){
                    resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                    tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
                });
            }else if(radioTecido==false){tecido.innerHTML = '<h6 class="text-danger">Escolha o tecido</h6>';

            }else{alert('Preencha altura e largura.');}
    //ilhoes
    }else if (cortinaEscolhida=="ilhoes"){
        var radioTecido=radioButtonTecido();
        var radioBlackout=radioButtonBlackout();
        var verificaErro=verificaErroCortina();
            if(alt<=2.7){aviso.innerHTML = '<h6>Neste espaço vc pode simular um orçamento.</h6>';}

            if(alt>2.7){aviso.innerHTML = '<h6 class="text-danger" >Presado cliente para a confecção de uma cortina acima de 2,70 de altura solicite um orçamento personalizado, entrando em contato pelo numero(zap): (91)-98936-2851. Falar com Joiel.</h6>';
            
            }else if((verificaErro!=false)&&(radioBlackout!=false)&&(radioTecido!=false)){
                $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida, radioTecido:radioTecido, radioBlackout:radioBlackout},function(retorno){
                    resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                    tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
                });
             
            }else if(radioBlackout==false){forro.innerHTML = '<h6 class="text-danger">Escolha o forro</h6>';

            }else if(radioTecido==false){tecido.innerHTML = '<h6 class="text-danger">Escolha o tecido</h6>';

            }else{alert('Preencha altura e largura.');}
    //persianas
    }else if(cortinaEscolhida=="verticalPvc"||cortinaEscolhida=="verticalTecido"||cortinaEscolhida=="horizontal"){
        var verificaErro=verificaErroCortina();

        if(lag<=3){
            let hLag = document.getElementById('hLag');
            hLag.innerHTML = '<label>Largura:</label>';
        }
        if(alt<=3){
            let hAlt = document.getElementById('hAlt');
            hAlt.innerHTML = '<label>Altura:</label>';
        }              
        if(lag>3){
            let hLag = document.getElementById('hLag');
            hLag.innerHTML = '<h6 class="text-danger">Largura: menor igual a 3</h6>';
        }
        if(alt>3){
            let hAlt = document.getElementById('hAlt');
            hAlt.innerHTML = '<h6 class="text-danger">Altura: menor igual a 3</h6>';
        }

        if(verificaErro!=false&&alt<=3&&lag<=3){
            $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida},function(retorno){
                resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
            });
        }else if(verificaErro==false){alert('Preencha altura e largura.');}
    //rolô
    }else if(cortinaEscolhida=="rolo"){
        var radioRolo=radioButtonRolo();
        var verificaErro=verificaErroCortina();

        if(lag<=3){
            let hLag = document.getElementById('hLag');
            hLag.innerHTML = '<label>Largura:</label>';
        }
        if(alt<=3){
            let hAlt = document.getElementById('hAlt');
            hAlt.innerHTML = '<label>Altura:</label>';
        }              
        if(lag>2){
            let hLag = document.getElementById('hLag');
            hLag.innerHTML = '<h6 class="text-danger">Largura: menor igual a 2</h6>';
        }
        if(alt>3){
            let hAlt = document.getElementById('hAlt');
            hAlt.innerHTML = '<h6 class="text-danger">Altura: menor igual a 3</h6>';
        }

        if(verificaErro!=false&&radioRolo!=false&&alt<=3&&lag<=2){
            $.post('php/db_joielCortinas.php',{altura:alt, largura:lag, cortina:cortinaEscolhida, radioRolo:radioRolo},function(retorno){
                resltOrcamento.textContent = parseFloat(retorno).toFixed(2)+' R$';       
                tel.textContent = 'Entre em contato pelo telefone (91)9-8936-2851.';
            });
        }else if(radioRolo==false){tecidoRolo.innerHTML = '<h6 class="text-danger">Escolha: Blackout filtra 99% do sol, ou Tela Solar filtra 65% do sol.</h6>';

        }else if(verificaErro==false){alert('Preencha altura e largura.');}
    }

}//-----------------------------------------------------------------

function radioButtonRolo(){
    var tecidoRolo = document.getElementById('tecidoRolo');
    if (document.getElementById('bk').checked == true) {
        tecidoRolo.innerHTML = '<h6>Escolha: Blackout filtra 99% do sol, ou Tela Solar filtra 65% do sol.</h6>';
        return document.getElementById('bk').value;
    }else if(document.getElementById('tela').checked == true){
        tecidoRolo.innerHTML = '<h6>Escolha: Blackout filtra 99% do sol, ou Tela Solar filtra 65% do sol.</h6>';
        return document.getElementById('tela').value;
    }else{return false;}
    
}//-----------------------------------------------------------------

function radioButtonTecido(){
    var tecido = document.getElementById('tecido');
    if (document.getElementById('voal').checked == true) {
        tecido.innerHTML = '<h6>Escolha o tecido</h6>';
        return document.getElementById('voal').value;
    }else if(document.getElementById('linho').checked == true){
        tecido.innerHTML = '<h6>Escolha o tecido</h6>';
        return document.getElementById('linho').value;
    }else{return false;}
}//-----------------------------------------------------------------

function radioButtonBlackout(){
    var forro = document.getElementById('forro');
    if (document.getElementById('blackout').checked == true) {
        forro.innerHTML = '<h6>Escolha o forro</h6>';
        return document.getElementById('blackout').value;
    }else if(document.getElementById('microfibra').checked == true){
        forro.innerHTML = '<h6>Escolha o forro</h6>';
        return document.getElementById('microfibra').value;
    }else{return false;}
    
}//-----------------------------------------------------------------

function verificaErroCortina(){
    var alt = document.getElementById('altura').value;
    var lag = document.querySelector('#largura').value;
    if(lag=="" || alt=="" || lag==0 || alt==0){
        return false;
    }else{return true;}

}//-----------------------------------------------------------------