<?php

$s = <<<EOT

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `user_id` int(11) NOT NULL,
  UNIQUE KEY `pk_project` (`id`)
);

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `email` varchar(32) NOT NULL,
  `age` int(11) NOT NULL,
  UNIQUE KEY `pk_user` (`id`)
);

DROP TABLE IF EXISTS `user_skill`;
CREATE TABLE IF NOT EXISTS `user_skill` (
  `user_id`  int(11) NOT NULL,
  `skill_id` int(11) NOT NULL,
  UNIQUE KEY `pk_user_skill` (`user_id`, `skill_id`)
);

DROP TABLE IF EXISTS `skill`;
CREATE TABLE IF NOT EXISTS `skill` (
  `id` int(11) NOT NULL,
  `name` varchar(32) NOT NULL,
  `parent_id` int(11) NOT NULL,
  UNIQUE KEY `pk_skill` (`id`)
);

EOT;
?>

<style>
.datagrid table { border-collapse: collapse; text-align: left; width: 100%; } .datagrid {font: normal 12px/150% Arial, Helvetica, sans-serif; background: #fff; overflow: hidden; border: 5px solid #EEEEEE; -webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; }.datagrid table td, .datagrid table th { padding: 3px 10px; }.datagrid table thead th {background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; color:#FFFFFF; font-size: 15px; font-weight: bold; border-left: 2px solid #A3A3A3; } .datagrid table thead th:first-child { border: 2px solid white; }.datagrid table tbody td { color: #7D7D7D; border-left: 2px solid #DBDBDB;font-size: 12px;font-weight: normal; }.datagrid table tbody .alt td { background: #EBEBEB; color: #7D7D7D; }.datagrid table tbody td:first-child { border-left: 2px solid white; }.datagrid table tbody tr:last-child td { border-bottom: 2px solid white; }.datagrid table tfoot td div { border-top: 2px solid #8C8C8C;background: #EBEBEB;} .datagrid table tfoot td { padding: 0; font-size: 12px } .datagrid table tfoot td div{ padding: 2px; }.datagrid table tfoot td ul { margin: 0; padding:0; list-style: none; text-align: right; }.datagrid table tfoot  li { display: inline; }.datagrid table tfoot li a { text-decoration: none; display: inline-block;  padding: 2px 8px; margin: 1px;color: #F5F5F5;border: 1px solid #8C8C8C;-webkit-border-radius: 3px; -moz-border-radius: 3px; border-radius: 3px; background:-webkit-gradient( linear, left top, left bottom, color-stop(0.05, #8C8C8C), color-stop(1, #7D7D7D) );background:-moz-linear-gradient( center top, #8C8C8C 5%, #7D7D7D 100% );filter:progid:DXImageTransform.Microsoft.gradient(startColorstr='#8C8C8C', endColorstr='#7D7D7D');background-color:#8C8C8C; }.datagrid table tfoot ul.active, .datagrid table tfoot ul a:hover { text-decoration: none;border-color: #7D7D7D; color: #F5F5F5; background: none; background-color:#8C8C8C;}div.dhtmlx_window_active, div.dhx_modal_cover_dv { position: fixed !important; }
.sql_key { font-weight: bold; color: blue; }
.sql_tbl { 
	font-weight: bold;
	color: black;
}
.sql_col { font-weight: bold; color: black; }

.combo_mark{ 
  border-color: magenta;
  border-style: dotted;
}
.tbl_mark{ 
  border-color: blue;
  border-style: solid;
}
.sql_mark{ 
  border-left: 2px solid red;
  border-right: 2px solid red;
  border-color: red;
}
.datagrid .sql_mark { 
  border-left: 2px solid red;
  border-right: 2px solid red;
  border-color: red;
}
.datagrid thead .sql_mark { 
   border-top: 2px solid red;
}
.datagrid .sql_mark:first-child{ 
  border-left: 2px solid red;
  border-right: 2px solid red;
  border-color: red;
}
.datagrid .sql_mark{ 
  border-left: 2px solid red;
  border-right: 2px solid red;
  border-color: red;
}

.datagrid .sql_fk { 
  border-left: 2px solid green;
  border-right: 2px solid green;
  border-color: green;
}
.datagrid thead .sql_fk { 
   border-top: 2px solid green;
}
.datagrid .sql_fk:first-child{ 
  border-left: 2px solid green;
  border-right: 2px solid green;
  border-color: green;
}
.datagrid .sql_fk{ 
  border-left: 2px solid green;
  border-right: 2px solid green;
  border-color: green;
}
.usecase { background-color: azure; border: 1px solid gray; }

</style>

<head>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
</head>

<table>
	<tr>
		<td>
			project
		</td>
		<td>
			user
		</td>
		<td>
			user_skill
		</td>
		<td>
			skill
		</td>
	</tr>
	<tr>
		<td>
			<div class="datagrid"  id='tbl_project'>
				<table>
					<thead>
						<tr>
							<th class='col_id'>id</th><th class='col_name'>name</th><th class='fk_user_id col_user_id'>user_id</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
					<tbody>
						<tr>
							<td class='col_id'>1</td><td class='col_name'>SQL Simulator</td><td class='fk_user_id col_user_id'>3</td>
						</tr>
						<tr class="alt">
							<td class='col_id'>2</td><td class='col_name'>Zero Configuration</td><td class='fk_user_id col_user_id'>1</td>
						</tr>
						<tr>
							<td class='col_id'>3</td><td class='col_name'>DM Management</td><td class='fk_user_id col_user_id'>2</td>
						</tr>
						<tr class="alt">
							<td class='col_id'>4</td><td class='col_name'>Ruby Cloud</td><td class='fk_user_id col_user_id'>3</td>
						</tr>
						<tr>
							<td class='col_id'>5</td><td class='col_name'>Learning system</td><td class='fk_user_id col_user_id'>3</td>
						</tr>
					</tbody>
				</table>
			</div>
		</td>
		<td>
			<div class="datagrid" id='tbl_user'>
				<table>
					<thead>
						<tr>
							<th class='col_id'>id</th><th class='col_name'>name</th><th class='col_email'>email</th><th class='col_age'>age</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
					<tbody>
						<tr>
							<td class='col_id'>1</td><td class='col_name'>John</td><td class='col_email'>john@yahoo.com</td><td class='col_age'>33</td>
						</tr>
						<tr class="alt">
							<td class='col_id'>2</td><td class='col_name'>Mark</td><td class='col_email'>mark@yahoo.com</td><td class='col_age'>46</td>
						</tr>
						<tr>
							<td class='col_id'>3</td><td class='col_name'>Bob</td><td class='col_email'>bob@gmail.com</td><td class='col_age'>12</td>
						</tr>
						<tr class="alt">
							<td class='col_id'>4</td><td class='col_name'>Tom</td><td class='col_email'>tom@gmail.com</td><td class='col_age'>12</td>
						</tr>
						<tr>
							<td class='col_id'>5</td><td class='col_name'>Phill</td><td class='col_email'>phill@yahoo.com</td><td class='col_age'>33</td>
						</tr>
					</tbody>
				</table>
			</div>
		</td>
		<td>
			<div class="datagrid" id='tbl_user_skill'>
				<table>
					<thead>
						<tr>
							<th class='col_user_id fk_user_id'>user_id</th><th class='col_skill_id fk_skill_id'>skill_id</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
					<tbody>
						<tr>
							<td class='col_user_id fk_user_id'>1</td><td class='col_skill_id fk_skill_id'>3</td>
						</tr>
						<tr class="alt">
							<td class='col_user_id fk_user_id'>2</td><td class='col_skill_id fk_skill_id'>2</td>
						</tr>
						<tr>
							<td class='col_user_id fk_user_id'>3</td><td class='col_skill_id fk_skill_id'>3</td>
						</tr>
						<tr class="alt">
							<td class='col_user_id fk_user_id'>4</td><td class='col_skill_id fk_skill_id'>1</td>
						</tr>
						<tr>
							<td class='col_user_id fk_user_id'>5</td><td class='col_skill_id fk_skill_id'>3</td>
						</tr>
					</tbody>
				</table>
			</div>
		</td>
		<td>
			<div class="datagrid"  id='tbl_skill'>
				<table>
					<thead>
						<tr>
							<th class='col_id'>id</th><th class='col_name'>name</th><th class='col_rank'>rank</th><th class='col_parent_id'>parrent_id</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<td colspan="4"><div id="paging"><ul><li><a href="#"><span>Previous</span></a></li><li><a href="#" class="active"><span>1</span></a></li><li><a href="#"><span>2</span></a></li><li><a href="#"><span>3</span></a></li><li><a href="#"><span>4</span></a></li><li><a href="#"><span>5</span></a></li><li><a href="#"><span>Next</span></a></li></ul></div></tr></tfoot>
					<tbody>
						<tr>
							<td class='col_id'>1</td><td class='col_name'>CSS</td><td class='col_rank'>5</td><td class='col_parent_id'></td>
						</tr>
						<tr class="alt">
							<td class='col_id'>2</td><td class='col_name'>PHP</td><td class='col_rank'>15</td><td class='col_parent_id'></td>
						</tr>
						<tr>
							<td class='col_id'>3</td><td class='col_name'>SQL</td><td class='col_rank'>15</td><td class='col_parent_id'></td>
						</tr>
						<tr class="alt">
							<td class='col_id'>4</td><td class='col_name'>MySql</td><td class='col_rank'>5</td><td class='col_parent_id'>3</td>
						</tr>
						<tr>
							<td class='col_id'>5</td><td class='col_name'>SqLite</td><td class='col_rank'>5</td><td class='col_parent_id'>3</td>
						</tr>
					</tbody>
				</table>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="4" style="background-color: #DFFFFF">
			<div style='margin: 20px' id='sql_div'>Mouse over this area to highlight the tables and columns:<br>
			<span class='sql_combo' n='project'>`<span class='sql_tbl'>project</span>`.`<span class='sql_col'>id</span>`</span>
			<span class='sql_combo' n='project'>`<span class='sql_tbl'>project</span>`.`<span class='sql_col'>user_id</span>`</span>
			</div>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<textarea id='sql_textarea' style="width: 100%"></textarea>
		</td>
	</tr>
	<tr>
		<td colspan="4">
			<h3>Select a case to see the SQL</h3>
			<br><b>One-To-One</b>
			<div class='usecase' onclick="$('#sql_textarea').val('SELECT user.email FROM user WHERE user.id = 2');update_sql();">Find Bob's email</div><br>
			<b>One-To-Many</b>
			<div class='usecase' onclick="$('#sql_textarea').val('SELECT project.name FROM user JOIN project ON user.id = project.user_id AND user.id = 2');update_sql();">Find Bob's project names</div>
			<br><b>Many-To-Many</b>
			<div class='usecase' onclick="$('#sql_textarea').val('SELECT skill.name FROM user JOIN user_skill ON user_skill.user_id = user.id JOIN skill ON user_skill.skill_id = skill.id AND user.id = 2 ');update_sql();">Find Bob's skills</div>
		</td>
	</tr>
</table>

<script>
	$('#sql_textarea').bind('input propertychange', function() {
		update_sql();
	});

	function update_sql(){
	     $('#sql_div').html($('#sql_textarea').val()
	     	.replace(/select/gi, " <span class='sql_key'>select</span> ")
	     	.replace(/ from /gi, " <span class='sql_key'>from</span> ")
	     	.replace(/ where /gi, " <span class='sql_key'>where</span> ")
	     	.replace(/ on /gi, " <span class='sql_key'>on</span> ")
	     	.replace(/ join /gi, " <span class='sql_key'>join</span> ")
	     	.replace(/ and /gi, " <span class='sql_key'>and</span> ")
	     	.replace(/ or /gi, " <span class='sql_key'>or</span> ")
	     	
	     	.replace(/`id`/gi, "id")
	     	.replace(/`name`/gi, "name")
	     	.replace(/`email`/gi, "email")
	     	.replace(/`age`/gi, "age")
	     	
	     	.replace(/`user`/gi, "user")
	     	.replace(/`skill`/gi, "skill")
	     	.replace(/`project`/gi, "project")

	     	.replace(/project\.id/gi, 
	     		"<span class='sql_combo' n='project'>`<span class='sql_tbl'>project</span>`.`<span class='sql_col'>id</span>`</span>")
			.replace(/project\.name/gi, 
	     		"<span class='sql_combo' n='project'>`<span class='sql_tbl'>project</span>`.`<span class='sql_col'>name</span>`</span>")
	     	.replace(/project\.user_id/gi, 
	     		"<span class='sql_combo' n='project'>`<span class='sql_tbl'>project</span>`.`<span class='sql_col'>user_id</span>`</span>")
	     	.replace(/user\.id/gi, 
	     		"<span class='sql_combo' n='user'>`<span class='sql_tbl'>user</span>`.`<span class='sql_col'>id</span>`</span>")
	     	.replace(/user\.name/gi, 
	     		"<span class='sql_combo' n='user'>`<span class='sql_tbl'>user</span>`.`<span class='sql_col'>name</span>`</span>")
	     	.replace(/user\.email/gi, 
	     		"<span class='sql_combo' n='user'>`<span class='sql_tbl'>user</span>`.`<span class='sql_col'>email</span>`</span>")
	     	.replace(/user\.age/gi, 
	     		"<span class='sql_combo' n='user'>`<span class='sql_tbl'>user</span>`.`<span class='sql_col'>age</span>`</span>")
	     	.replace(/skill\.id/gi, 
	     		"<span class='sql_combo' n='skill'>`<span class='sql_tbl'>skill</span>`.`<span class='sql_col'>id</span>`</span>")
	     	.replace(/skill\.name/gi, 
	     		"<span class='sql_combo' n='skill'>`<span class='sql_tbl'>skill</span>`.`<span class='sql_col'>name</span>`</span>")
	     	.replace(/skill\.rank/gi, 
	     		"<span class='sql_combo' n='skill'>`<span class='sql_tbl'>skill</span>`.`<span class='sql_col'>rank</span>`</span>")
	     	.replace(/skill\.parent_id/gi, 
	     		"<span class='sql_combo' n='skill'>`<span class='sql_tbl'>skill</span>`.`<span class='sql_col'>parent_id</span>`</span>")
	     	.replace(/user_skill\.user_id/gi, 
	     		"<span class='sql_combo' n='user_skill'>`<span class='sql_tbl'>user_skill</span>`.`<span class='sql_col'>user_id</span>`</span>")
	     	.replace(/user_skill\.skill_id/gi, 
	     		"<span class='sql_combo' n='user_skill'>`<span class='sql_tbl'>user_skill</span>`.`<span class='sql_col'>skill_id</span>`</span>")
	     	
	     	.replace(/ user /gi, " `<span class='sql_tbl'>user</span>` ")
	     	.replace(/ skill /gi, " `<span class='sql_tbl'>skill</span>` ")
	     	.replace(/ project /gi, " `<span class='sql_tbl'>project</span>` ")
	     	.replace(/ user_skill /gi, " `<span class='sql_tbl'>user_skill</span>` ")
	     	//.replace(/id/gi, "`<span class='sql_col'>id</span>`")
	     	//.replace(/name/gi, "`<span class='sql_col'>name</span>`")
	     	//.replace(/email/gi, "`<span class='sql_col'>email</span>`")
	     	//.replace(/age/gi, "`<span class='sql_col'>age</span>`")
	     	);
	};

	$(document).on('mouseenter', '.sql_tbl', function () {
    	$('#tbl_'+this.innerText).addClass('tbl_mark');
	});
	$(document).on('mouseout', '.sql_tbl', function () {
    	$('#tbl_'+this.innerText).removeClass('tbl_mark');
	});

	$(document).on('mouseenter', '.sql_col', function () {
    	$('#tbl_'+this.parentElement.children[0].innerText+' .col_'+this.innerText).addClass('sql_mark');
		$('.fk_'+this.parentElement.children[0].innerText+'_'+this.innerText).addClass('sql_fk');
	});
	$(document).on('mouseout', '.sql_col', function () {
    	$('#tbl_'+this.parentElement.children[0].innerText+' .col_'+this.innerText).removeClass('sql_mark');
		$('.fk_'+this.parentElement.children[0].innerText+'_'+this.innerText).removeClass('sql_fk');
	});

	$(document).on('mouseover', '.sql_combo', function () {
    	$('#tbl_'+this.children[0].innerText).addClass('combo_mark');
	});
	$(document).on('mouseout', '.sql_combo', function () {
    	$('#tbl_'+this.children[0].innerText).removeClass('combo_mark');
	});

</script>