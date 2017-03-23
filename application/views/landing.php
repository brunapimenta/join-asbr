<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Compre já | ActualSales</title>
  <script src="https://code.jquery.com/jquery-2.1.4.js"></script>

  <!-- SEMANTIC UI -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.css">
  <script src="https://cdn.jsdelivr.net/semantic-ui/2.2.9/semantic.min.js"></script>

  <!-- CALENDAR -->
  <link rel="stylesheet" href="css/calendar.min.css">
  <script type="text/javascript" src="js/calendar.min.js"></script>

  <!-- MÁSCARA JQUERY -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.min.js"></script>
</head>
<body>
  <div class="ui container">
    <h1 class="ui header">
      <img src="img/logo.png" class="ui image">
      <div class="content">
        Produtos
        <div class="sub header">Confira nossos lançamentos</div>
      </div>
    </h1>

    <div class="ten wide column">
      <div class="ui three top attached steps">
        <div class="active step">
          <i class="user icon"></i>
          <div class="content">
            <div class="title">Dados Pessoais</div>
            <div class="description">Preencha seus dados para receber contato</div>
          </div>
        </div>
        <div class="disabled step">
          <i class="marker icon"></i>
          <div class="content">
            <div class="title">Localização</div>
            <div class="description">Informe a unidade mais próxima de você</div>
          </div>
        </div>
        <div class="disabled step">
          <i class="send icon"></i>
          <div class="content">
            <div class="title">Enviar</div>
            <div class="description">Confirmação da solicitação de contato</div>
          </div>
        </div>
      </div>

      <div class="ui attached segment">
        <form id="step_1" class="ui form form-step">
          <div class="two fields">
            <div class="field">
              <label>Nome Completo</label>
              <input type="text" name="nome" id="nome" maxlength="75" required="required">
            </div>

            <div class="field">
              <label>Data de Nascimento</label>
              <div class="ui calendar" id="dataNascimento">
                <div class="ui input">
                  <input type="text" name="dataNascimento" required="required" readonly="readonly">
                </div>
              </div>
            </div>
          </div>

          <div class="two fields">
            <div class="field">
              <label>E-mail</label>
              <input type="email" name="email" maxlength="75" required="required">
            </div>

            <div class="field">
              <label>Telefone</label>
              <input type="text" name="telefone" id="telefone" maxlength="14" required="required">
            </div>
          </div>

          <button type="button" id="proximo" class="ui primary  button">Próximo</button>
        </form>

        <form id="step_2" class="ui form form-step" style="display:none">
          <div class="two fields">
            <div class="field">
              <label>Região</label>
              <select name="regiao" required="required">
                <option value="">Selecione</option>
                <option>Sul</option>
                <option>Sudeste</option>
                <option>Centro-Oeste</option>
                <option>Nordeste</option>
                <option>Norte</option>
              </select>
            </div>

            <div class="field">
              <label>Unidade</label>
              <select name="unidade" required="required">
                <option value="">Selecione uma região</option>
              </select>
            </div>
          </div>

          <button type="button" id="anterior" class="ui button">Anterior</button>
          <button type="button" id="enviar" class="ui primary button">Enviar</button>
        </form>

        <div id="step_sucesso" class="ui success message step-message" style="display:none">
          <div class="header">
            Obrigado pelo cadastro!
          </div>
          <p>Em breve você receberá uma ligação com mais informações.</p>
        </div>

        <div id="step_erro" class="ui error message step-message" style="display:none">
          <div class="header">
            Oops! Ocorreu um erro!
          </div>
          <span id="complemento"></span>
          <p>Para tentar novamente <a href="#" id="recomecar">clique aqui</a>. Caso o erro persista, tente novamente mais tarde.</p>
        </div>
      </div>
    </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#step_1').form({
        inline: true,
        fields: {
          nome: {
            identifier: 'nome',
            rules: [
              {
                type: 'regExp',
                value: /([a-zA-Z]+\s)+[a-zA-Z]+/i,
                prompt : 'Por favor, informe o seu nome completo'
              }
            ]
          },
          dataNascimento: {
            identifier: 'dataNascimento',
            rules: [
              {
                type: 'empty',
                prompt : 'Por favor, informe uma data de nascimento'
              }
            ]
          },
          email: {
            identifier: 'email',
            rules: [
              {
                type: 'email',
                prompt: 'Por favor, informe um e-mail válido'
              }
            ]
          },
          telefone: {
            identifier: 'telefone',
            rules: [
              {
                type   : 'empty',
                prompt : 'Por favor, informe seu telefone'
              }
            ]
          }
        }
      });

      $('#step_2').form({
        inline: true,
        fields: {
          regiao: {
            identifier: 'regiao',
            rules: [
              {
                type: 'empty',
                prompt: 'Por favor, informe a sua região'
              }
            ]
          },
          unidade: {
            identifier: 'unidade',
            rules: [
              {
                type   : 'empty',
                prompt : 'Por favor, informe a unidade mais próxima'
              }
            ]
          }
        }
      });

      $('#dataNascimento').calendar({
        monthFirst: false,
        type: 'date',
        maxDate: new Date('2016-11-02'),
        formatter: {
          date: function (date, settings) {
            if (!date) return '';
            var day = date.getDate();
            var month = date.getMonth() + 1;
            var year = date.getFullYear();
            return day + '/' + month + '/' + year;
          }
        },
        text: {
          days: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S'],
          months: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
          monthsShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
          today: 'Hoje',
          now: 'Agora',
          am: 'AM',
          pm: 'PM'
        }
      });

      $('#nome').mask('A', {
        translation: {'A': {pattern: /^[A-Za-z\u00E0-\u00FC\s]+$/, recursive: true}},
        reverse: true,
        maxlength: false
      });

      $('#telefone').mask(mascaraTelefone, {
        onKeyPress: function(val, e, field, options) {
          field.mask(mascaraTelefone.apply({}, arguments), options);
        }
      });

      $('select[name="regiao"]').off('change').on('change', function() {
        carregarUnidades($(this).val());
      });

      $('#anterior').off('click').on('click', function () {
        $('.step').eq(0).removeClass('completed').addClass('active');
        $('.step').eq(1).removeClass('active').addClass('disabled');
        $(this).parents('.form-step').hide().prev().show();
      });

      $('#proximo').off('click').on('click', function() {
        if ($('#step_1').form('is valid')) {
          $('.step').eq(0).removeClass('active').addClass('completed');
          $('.step').eq(1).removeClass('disabled').addClass('active');
          $(this).parents('.form-step').hide().next().show();
        } else {
          $('#step_1').form('validate form');
        }
      });

      $('#enviar').off('click').on('click', function () {
        if ($('#step_2').form('is valid')) {
          $('.step').eq(1).removeClass('active').addClass('completed');
          $('.step').eq(2).removeClass('disabled').addClass('active');
          salvarVisitante();
        } else {
          $('#step_2').form('validate form');
        }
      });

      $('#recomecar').off('click').on('click', function() {
        $('.step').eq(0).removeClass('completed').addClass('active');
        $('.step').eq(1).removeClass('completed').addClass('disabled');
        $('.step').eq(2).removeClass('active').addClass('disabled');
        $('.step-message').hide();
        $('.step-message').find('#complemento').html('');
        $('.form-step').form('clear');
        $('#step_1').show();
      });
    });

    var unidades = {
      'sul': ['Porto Alegre', 'Curitiba'],
      'sudeste': ['São Paulo', 'Rio de Janeiro', 'Belo Horizonte'],
      'centro-oeste': ['Brasília'],
      'nordeste': ['Salvador', 'Recife'],
      'norte': ['Não possui disponibilidade']
    };

    function mascaraTelefone(valor) {
      return valor.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
    }

    function carregarUnidades(regiao) {
      var regiao = regiao.toLowerCase().trim();
      var selectUnidade = $('select[name="unidade"]');

      if (regiao != '') {
        var opcaoInicial = regiao != 'norte' ? '<option value="">Selecione</option>' : '';
        selectUnidade.html(opcaoInicial);
        $.each(unidades[regiao], function(index, unidade) {
          var valor = regiao != 'norte' ? unidade : 'INDISPONÍVEL';
          selectUnidade.append('<option value="' + valor + '">' + unidade + '</option>');
        });
      } else {
        selectUnidade.html('<option value="">Selecione uma região</option>');
      }
    }

    function salvarVisitante() {
      $.ajax({
        url: <?php echo json_encode(base_url('index.php/landing/visitante')); ?>,
        type: 'post',
        dataType: 'json',
        data: $('.form-step').serialize()
      })
      .done(function(visitante) {
        $('.form-step').hide();
        $('#step_sucesso').show();

        enviarLead(visitante);
      })
      .fail(function(retorno) {
        $('.form-step').hide();
        $('#step_erro').find('#complemento').html(retorno.responseJSON);
        $('#step_erro').show();
      });
    }

    function enviarLead(visitante) {
      $.ajax({
        url: 'http://api.actualsales.com.br/join-asbr/ti/lead',
        type: 'post',
        dataType: 'json',
        data: {
          nome: visitante.nome,
          email: visitante.email,
          telefone: visitante.telefone,
          regiao: visitante.regiao,
          unidade: visitante.unidade,
          data_nascimento: visitante.dataNascimento,
          score: visitante.score,
          token: visitante.token
        },
        async: false
      })
      .done(function() {
        salvarLead(visitante.idVisitante, visitante.score, 1);
      })
      .fail(function() {
        salvarLead(visitante.idVisitante, visitante.score, 0);
      });
    }

    function salvarLead(idVisitante, pontuacao, enviado) {
      $.ajax({
        url: <?php echo json_encode(base_url('index.php/landing/lead')); ?>,
        type: 'post',
        dataType: 'json',
        data: {idVisitante: idVisitante, pontuacao: pontuacao, enviado: enviado},
        async: false
      })
      .done(function() {
        console.log("success");
      })
      .fail(function() {
        console.log("error");
      });
    }
  </script>
</body>
</html>
