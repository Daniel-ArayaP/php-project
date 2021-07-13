@extends('layouts.entorno') 
@section('content')

<div class="panel panel-primary" id="outArea">
    <div class="panel-heading">
    <div class="pull-right">
            <a class="pull-right" href="{{route('entornoColaborativo')}}"><i class="fa fa-arrow-circle-left" style="font-size:20px;color:#8DC63F"><span style="font-size:20px;color:#58666e;padding-left:6px;font-family:inherit">Regresar</span></i></a>
    </div>
        <h4>Correo Outlook</h4>
        <h5>{{ $username }}</h5>
    </div>
    <div class="panel-body">
        <div class="scrollable-area">
            <?php if (isset($messages)) { ?>
            <table class="table table-hover">
                <thead>
                    <tr>

                        <th>
                            <h4>Titulo</h4>
                        </th>
                        <th>
                            <h4>Origen</h4>
                        </th>
                        <th>
                            <h4>Fecha de Enviado</h4>
                        </th>
                        <th>
                            <h4>Ver</h4>
                        </th>
                        <th>
                            <h4>Eliminar</h4>
                        </th>

                    </tr>
                </thead>
                <tbody>
                    <?php foreach($messages as $message) { ?>
                    <tr>
                        <td>
                            <?php echo $message->getSubject() ?>
                        </td>
                        <td>
                            <?php echo $message->getFrom()->getEmailAddress()->getName() ?>
                        </td>
                        <td>
                            <?php echo $message->getReceivedDateTime()->format(DATE_RFC2822) ?>
                        </td>
                        <td>
                        <a href='{{ $message->getWebLink() }}' ><i class="far fa-eye"  style="font-size:30px;color:#34495E"></i></a><!--<i class="fas fa-eye fa-3x"></i></a>--> 
                        </td>
                        <td>
                  
                        <a onclick="deleteMail('{{ $message->getId() }}')" ><i class="fas fa-trash-alt fa-3x" style="font-size:30px;color:#34495E"></i></a>
                        </td>
                        <?php  }?>
                </tbody>
            </table>
            <?php  
                }else{   
                ?>
            <div class="alert alert-danger alertDismissible">
                <h2>NO EXISTEN CORREOS PARA MOSTRAR</h2>
            </div>
            <?php } ?>
        </div>
    </div>
    @if(isset($messages)) {{ $messages->render() }} @endif
</div>
<script>
function deleteMail(id_mail){
$.ajax({
        url: "{{ route('deleteMail')}}",
        data: "id_mail="+id_mail+"&_token={{ csrf_token()}}",
        dataType: "json",
        method: "POST",
        success: function(result)
        {
           alert(result.msg);
           location.reload(true);
        },
        fail: function(){
        },
        beforeSend: function(){
            var opcion = confirm("“¿Esta seguro que desea Eliminar?”");
            if (opcion == true) {
               return true;
            } else {
                return false;
            }
        }
    });
}
</script>
@endsection