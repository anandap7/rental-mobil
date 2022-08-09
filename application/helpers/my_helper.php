<?php

function show_modal($content = '', $id = '', $data = '')
{
	$_ci = &get_instance();

	if($content != '') {
		return
		'<div class="modal fade" id="'. $id .'">
			<div class="modal-dialog">
				<div class="modal-content">
					'. $_ci->load->view($content, $data, TRUE) .'
				</div>
			</div>
		</div>';
	}
}

function show_confirm($class = '') {
	if($class != '') {
		return
		'<div class="modal fade" id="confirmation">
			<div class="modal-dialog">
				<div class="modal-content">
					<div class="modal-body text-center">
						<h5>Konfimasi penghapusan data</h5>
						<div class="row mt-4">
							<div class="col-6">
								<button class="form-control btn btn-primary '. $class .'"><i class="fa fa-ok"></i> Ya, hapus data ini</button>
							</div>
							<div class="col-6">
								<button class="form-control btn btn-danger" data-dismiss="modal"><i class="fa fa-remove"></i> Batal</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>';
	}
}

function show_form_msg($content = '') {
	if($content != '') {
		return
		'<div class="alert alert-danger" role="alert">
			'. $content .'
		</div>';
	}
}
