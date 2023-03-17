//VALIDAÇÕES DE DADOS 
function validar(){
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
              function criaUser(nome,email, senha, sexo){
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
function confereSenha() {
    const senha = document.querySelector('input[name = senha]');
    const confirma = document.querySelector('input[name = confirma]');

    if (confirma.value === senha.value) {
        confirma.setCustomValidity('');

    } else {
        confirma.setCustomValidity('As senhas não conferem');
    }
    function senhaOK() {
        alert("Senhas conferem")
    }
}

