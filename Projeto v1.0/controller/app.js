const Cadastros = {
     user: [{
        id: 1,
        username: 'admin',
        senha: '123',
        sexo: 'masculino'
    }]
}
//CREATE
function criaUser(nome, passowrd, sex){
Cadastros.user.push({  
    id: Cadastros.user.length + 1,
    username: nome, 
    senha: passowrd, 
    sexo: sex
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