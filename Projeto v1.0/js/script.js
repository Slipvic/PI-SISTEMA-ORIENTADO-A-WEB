//VALIDAÇÕES DE DADOS 
function validar(){
    let login = document.getElementById('email').value;
    let password = document.getElementById('password').value;
    
  }

    function logar(){



          if(login == "admin" && password == "123"){
            alert("Sucesso!")
            location.href= "index.html"
          }
          else alert("Incorreto!")
    }

    //PARTE CRUD 
const Cadastros = {
        user: [
            {
           id: 1,
           username: 'admin',
           senha: '123',
           sexo: 'masculino'
       }
    ]
   };

   //CREATE
function criaUser(nome, passoword, sex){
Cadastros.user.push({  
       id: Cadastros.user.length + 1,
       username: nome.username, 
       senha: senha.passoword, 
       sexo: sex.sexo
       });
   }
   
   //READ
   function getUser(){
   return Cadastros.user;
   }

   //UPDATE
   function updateUser(idf){
   const identifi = selectedUser().find((user) =>{return user.id === idf})
   }
   //DELETE
   function deleteUser(idf){
   
   }