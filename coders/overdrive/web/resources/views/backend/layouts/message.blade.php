@if ($message = Session::get('success'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'success',
        customClass: {
            confirmButton: 'btn btn-primary',
        }
    })
</script>
@endif

@if ($message = Session::get('error'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'error'
    })
</script>
@endif

@if ($message = Session::get('warning'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'warning'
    })
</script>
@endif

@if ($message = Session::get('info'))
<script type="text/javascript">
    swal({
        title: '{!! $message !!}',
        icon: 'info'
    })
</script>
@endif