<?php require_once 'includes/header.php'; ?>
		<div class="col-lg-12">
			<h3>Campaigns CallCenter</h3>
			<hr/>
		</div>
		<section class="col-lg-12">
			<div class="responsive" style="min-height:400px;overflow-y:auto;">
				<table class="table table-hover">
					<thead>
						<th>ID</th>
						<th>Cod</th>
						<th>Name</th>
						<th>Campaigns CallCenter</th>
						<th>Total phones in book</th>
						<th>Status Auto-Dialer</th>
						<th>Actions</th>
					</thead>
					<tbody>
						<?php foreach($campaigns_v as $campaign): ?>
						<tr>
							<td><?= $campaign->campaignid; ?></td>
							<td><?= $campaign->campaign_no; ?></td>
							<td><?= $campaign->campaignname; ?></td>
							<!--//
							<td><?= $campaign->campaignstatus; ?></td>
							<td><?= $campaign->campaigntype; ?></td>
							<td><?= $campaign->expectedrevenue; ?></td>
							<td><?= $campaign->budgetcost; ?></td>
							<td><?= $campaign->actualcost; ?></td>
							<td><?= $campaign->expectedresponse; ?></td>
							<td><?= $campaign->product_id; ?></td>
							<td><?= $campaign->numsent; ?></td>
							<td><?= $campaign->sponsor; ?></td>
							<td><?= $campaign->targetaudience; ?></td>
							<td><?= $campaign->targetsize; ?></td>
							<td><?= $campaign->expectedresponsecount; ?></td>
							<td><?= $campaign->expectedsalescount; ?></td>
							<td><?= $campaign->expectedroi; ?></td>
							<td><?= $campaign->actualresponsecount; ?></td>
							<td><?= $campaign->actualsalescount; ?></td>
							<td><?= $campaign->actualroi; ?></td>
							<td><?= $campaign->closingdate; ?></td>
							<td><?= $campaign->tags; ?></td>
							-->
							<td>
								<?= ($campaign->campaign_callcenter->isValid()) ? "[{$campaign->campaign_callcenter->id}] {$campaign->campaign_callcenter->name}" : ""; ?>
							</td>
							<td>
								<?= ($campaign->campaign_callcenter->isValid()) ? $campaign->campaign_callcenter->phone_book : 0; ?>
							</td>
							<td>
								<?php if($campaign->campaign_callcenter->isValid()): ?>
									<?= ($campaign->campaign_callcenter->estatus == 'A' ? 'Active' : ($campaign->campaign_callcenter->estatus == 'T' ? 'Finish' : 'Inactive')); ?>
									
								<?php endif; ?>
								
							</td>
							<td>
								<?php if($campaign->campaign_callcenter->isValid()): ?>
									<a href="<?= $helper->url("PhoneBook","index")."&vcampaign={$campaign->campaignid}&campaign={$campaign->campaign_callcenter->id}"; ?>" class="btn bt-xs btn-success">
										Synchronize phone book
									</a>
									<a href="<?= $helper->url("Campaign","active")."&campaign={$campaign->campaign_callcenter->id}&estatus=".($campaign->campaign_callcenter->estatus == 'A' ? 'I' : 'A'); ?>" class="btn bt-xs btn-info">
										<?= ($campaign->campaign_callcenter->estatus == 'A' ? 'Inactive' : 'Active'); ?>
									</a>
									<a href="<?= $helper->url("Campaign","editar")."&campaign={$campaign->campaign_callcenter->id}&vcampaign={$campaign->campaignid}"; ?>" class="btn bt-xs btn-info">
										Edit
									</a>
								<?php else: ?>
									<a class="btn bt-xs btn-success" href="<?= $helper->url("Campaign","nuevo"); ?>&vcampaign=<?= $campaign->campaignid; ?>">
									Create
									</a>
								<?php endif; ?>
							</td>
						</tr>
						<?php endforeach; ?>
					</tbody>
				</table>
			</div>
        </section>
        <?php require_once 'includes/footer.php'; ?>