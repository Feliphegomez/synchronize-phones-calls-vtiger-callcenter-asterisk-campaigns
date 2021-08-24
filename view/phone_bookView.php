<?php require_once 'includes/header.php'; ?>
		<div class="col-lg-12">
			<h3>
				Phone Book 
				<?php if(isset($_GET['start']) && $_GET['start'] == 'true') echo ' - please wait...'; ?>
			</h3>
			<hr/>
		</div>
		<section class="col-md-4">
			<table class="table table-hover">
				<tr>
					<th>Contacts</th>
					<td><?= $contactaddress_count; ?></td>
					<td>
						<?php if(isset($_GET['start']) && $_GET['start'] == 'true' && $module == 'Contacts'): ?>
							<a href="<?= $helper->url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}"; ?>" class="btn btn-xs btn-danger">
								Stop
							</a>
						<?php else: ?>
							<a href="<?= $helper->url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}&start=true&module=Contacts"; ?>" class="btn btn-xs btn-primary">
								Start
							</a>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th>Leads</th>
					<td><?= $leadaddress_count; ?></td>
					<td>
						<?php if(isset($_GET['start']) && $_GET['start'] == 'true' && $module == 'Leads'): ?>
							<a href="<?= $helper->url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}"; ?>" class="btn btn-xs btn-danger">
								Stop
							</a>
						<?php else: ?>
							<a href="<?= $helper->url("PhoneBook","index")."&vcampaign={$_GET['vcampaign']}&campaign={$_GET['campaign']}&start=true&module=Leads"; ?>" class="btn btn-xs btn-primary">
								Start
							</a>
						<?php endif; ?>
					</td>
				</tr>
				<tr>
					<th>In Campaign</th>
					<td colspan="2"><?= $campaign->phone_book; ?></td>
				</tr>
			</table>
			<a href="<?= $helper->url("vCampaign","index"); ?>" class="btn btn-sm btn-default">
				Return
			</a>
		</section>
		<section class="col-md-8">
			<div class="responsive">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Phone</th>
							<th>In Book</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach($phone_book as $phone): ?>
							<tr>
								<td><?= $phone->phone; ?></td>
								<td>
								<?= ($phone->isValid() ? "&#10003;" : "&#215;"); ?>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
        </section>
        <?php require_once 'includes/footer.php'; ?>