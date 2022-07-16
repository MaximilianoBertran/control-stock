<div id="divErrorJs" class="alert alert-danger alert-dismissible" role="alert" style="display:none;">
        <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">×</span></button>
        <strong>Error:</strong> Corrija los errores que figuran debajo para continuar
        <ul id="ulErrors">
        </ul>
</div>

<script type="text/javascript">
    function showJsErrors(errors){
    
    var strErrors = '';
    
    errors.forEach(function(entry) {
        strErrors += '<li>';
        strErrors += entry;
        strErrors += '</li>';
    });
    
    $('#ulErrors').html(strErrors);
    $('#divErrorJs').show();
    
}
</script>