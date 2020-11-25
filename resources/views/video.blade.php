<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Vídeo</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="{{asset('css/style.css')}}">

</head>
<body>
    
    <div class="container" id="main">
        <h1>Envie seu vídeo</h1>

        <form id="form" enctype="multipart/form-data">
            @csrf
            {{-- NOME --}}
            <div class="form-group">
                <label for="nome">Nome</label>
                <select id="nome" class="custom-select" name="nome">
                    <option value="carlos">Carlos</option>
                    <option value="mozart">Mozart</option>
                </select>
            </div>
            
            {{-- ARQUIVO --}}
            <div class="custom-file">
                <input type="file" name="arquivo" required />
                {{-- <label class="custom-file-label input-label" for="customFile">Escolha o arquivo</label> --}}
            </div>
            <br/>
            <br/>
            <button type="submit" class="btn btn-primary" id="btn-enviar">Enviar</button>
        </form>

        <div id="enviando">
            <div id="enviando-conteudo">
                <p>Processando, aguarde</p>
                <div class="spinner-border" role="status">
                    <span class="sr-only">Enviando...</span>
                </div>
            </div>

            <div id="enviando-falha">
                <p>Desculpe nossos duendes estão sobrecarregados no momento</p>
            </div>

            <div id="enviando-sucesso">
                <p>Seu vídeo está pronto, clique aqui para visualizar</p>
                <span id="link-video"></span>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        $('#form').on('submit', function(e) {
            e.preventDefault();
            $('#enviando').show();
            $('#form').hide();      
            
            dados = new FormData($('#form').get(0));//seleciona classe form-horizontal adicionada na tag form do html
            
            $.ajax({
                url: '{{route('video.enviar')}}',
                type: "POST",
                data: dados,
                processData: false,
                contentType: false,
                success: function (retorno) {
                    $('#enviando-conteudo').hide();
                    
                    if (retorno.sucesso) {
                        $('#link-video').html(`<a href="{{route('video.baixar')}}/${retorno.video}" target="_blank" id="btn-baixar">Baixar</a>`);
                        $('#enviando-sucesso').show();
                    } else {
                        $('#enviando-falha').show();
                    }
                }
            });
        })
    </script>



</body>
</html>