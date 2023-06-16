//VALIDAÇÕES DE DADOS 
function validar() {
    let login = document.getElementById('email').value;
    let password = document.getElementById('password').value;
  
  }
  
  //LOGIN NO SISTEMA
  function logar() {
    const emailInput = document.querySelector('#email');
    const passwordInput = document.querySelector('#password');
    const email = emailInput.value.trim();
    const password = passwordInput.value.trim();
  
    // Verifica se os campos foram preenchidos
    if (!email || !password) {
      alert('Por favor, preencha todos os campos.');
      return false;
    }
  
    // Verifica se o e-mail possui um formato válido
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailPattern.test(email)) {
      alert('Por favor, digite um e-mail válido.');
      return false;
    }
  
    // Se chegou até aqui, os campos estão preenchidos corretamente
    alert('Validação concluida!');
    return true;
  }
  
  //PARTE CRUD 
  const Cadastros = {
    user: [
      {
        id: 1,
        username: 'admin',
        email: 'ronaldinho2011@hotmail.com',
        senha: '123',
        sexo: 'masculino'
      }
    ]
  }
  function criaUser(nome, email, senha, sexo) {
    Cadastros.user.push({
      id: Cadastros.user.length + 1,
      username: nome,
      email: email,
      senha: senha,
      sexo: sexo
    });
  }
  
  //READ
  function listaUsuarios() {
    return Cadastros.user;
  }
  
  //UPDATE
  function atualizaUser(id, nome, email, senha, sexo) {
    const usuario = Cadastros.user.find(u => u.id === id);
    if (usuario) {
      usuario.username = nome;
      usuario.email = email;
      usuario.senha = senha;
      usuario.sexo = sexo;
    }
    //DELETE
    function removeUser(id) {
      const index = Cadastros.user.findIndex(u => u.id === id);
      if (index !== -1) {
        Cadastros.user.splice(index, 1);
      }
    }
  
  }
  //Api busca cep
  function meuCadastroDeEndereco() {
    var nomeAnterior = "";
  
    $("#cep").blur(function () {
      var cep = $(this).val().replace(/\D/g, '');
      if (cep != "") {
        var url = "https://viacep.com.br/ws/" + cep + "/json/";
        $.getJSON(url, function (data) {
          if (!("erro" in data)) {
            nomeAnterior = $("#nome").val();
            $("#nome").val(nomeAnterior);
            $("#logradouro").val(data.logradouro);
            $("#bairro").val(data.bairro);
            $("#cidade").val(data.localidade);
            $("#estado").val(data.uf);
            $("#faturamento").val(data.faturamento);
            $("#entrega").val(data.entrega);
          }
        });
      }
    });
  
    $("#cadastro").submit(function () {
      alert("Cadastro realizado com sucesso!");
      return false;
    });
  }
  
  function validarCPF() {
    var cpf = document.getElementById("CPF").value;
    cpf = cpf.replace(/[^\d]+/g, ''); // Remove caracteres não numéricos
  
    if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
      // Verifica se o CPF tem 11 dígitos e se não é uma sequência repetida
      document.getElementById("resultado").innerHTML = "CPF inválido.";
    } else {
      // Calcula os dígitos verificadores do CPF
      var soma = 0;
      for (var i = 0; i < 9; i++) {
        soma += parseInt(cpf.charAt(i)) * (10 - i);
      }
      var resto = (soma * 10) % 11;
      if (resto === 10 || resto === 11) resto = 0;
  
      if (resto !== parseInt(cpf.charAt(9))) {
        document.getElementById("resultado").innerHTML = "CPF inválido.";
      } else {
        soma = 0;
        for (var i = 0; i < 10; i++) {
          soma += parseInt(cpf.charAt(i)) * (11 - i);
        }
        resto = (soma * 10) % 11;
        if (resto === 10 || resto === 11) resto = 0;
  
        if (resto !== parseInt(cpf.charAt(10))) {
          document.getElementById("resultado").innerHTML = "CPF inválido.";
        } else {
          document.getElementById("resultado").innerHTML = "CPF válido.";
        }
      }
    }
  }
  