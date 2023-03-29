<?php

  if(isset($_POST['submit']))
  {
    //print_r($_POST['nome']);
    //print_r($_POST['email']);
    //print_r($_POST['telefone']);

   
   include_once('config.php');

    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $cep = $_POST['cep'];
    $rua = $_POST['rua'];
    $bairro = $_POST['bairro'];
    $cidade = $_POST['cidade'];
    $estado = $_POST['estado'];

    $result = mysqli_query($conexao, "INSERT INTO usuarios(nome,email,cep,rua,bairro,cidade,estado) Values ('$nome','$email','$cep','$rua','$bairro','$cidade','$estado')");
  }
?>

<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="https://th.bing.com/th/id/R.1126652cbfaeaa72f70cce57432a5e90?rik=B6zan%2bvi42F5Uw&riu=http%3a%2f%2fgeoceramica.com.br%2fwp-content%2fuploads%2f2022%2f06%2fIng%c3%a1_Azul_litoraneo_ambiente-1500-%c3%97-1500-px-768x768.jpg&ehk=C4yRidcRBO8q4wPWSI1Re2VIG%2bIwbwAjz%2bp8iH2ehW8%3d&risl=&pid=ImgRaw&r=0" type="image/x-icon">
    <title>Cadastro Luz Ingá</title>

    <link rel="stylesheet" href="styles.css"> 
    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600;700;900&display=swap" rel="stylesheet">

</head>
<body>
        <div class="container">
        <div class="header">
            <h1>&#x1F4CB CADASTRO:<h1></h1>
            <h2>Criar Uma Conta</h2>
      </div>

      <form action="formulario.php" name="form" method="POST" id="form" class="form">
        <div class="form-control">
          <label for="username">Nome de usuário</label>
          <input
            type="text"
            name="nome"
            id="username"
            placeholder="Digite seu nome de usuário..."
          />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="email">Email</label>
          <input type="text" 
          id="email" 
          name="email" 
          placeholder="Digite seu email.." />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="password">Senha</label>
          <input
            type="password"
            id="password"
            placeholder="Digite sua senha..."
          />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="password-confirmation">Confirmação de senha</label>
          <input
            type="password"
            id="password-confirmation"
            placeholder="Digite sua senha novamente..."
          />
          <i class="fas fa-exclamation-circle"></i>
          <i class="fas fa-check-circle"></i>
          <small>Mensagem de erro</small>
        </div>

        <div class="form-control">
          <label for="cep">Cep:</label>
          <input name="cep" type="text" id="cep" value=""  size="10" maxlength="9"
                 onblur="pesquisacep(this.value);" placeholder="Digite o Cep..."  />
                 <i class="fas fa-exclamation-circle"></i>
                 <i class="fas fa-check-circle"></i>
                 <small>Mensagem de erro</small><br>
          <label>Rua:
          <input name="rua" type="text" id="rua" size="60"  placeholder="Digite a rua..."/></label><br />
            <label>Bairro:
            <input name="bairro" type="text" id="bairro" size="40"  placeholder="Digite o bairro..."/></label><br />
          <label>Cidade:
          <input name="cidade" type="text" id="cidade" size="40"  placeholder="Digite a cidade..."/></label><br />
          <label>Estado:
          <input name="estado" type="text" id="estado" size="10"  placeholder="Digite o Estado..."/></label><br />
          
      </div>
      <button><input type="submit" name="submit" id="submit"></button>

    <script
      src="https://kit.fontawesome.com/f9e19193d6.js"
      crossorigin="anonymous"
    ></script>

    <script src="./scripts.js"></script>


    <script>
    
      function limpa_formulário_cep() {
              //Limpa valores do formulário de cep.
              document.getElementById('rua').value=("");
              document.getElementById('bairro').value=("");
              document.getElementById('cidade').value=("");
              document.getElementById('estado').value=("");
      }
  
      function meu_callback(conteudo) {
          if (!("erro" in conteudo)) {
              //Atualiza os campos com os valores.
              document.getElementById('rua').value=(conteudo.logradouro);
              document.getElementById('bairro').value=(conteudo.bairro);
              document.getElementById('cidade').value=(conteudo.localidade);
              document.getElementById('estado').value=(conteudo.estado);
              
          } //end if.
          else {
              //CEP não Encontrado.
              limpa_formulário_cep();
              alert("CEP não encontrado.");
          }
      }
          
      function pesquisacep(valor) {
  
          //Nova variável "cep" somente com dígitos.
          var cep = valor.replace(/\D/g, '');
  
          //Verifica se campo cep possui valor informado.
          if (cep != "") {
  
              //Expressão regular para validar o CEP.
              var validacep = /^[0-9]{8}$/;
  
              //Valida o formato do CEP.
              if(validacep.test(cep)) {
  
                  //Preenche os campos com "..." enquanto consulta webservice.
                  document.getElementById('rua').value="...";
                  document.getElementById('bairro').value="...";
                  document.getElementById('cidade').value="...";
                  document.getElementById('estado').value="...";
  
                  //Cria um elemento javascript.
                  var script = document.createElement('script');
  
                  //Sincroniza com o callback.
                  script.src = 'https://viacep.com.br/ws/'+ cep + '/json/?callback=meu_callback';
  
                  //Insere script no documento e carrega o conteúdo.
                  document.body.appendChild(script);
  
              } //end if.
              else {
                  //cep é inválido.
                  limpa_formulário_cep();
                  alert("Formato de CEP inválido.");
              }
          } //end if.
          else {
              //cep sem valor, limpa formulário.
              limpa_formulário_cep();
          }
      };
      (function(){ 
 
 const cep = document.querySelector("input[name=cep]");

 cep.addEventListener('blur', e=> {
      const value = cep.value.replace(/[^0-9]+/, '');
      const url = `https://viacep.com.br/ws/${value}/json/`;

    fetch(url)
   .then( response => response.json())
   .then( json => {
          
      
    
   });
});

})();

  </script>
  </body>
</html>