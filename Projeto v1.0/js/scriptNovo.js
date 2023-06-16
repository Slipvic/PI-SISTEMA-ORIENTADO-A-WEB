function validarCPF() {
  var cpf = document.getElementById("cpf").value;
  cpf = cpf.replace(/[^\d]+/g, ""); // Remove caracteres não numéricos

  if (cpf.length !== 11 || /^(\d)\1+$/.test(cpf)) {
    // Verifica se o CPF tem 11 dígitos e se não é uma sequência de dígitos repetidos
    document.getElementById("cpf").setCustomValidity("CPF inválido");
  } else {
    var sum = 0;
    var remainder;

    for (var i = 1; i <= 9; i++) {
      sum = sum + parseInt(cpf.substring(i - 1, i)) * (11 - i);
    }

    remainder = (sum * 10) % 11;

    if (remainder === 10 || remainder === 11) {
      remainder = 0;
    }

    if (remainder !== parseInt(cpf.substring(9, 10))) {
      document.getElementById("cpf").setCustomValidity("CPF inválido");
    }

    sum = 0;

    for (i = 1; i <= 10; i++) {
      sum = sum + parseInt(cpf.substring(i - 1, i)) * (12 - i);
    }

    remainder = (sum * 10) % 11;

    if (remainder === 10 || remainder === 11) {
      remainder = 0;
    }

    if (remainder !== parseInt(cpf.substring(10, 11))) {
      document.getElementById("cpf").setCustomValidity("CPF inválido");
    } else {
      document.getElementById("cpf").setCustomValidity(""); // CPF válido
    }
  }
}
