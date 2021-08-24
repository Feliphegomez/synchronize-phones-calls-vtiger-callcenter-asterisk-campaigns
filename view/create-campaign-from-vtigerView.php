<?php require_once 'includes/header.php'; ?>
		<div class="col-lg-12">
			<h3>Create Campaign to CallCenter</h3>
			<hr/>
		</div>
		<section class="col-lg-12">
			<div class="container">
				<form class="row g-3" action="<?= $helper->url("Campaign","crear"); ?>" method="post">
					<div class="col-md-8">
						<label for="name" class="form-label">Name</label>
						<input type="text" class="form-control" name="name" id="name" value="outgoing <?= $vcampaign_id; ?>" readonly="" required="" />
					</div>
					<div class="col-md-4">
						<label for="script" class="form-label">script</label>
						<input type="text" class="form-control" name="script" id="script" value="CV_<?= $vcampaign_id; ?>" readonly="" required="" />
					</div>
					<div class="col-md-6">
						<label for="datetime_init" class="form-label">Date Init</label>
						<input type="date" class="form-control" name="datetime_init" id="datetime_init" value="<?= date("Y-m-d"); ?>" required="" />
					</div>
					<div class="col-md-6">
						<label for="datetime_end" class="form-label">Date End</label>
						<input type="date" class="form-control" name="datetime_end" id="datetime_end" required="" />
					</div>
					<div class="col-md-6">
						<label for="daytime_init" class="form-label">Hour Init</label>
						<input type="time" class="form-control" name="daytime_init" id="daytime_init" value="<?= date("H:i"); ?>" required="" />
					</div>
					<div class="col-md-6">
						<label for="daytime_end" class="form-label">Hour End</label>
						<input type="time" class="form-control" name="daytime_end" id="daytime_end" required="" />
					</div>
					<div class="col-md-4">
						<label for="id_url" class="form-label">id_url</label>
						<select name="id_url" id="id_url" class="form-control" required="">
						  <option value="" selected>Choose...</option>
						  <?php foreach($external_urls as $uri): ?>
						  <option value="<?= $uri->id; ?>"><?= $uri->description; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4">
						<label for="form_id" class="form-label">Form</label>
						<select name="form_id" id="form_id" class="form-control" required="">
						  <option value="" selected>Choose...</option>
						  <?php foreach($forms as $form): ?>
						  <option value="<?= $form->id; ?>"><?= $form->nombre; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-4">
						<label for="trunk" class="form-label">trunk</label>
						<select name="trunk" id="trunk" class="form-control" required="">
						  <option value="" selected>Choose...</option>
						  <option value="NULL">dial plan</option>
						  <?php foreach($trunks as $trunk): ?>
						  <option><?= strtoupper("{$trunk->tech}")."/{$trunk->channelid}"; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="context" class="form-label">context</label>
						<input type="text" class="form-control" name="context" id="context" value="from-internal" required="" />
					</div>
					<div class="col-md-3">
						<label for="max_canales" class="form-label">max_canales</label>
						<input type="number" class="form-control" id="max_canales" name="max_canales" min="0" value="3" required="" />
					</div>
					<div class="col-md-3">
						<label for="queue" class="form-label">queue</label>
						<select name="queue" id="queue" class="form-control" required="">
						  <option value="" selected>Choose...</option>
						  <?php foreach($queues as $queue): ?>
						  <option value="<?= $queue->extension; ?>"><?= $queue->extension; ?> <?= $queue->descr; ?></option>
						  <?php endforeach; ?>
						</select>
					</div>
					<div class="col-md-3">
						<label for="retries" class="form-label">retries</label>
						<input type="number" class="form-control" name="retries" id="retries" value="5" min="1" required="" />
					</div>
					<div class="col-md-12">
						<a href="<?= $helper->url("vCampaign","index"); ?>" class="btn btn-secondary">Cancel</a>
						<button type="submit" class="btn btn-primary">Add</button>
					</div>
				</form>
			</div>
        </section>
        <?php require_once 'includes/footer.php'; ?>