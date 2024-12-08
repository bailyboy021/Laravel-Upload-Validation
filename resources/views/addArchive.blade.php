<div class="row">
	<div class="col-md-12">	
		{!! Form::model($model,[
			'route' => 'store',
			'method' => 'POST',
			'files' => true,
			'id' => 'request_form'
		]) !!}	
			<div class="form-group row mb-2">
				<div class="col-md-2">
					<label class="control-label">File</label>
				</div>
				<div class="col-md-10">
					<input type="file" id="file" name="file" class="form-control col-md-12" data-max-file-size="50M">
				</div>
			</div>
			<div class="form-group row mb-2">
				<div class="col-md-2">
					<label class="control-label">Remark</label>
				</div>
				<div class="col-md-10">
					<textarea rows="5" name="remark" id="remark" class="form-control col-md-12" placeholder="Remark"></textarea>
				</div>
			</div>
			<div id='loadingmessage' class="col-md-12 mt-2 text-center" style="display: none;">
				<img src="{{ asset('images/spinner-mini.gif') }}"/> Please wait
			</div>
			<div class="text-right d-flex justify-content-end">
				<button type="submit" class="btn btn-primary btn-sm" id="submit_btn">CREATE</button>
			</div>
		{!! Form::close() !!}
	</div>
</div>
<script type="text/javascript">
$(document).ready(function() {
    $('#request_form').on('submit', function(e) {
        e.preventDefault();

        var form = $('#request_form'),
            url = form.attr('action'),
            modalAdd = bootstrap.Modal.getInstance(document.getElementById('modal_add'));

        form.find('.invalid-feedback').remove();
        form.find('.form-control').removeClass('is-invalid');
        $('#loadingmessage').show();
        $("#submit_btn").hide();

        $.ajax({
            url: url,
            method: "POST",
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData: false,
            success: function(returnData) {
                Swal.fire({
                    icon: 'success',
                    title: 'Success',
                    // text: 'Data has been successfully submitted!',
                    allowOutsideClick: false
                }).then(function() {
                    modalAdd.hide();
                    $('#data-file').DataTable().ajax.reload(); // Reload DataTable
                });

                $('#loadingmessage').hide();
                $("#submit_btn").show();
            },
            error: function(xhr) {
                var res = xhr.responseJSON;
                if ($.isEmptyObject(res) == false) {
                    $.each(res.errors, function(key, value) {
                        $('#' + key).closest('.form-control').addClass('is-invalid');
                    });
                }

                $('#loadingmessage').hide();
                $("#submit_btn").show();
            }
        });
    });
});
</script>
