<script src="./assets/js/main.js"></script>
<script src="./assets/js/xhttp.js"></script>
<script src="./assets/js/presenca.js"></script>
    <script>
        const form = document.querySelector("form")
                
        form.addEventListener("submit", (ev)=>{

            const inputHora = Array.from(document.querySelectorAll(".form-check-input:checked"));
            let Hora = '';
            let qtdHoras = inputHora.length;
            if(inputHora.length > 1){
                inputHora.forEach(i=>{
                    Hora += i.value + " ";
                })
            }else if(inputHora.length === 1){
                Hora = inputHora[0].value
            }else{
                ev.preventDefault();
                return alert("É necessário marcar o(s) horário(s) da presença")
            }
 
            if(CodigoContrato.value){

                let resposta = confirm("Deseja salvar os dados abaixo?\nCódigo do contrato: " + CodigoContrato.value + "\nData da presença: " + DataPresenca.value+"\nDia da semana: " + DiaSemana.value + "\nHora da presença: " + Hora +"\nQtd. hora(s) de aula: "+qtdHoras+"h\nSe não tiver certeza peça para seu educador(a) confirmar.")
                
                if(!resposta){
                    ev.preventDefault();
                }

            }else{
                ev.preventDefault();
                return alert("O campo de USUÁRIO é obrigatório.");
            }
        })
    </script>

</body>
</html>