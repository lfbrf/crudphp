<?php
// Include config file
require_once 'config.php';
 
// Define variables and initialize with empty values
$name = $street =  $username =  $cep = $complement =   $city = $state =   $neighborhood =  $house_number =  $bairro = $comercial_phone = $fix_phone = $mobile_phone = "";
$name_err = $address_err = $street_err  = $age_err =  $city_err =   $state_err = $complement_err = $username_err =  $cep_err = $neighborhood_err = $house_number_err = $bairro_err = $comercial_phone_err = $fix_phone_err =  $mobile_phone_err = ""; 
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_username = trim($_POST["username"]);
    if(empty($input_username)){
        $username_err = "Por favor informe o nome de usuario.";
    } else{
        $username = $input_username;
    }
    $input_cep = trim($_POST["cep"]);
    if(empty($input_cep)){
        $cep_err = "Por favor informe o cep.";
    } else{
        $cep = $input_cep;
    }
    
    $input_street = trim($_POST["street"]);
    $street = $input_street;
    

     $input_house_number = trim($_POST["house_number"]);
    if(empty($input_house_number)){
        $house_number_err = "Por favor informe o numero da casa.";
    } else{
        $house_number = $input_house_number;
    }

      $input_mobile_phone = trim($_POST["mobile_phone"]);
    if(empty($input_mobile_phone)){
        $mobile_phone_err = "Por favor informe o numero da casa.";
    } else{
        $mobile_phone = $input_mobile_phone;
    }

    
    $input_neighborhood = trim($_POST["neighborhood"]);
    $neighborhood = $input_neighborhood;
    
    
    
     $input_city = trim($_POST["city"]);
        $city = $input_city;
    
     $input_state = trim($_POST["state"]);
        $state = $input_state;
    

  $input_complement = trim($_POST["complement"]);
  $complement = $input_complement;
     
  $fix_phone = trim($_POST["fix_phone"]);
  $comercial_phone = trim($_POST["comercial_phone"]);
  $mobile_phone = trim($_POST["mobile_phone"]);
  
    if (empty($comercial_phone))
        $comercial_phone = "Nao informado";
    if (empty($fix_phone))
        $fix_phone = "Nao informado";
    if (empty($complement))
        $complement = "Nao informado";
 
    
    // Check input errors before inserting in database
   
          // Prepare an insert statement
       if (!empty($username) && !empty($cep) && !empty($street)  && !empty($house_number)  && !empty($complement)  && !empty($neighborhood)  && !empty($city)  && !empty($state)  && !empty($comercial_phone)  && !empty($fix_phone)  && !empty($mobile_phone)){
        $sql = "INSERT INTO employees (username, cep, street, house_number, complement, neighborhood, city, state, comercial_phone, fix_phone, mobile_phone) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        if($stmt = $mysqli->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sssssssssss", $param_username, $param_cep, $param_street, $param_house_number, $param_complement, $param_neighborhood, $param_city, $param_state, $param_comercial_phone, $param_fix_phone, $param_mobile_phone);
            
            // Set parameters
            $param_username = $username;
            $param_cep = $cep;
            $param_street = $street;
            $param_house_number = $house_number;
            $param_complement = $complement;
            $param_neighborhood = $neighborhood;
            $param_city = $city;
            $param_state = $state;
            $param_comercial_phone = $comercial_phone;
            $param_fix_phone = $fix_phone;
            $param_mobile_phone = $mobile_phone;
            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Records created successfully. Redirect to landing page
                header("location: index.php");
                exit();
            } else{
                echo "Algo deu errrado.";
            }
        }
         
        // Close statement
         
        $stmt->close();
    
    }
     
 
    
    // Close connection
    $mysqli->close();
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Criar novo Usuario</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.css">
    <style type="text/css">
        .wrapper{
            width: 500px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
    <div class="wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Criar usuario</h2>
                    </div>
                    <p>Por favor preencha os campos abaixo.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                         <div class="form-group <?php echo (!empty($username_err)) ? 'has-error' : ''; ?>">
                            <label>Nome de usuario  *</label>
                            <input type="text" name="username" class="form-control" value="<?php echo $username; ?>">
                            <span class="help-block"><?php echo $username_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($cep_err)) ? 'has-error' : ''; ?>">
                            <label>CEP  *</label>
                            <input type="text" name="cep" id="cep" class="form-control" value="<?php echo $cep; ?>">
                            <span class="help-block"><?php echo $cep_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($street_err)) ? 'has-error' : ''; ?>">
                            <label>Rua</label>
                            <input type="text" onblur="cepComplements();" name="street" id="street" class="form-control" value="<?php echo $street; ?>">
                            <span class="help-block"><?php echo $street_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($house_number_err)) ? 'has-error' : ''; ?>">
                            <label>Numero da Casa  *</label>
                            <input type="text" name="house_number" class="form-control" value="<?php echo $house_number; ?>">
                            <span class="help-block"><?php echo $house_number_err;?></span>
                        </div>
                        <div class="form-group <?php echo (!empty($complement_err)) ? 'has-error' : ''; ?>">
                            <label>Complemento</label>
                            <input type="text" name="complement" class="form-control" value="<?php echo $complement; ?>">
                            <span class="help-block"><?php echo $complement_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($neighborhood_err)) ? 'has-error' : ''; ?>">
                            <label>Bairro</label>
                            <input type="text" name="neighborhood" id="neighborhood" class="form-control" value="<?php echo $neighborhood; ?>">
                            <span class="help-block"><?php echo $neighborhood_err;?></span>
                        
                        <div class="form-group <?php echo (!empty($city_err)) ? 'has-error' : ''; ?>">
                            <label>Cidade</label>
                            <input type="text" name="city" id="city" class="form-control" value="<?php echo $city; ?>">
                            <span class="help-block"><?php echo $city_err;?></span>
                        </div>
                         <div class="form-group <?php echo (!empty($state_err)) ? 'has-error' : ''; ?>">
                            <label>Estado</label>
                            <input type="text" name="state" id="state" class="form-control" value="<?php echo $state; ?>">
                            <span class="help-block"><?php echo $state_err;?></span>
                        </div>
                         
                       <div class="form-group <?php echo (!empty($comercial_phone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone comercial</label>
                            <input type="text" name="comercial_phone" id="comercial_phone" class="form-control" value="<?php echo $comercial_phone; ?>">
                            <span class="help-block"><?php echo $comercial_phone_err;?></span>
                        </div>
                          <div class="form-group <?php echo (!empty($fix_phone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone fixo</label>
                            <input type="text" name="fix_phone" id="fix_phone" class="form-control" value="<?php echo $fix_phone; ?>">
                            <span class="help-block"><?php echo $fix_phone_err;?></span>
                        </div>
                          <div class="form-group <?php echo (!empty($mobile_phone_err)) ? 'has-error' : ''; ?>">
                            <label>Telefone Celular  *</label>
                            <input type="text" name="mobile_phone" id="mobile_phone" class="form-control" value="<?php echo $mobile_phone; ?>">
                            <span class="help-block"><?php echo $mobile_phone_err;?></span>
                        </div>
                        <input type="submit" id="enviar" class="btn btn-primary" value="Cadastrar">
                        <a href="index.php" class="btn btn-default">Voltar</a>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>

 
 



    <!-- Adicionando JQuery -->
    <script src="//code.jquery.com/jquery-3.2.1.min.js"></script>

    <!-- Adicionando Javascript -->
    <script type="text/javascript" >

        $(document).ready(function() {

            function limpa_formulário_cep() {
                // Limpa valores do formulário de cep.
                $("#street").val("");
                $("#neighborhood").val("");
                $("#city").val("");
                $("#state").val("");
                $("#ibge").val("");
            }
            
            //Quando o campo cep perde o foco.
            $("#cep").blur(function() {

                //Nova variável "cep" somente com dígitos.
                var cep = $(this).val().replace(/\D/g, '');

                //Verifica se campo cep possui valor informado.
                if (cep != "") {

                    //Expressão regular para validar o CEP.
                    var validacep = /^[0-9]{8}$/;

                    //Valida o formato do CEP.
                    if(validacep.test(cep)) {

                        //Preenche os campos com "..." enquanto consulta webservice.
                        $("#street").val("Carregando, aguarde o preenchimento automatico...");
                        $("#neighborhood").val("Carregando, aguarde o preenchimento automatico...");
                        $("#city").val("Carregando, aguarde o preenchimento automatico...");
                        $("#state").val("Carregando, aguarde o preenchimento automatico...");
                        $("#ibge").val("Carregando, aguarde o preenchimento automatico...");

                        //Consulta o webservice viacep.com.br/
                        $.getJSON("//viacep.com.br/ws/"+ cep +"/json/?callback=?", function(dados) {

                            if (!("erro" in dados)) {
                                //Atualiza os campos com os valores da consulta.
                                $("#street").val(dados.logradouro);
                                $("#neighborhood").val(dados.bairro);
                                $("#city").val(dados.localidade);
                                $("#state").val(dados.uf);
                                $("#ibge").val(dados.ibge);
                            } //end if.
                            else {
                                //CEP pesquisado não foi encontrado.
                                limpa_formulário_cep();
                                alert("CEP não encontrado.");
                            }
                        });
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
            });
        });



    </script>