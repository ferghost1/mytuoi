<div id="custom_overlay"></div>
<div id="edit_view" class="w-50">
<form>
	<div class="alert alert-danger error"></div>
	<div class="alert alert-success success"></div>
	<div  class="form-row p-3">
	    <div class="form-group col-md-12">
	      <label >Tên Danh Mục</label>
	      <input class="form-control" name="cate_name" type="text" >
	    </div>
	    <div class="form-group col-md-12">
	      <label >Mô Tả</label>
	      <textarea class="form-control" name="cate_des" ></textarea>
	    </div>
	    <div class="form-group col-md-12 text-right">
	      <button class="btn btn-success submit_edit" onclick="send_edit($(this))" type="button">Sửa</button>
	    </div>
	</div>
</form>
</div>
<style type="text/css">
	#custom_overlay{
		position: fixed;
		z-index: 998;
		background:black;
		display: none;
		opacity: .5;
		width: 100%;
		height: 100%;
		top: 0;
		left: 0;
	}
	#edit_view{
		position: fixed;
		top: 20%;
		left: 20%;
		z-index: 999;
		background:white;
		display: none
	}
	#edit_view .error,#edit_view .success{
		display: none;
	}
</style>