<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>TODO App</title>
		<link rel="stylesheet" type="text/css" href="/assets/main/css/bootstrap.min.css">
		<link rel="stylesheet" type="text/css" href="/assets/main/css/style.css">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta2/css/all.min.css" integrity="sha512-YWzhKL2whUzgiheMoBFwW8CKV4qpHQAEuvilg9FAn5VJUDwKZZxkJNuGM4XkWuk94WCrrwslk8yWNGmY1EduTA==" crossorigin="anonymous" referrerpolicy="no-referrer" />
	</head>
	<body>


	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
		<div class="modal-header">
			<h5 class="modal-title" id="exampleModalLabel">Düzenle</h5>
			<button type="button" class="close" data-dismiss="modal" aria-label="Close">
			<span aria-hidden="true">&times;</span>
			</button>
		</div>
		<div class="modal-body">
			<label for="#todoUpdateInput"><h5>Başlık:</h5> </label><input type="text" class="form-control" style="margin-bottom:20px;" id="todoUpdateTitle" placeholder="Yarın okula gidilecek.">
			<label for="#todoUpdateDate"><h5>Tarih:</h5> </label><input type="date" class="form-control" style="margin-bottom:20px;" id="todoUpdateDate">
			<label for="todoUpdateContent"><h5>İçerik:</h5> </label><textarea id="todoUpdateContent"></textarea><br>
			
			<label for="todoUpdateStress"><h5>Önem Derecesi:</h5> </label>
			<select class="form-control" style="margin-bottom:20px;" id="todoUpdateStress" value="">
				<option value="3">Anne Terliği !!!</option>
				<option value="2" selected>Sehpa ve Serçe Parmağı !!</option>
				<option value="1">Çözülmüş Bağcıklar !</option>
			</select>
			<label for="todoUpdateKeywords"><h5>Anahtar Kelimeler</h5></label><input type="text" class="form-control" style="margin-bottom:20px;" id="todoUpdateKeywords" placeholder="ödev, matematik...">
		</div>
		<div class="modal-footer">
			<button type="button" class="btn btn-secondary" data-dismiss="modal">Kapat</button>
			<button type="button" class="btn btn-primary"id="saveArrangementBut" data-id="" data-dismiss="modal" onclick="todoArrangement(this)">Kaydet</button>
		</div>
		</div>
	</div>
	</div>

		<div class="todo-insert-div">
			<label for="todoInsertInput"><h5>Başlık:</h5> </label><input type="text" class="form-control" style="margin-bottom:20px;" id="todoInsertTitle" placeholder="Yarın okula gidilecek.">
			<label for="todoInsertDate"><h5>Tarih:</h5> </label><input type="date" class="form-control" style="margin-bottom:20px;" id="todoInsertDate" value="<?php echo date("Y-m-d");?>">
			<label for="todoInsertDate"><h5>İçerik:</h5> </label><textarea id="todoInsertContent"></textarea><br>
			
			<label for="todoInsertStress"><h5>Önem Derecesi:</h5> </label>
			<select class="form-control" style="margin-bottom:20px;" id="todoInsertStress" value="">
				<option value="3">Anne Terliği !!!</option>
				<option value="2" selected>Sehpa ve Serçe Parmağı !!</option>
				<option value="1">Çözülmüş Bağcıklar !</option>
			</select>
			<label for="todoInsertKeywords"><h5>Anahtar Kelimeler</h5></label><input type="text" class="form-control" style="margin-bottom:20px;" id="todoInsertKeywords" placeholder="ödev, matematik...">

			<button class="col-lg-2 col-md-2 form-control"style="margin:auto;" onclick="todoInsert()">Kaydet</button>
		</div>
		
		<div class="todo-div">
			<div class="todo-div-inner form-control">
			<label for="listSearch">Arama: </label><input type="text" class="form-control" id="listSearch" value="">

				<table class="todo-table">
					<thead><tr><td>Listeleme</td><td>İşlemler</td><td>Başlık</td><td>Bitiş Tarihi</td><td>Önem Derecesi</td><td>Anahtar Kelimeler</td></tr></thead>
					<tbody id="todo-list-body">
					</tbody>
				</table>
			</div>
		</div>

		<script src="/assets/main/js/jquery-3.4.1.min.js"></script>
		<script src="/assets/main/js/bootstrap.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/5.10.1/tinymce.min.js" integrity="sha512-tbXTHOY9yg3iMu7/maK4/riWonAxPpblIf5liooEUo7U39WDMITQDTcA++6Y/SPcsTqLfZfK07Wb0am09Urrjw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
		<script src="/assets/main/js/sweetalert2.all.min.js"></script>
		<script src="/assets/main/js/todoList.js"></script>
	</body>
</html>