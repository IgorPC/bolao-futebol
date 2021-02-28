function submitForm(form)
{
    form.addEventListener('submit', function(event){
        event.preventDefault();
        var result = confirm("Tem certeza que deseja finalizar concluir o bolão?");
        if(result){
            checkInputs.forEach(countGamble)
            const finalGamble = document.querySelector('#resp_gamble');
            finalGamble.value = JSON.stringify(gamble);

            let nome = document.querySelector('#nome');
            const finalName = document.querySelector('#resp_name');
            finalName.value = nome.value;

            let valor = document.querySelector('#valor');
            const finalValue = document.querySelector('#resp_value');
            finalValue.value = valor.value;

            console.log({
                name: finalName.value,
                value: finalValue.value,
                gamble: finalGamble.value
            })
            //formSubmit.submit()
        }
    });
}

function countGamble(value)
{
    if(value.checked){
        let gamb = value.value.split('-');
        if(gamble[gamb[0]] != ''){
            gamble[gamb[0]] += `, ${gamb[1]}`
            }else{
                gamble[gamb[0]] = gamb[1]
            }
        }
}

function verifyProgress(value)
{
    value.addEventListener("click", function(input) {
        let value = '';
        if(!input.toElement.checked){
            input.toElement.removeAttribute('checked')
            value = '-1';  
        }else{
            input.toElement.setAttribute('checked', '')
            value = '1';
        }
        updateProgress(value, input)
    });
}

let ver = []
let restDb;

function updateProgress(action, input)
{
    let game = input.toElement.value.split('-');
    let actual = game[0];
    let splitted = input.toElement.value.split('-');

    if(ver[splitted[0]] == "" || ver[splitted[0]] == undefined){
        ver[splitted[0]] = 1
    }else{
        if(action == '-1'){
            ver[splitted[0]] -= 1
        }
        if(action == '1'){
            ver[splitted[0]] += 1
        }
    }

    if(action == '-1'){
        if(ver[splitted[0]] == 0){
            list[actual-1] = false
            let total = 33/3;
            if(count <= 0 ){
                count = 1
            }
            let now = count -= 1;
            let value = 100*now/total
            if(value > 100){
                value = 100;
            }
            setProgress(value)
        }
    }
    if(action == '1'){
        if(list[actual-1] == false){
            list[actual-1] = true
            let total = 33/3;
            let now = count += 1;
            let value = 100*now/total
            if(value > 100){
                value = 100;
            }
            setProgress(value)
        }
    }
}

function setProgress(int)
{
    let string = `width: ${int}%`;
    progress.setAttribute("style", string);
    if(int == 100){
        ableButtom(valid)
        confirmBtn.removeAttribute("hidden"); 
    }
}

function watchNameAndValue(valid)
{
    nome.addEventListener('input', function(e){
        let inputNome = nome.value.length
        if(inputNome >= 4){
            valid.nome = true;
        }else{
            valid.nome = false;
        }
        ableButtom(valid)
    });

    valor.addEventListener('input', function(e){
        if(valor.value != 0){
            let splitted = limiter[valor.value].split(',');
            doubleInput.innerHTML = splitted[0];
            dbTag = splitted[0];
            tripleInput.innerHTML = splitted[1];
            valid.valor = true;
        }else{
            valid.valor = false;
        }
        ableButtom(valid)
    });
}

//let ver = []
function ableButtom(valid)
{
    if(valid.nome == true && valid.valor == true){
        confirmBtn.classList.remove("btn-primary");
        confirmBtn.classList.add("btn-success");
        progress.classList.add('bg-success')
        confirmBtn.removeAttribute("disabled"); 
    }else{
        progress.classList.remove("bg-success");
        confirmBtn.setAttribute("disabled", ''); 
        confirmBtn.classList.remove("btn-success");
        confirmBtn.classList.add("btn-primary");
    }
}