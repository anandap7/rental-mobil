<?php foreach ($owners as $key => $owner) { ?>
	<tr>
		<td><?= $key + 1 ?></td>
		<td><?= $owner->name ?></td>
		<td><?= $owner->username ?></td>
		<td class="text-center">
			<button class="btn btn-warning btn-sm edit-owner" data-id="<?= $owner->id ?>"><i class="fa fa-edit"></i> Update</button>
			<button class="btn btn-danger btn-sm konfirmasiHapus-owner" data-id="<?= $owner->user_id ?>" data-toggle="modal" data-target="#confirmation"><i class="fa fa-trash"></i> Delete</button>
		</td>
	</tr>
<?php } ?>
