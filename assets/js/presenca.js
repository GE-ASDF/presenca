const frequencyForm = document.querySelector("#frequency-form");
const mensagem = document.querySelector(".mensagem");
console.log(frequencyForm);
window.onload = function(e){
    frequencyForm.onsubmit = function(e){
        e.preventDefault();
        let dados = new FormData(frequencyForm);
    
        xmlHttpPost("cadastrar.php", function(){
            beforeSend(function(){
                mensagem.innerHTML = `<span class="d-flex flex-column alert alert-primary"> Aguarde... </span>`
            })
            success(function(){
                let response = xhttp.responseText;
                if(response == 1){
                    mensagem.innerHTML = `<span class="d-flex flex-column alert alert-success"> 
                    Sucesso! A sua presença foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso.
                    </span>`
                    document.getElementById("CodigoContrato").value = '';
                    document.getElementById("CodigoContrato").focus();
                    setTimeout(() => {
                        mensagem.innerHTML = '';
                    }, 5000);
                }
                if(response == 2){
                    mensagem.innerHTML = `<span class="d-flex flex-column alert alert-primary">
                    Falha! Houve erros na hora de marcar a sua presença. Verifique os seguintes parêmetros:
                    <ul class=''>
                    <li> Se você digitou o usuário corretamente; </li>
                    <li> Se você marcou os horários nas caixinhas abaixo do usuário. </li>
                    </ul>
                    </span>`
                    document.getElementById("CodigoContrato").focus();
                }
                if(response == 3){
                    mensagem.innerHTML = `<span class="d-flex flex-column alert alert-primary">A sua presença já foi confirmada e você já pode começar a sua aula. Minimize o navegador e bom curso. </span>`
                    document.getElementById("CodigoContrato").value = '';
                    document.getElementById("CodigoContrato").focus();
                    setTimeout(() => {
                        mensagem.innerHTML = '';
                    }, 5000);
                }
                
            })
            
        }, dados)
    }
}