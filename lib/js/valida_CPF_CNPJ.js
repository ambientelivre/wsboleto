/*Função que valida CNPJ*/
function ValidaCNPJ(cnpj,elem) {
    cnpj = cnpj.replace(/[^\d]+/g,'');
    if (cnpj.length < 8){
    
    alert('O CNPJ informado '+cnpj+' deve conter 8 ou 14 digitos');

    elem.value="";
    return false;
}
    tamanho = cnpj.length - 2
    numeros = cnpj.substring(0,tamanho);
    digitos = cnpj.substring(tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(0)){
        alert('O CNPJ informado '+cnpj+' é invalido.');
        elem.value="";
        return false;
    }
    tamanho = tamanho + 1;
    numeros = cnpj.substring(0,tamanho);
    soma = 0;
    pos = tamanho - 7;
    for (i = tamanho; i >= 1; i--) {
      soma += numeros.charAt(tamanho - i) * pos--;
      if (pos < 2)
            pos = 9;
    }
    resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
    if (resultado != digitos.charAt(1)){
          alert('O CNPJ informado '+cnpj+' é invalido.');
          elem.value="";
          return false;
    }
    return true;
}

/*Função que valida CPF*/
function ValidaCPF (cpf, elem) {
cpf=cpf.replace(/[^\d]+/g,'');
if (cpf.length != 11 
   || cpf == "00000000000" 
   || cpf == "11111111111" 
   || cpf == "22222222222" 
   || cpf == "33333333333" 
   || cpf == "44444444444" 
   || cpf == "55555555555"  
   || cpf == "66666666666" 
   || cpf == "77777777777" 
   || cpf == "88888888888" 
   || cpf == "99999999999"){
alert('O CPF informado é invalido.');
elem.value="";
return false;
}
add = 0;
for (i=0; i < 9; i ++)
add += parseInt(cpf.charAt(i)) * (10 - i);
rev = 11 - (add % 11);
if (rev == 10 || rev == 11)
rev = 0;
if (rev != parseInt(cpf.charAt(9))){
alert('O CPF informado é invalido.'.cpf);
elem.value="";
return false;
}
add = 0;
for (i = 0; i < 10; i ++)
add += parseInt(cpf.charAt(i)) * (11 - i);
rev = 11 - (add % 11);
if (rev == 10 || rev == 11)
rev = 0;
if (rev != parseInt(cpf.charAt(10))){
alert('O CPF informado é invalido.'.cpf);
elem.value="";
return false;
}
return true;
}
