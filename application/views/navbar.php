<div class="navbar navbar-fixed-top navbar-default" id="navbar" role="navigation">
	<div class="navbar-container" id="navbar-container">
		<div class="navbar-collapse collapse navbar-sr-collapse">

			<ul class="nav navbar-right">

<?php
$languages = $this->config->item('languages');
$aliases = $this->config->item('aliases');
$val = $this->input->get('lang') ? $this->input->get('lang') : $this->languages->detect();
?>

				<li class="dropdown">
					<a href="#" class="dropdown-toggle" data-toggle="dropdown"><?= $languages[$val] ?> <b class="caret"></b></a>
					<ul class="dropdown-menu">

<?php 
foreach($aliases as $k => $v) {
    $flag = $k;
    $name = $v;
    $desc = $languages[$v];
    $selected = ($val == $name) ? 'selected' : '';
    echo '<li><a href="' . current_url() . '?lang=' . $name . '">' . $desc . '</a></li>';
}
?>
					</ul>
				</li>
			</ul>
		</div>
	</div>
</div>
