 
$(document).ready(function(){
	$('#formsimpandaneditrs').hide();

     // rs
     /*--first time load--*/
		ajaxlist(page_url=false);
		
		/*-- Search keyword--*/
		$(document).on('keyup', "#search_key", function(event) {
			ajaxlist(page_url=false);
			event.preventDefault();
		
		});
		
		/*-- Reset Search--*/
		$(document).on('click', "#resetBtn", function(event) {
			$("#search_key").val('');
			ajaxlist(page_url=false);
			event.preventDefault();
		});
		
		/*-- Page click --*/
		$(document).on('click', ".uk-pagination li a", function(event) {
			var page_url = $(this).attr('href');
			ajaxlist(page_url);
			event.preventDefault();
		});
		
		/*-- create function ajaxlist --*/
		function ajaxlist(page_url = false)
		{
			var search_key = $("#search_key").val();
			var url = base_url+'administrator/tampilRs';
			var dataString = 'search_key=' + search_key;
			if(page_url == false) {
				var page_url = url;
			}
			
			$.ajax({
				type: "POST",
				url: page_url,
				data: dataString,
				beforeSend: function(){
            			$('.loading').show();
        		},
				success: function(response) {
					console.log(response);
					$('#ajaxRs').html(response);
					$('.loading').fadeOut("slow");
				}
			});
		}
     // rs

 $('body').on('click', '#tambahmodal',function (e) {
	e.preventDefault();
	$('#formsimpandaneditrs').show().fadeIn(3000);
	$('#tampilrssemua').hide().fadeOut(3000);

    $('#kecamatanrs').val("");
    $('#lokasirs').val("");
    $('#namars').val("");
    $('#latituders').val("");
    $('#longituders').val("");
	
	$('#kategori').val("0");
	
	$('#simpandata').text('Simpan Data');
	$('#submiteditdata').attr("id","submitdata");
	$("#uploadPreview").attr("src",base_url+"public/img/no.png");
	
    
});

$('body').on('click', '#formedit',function (e) {
	e.preventDefault();
	
	var id= $(this).data("id");
	var kecamatan= $(this).data("kecamatan");
	var lokasi= $(this).data("lokasi");
	var latitude= $(this).data("latitude");
	var longitude= $(this).data("longitude");
	var nama= $(this).data("nama");
	var kategori= $(this).data("kategori");
	


	$('#idrs').val(id);
	$('#kecamatanrs').val(kecamatan);
    $('#lokasirs').val(lokasi);
    $('#namars').val(nama);
    $('#latituders').val(latitude);
    $('#longituders').val(longitude);
	$('#kategori').val(kategori);
	

	$('#formsimpandaneditrs').show().fadeIn(3000);
	$('#tampilrssemua').hide().fadeOut(3000);

	
		$('#simpandata').text('Edit rs');
		$('#submitdata').attr("id","submiteditdata");

		
	
});





$('body').on('submit', '#submitdata',function (e) {
	e.preventDefault();
	

    var kecamatan= $('#kecamatanrs').val();
    var lokasi =$('#lokasirs').val();
    var nama =$('#namars').val();
    var latitude =$('#latituders').val();
   	var longitude= $('#longituders').val();
	var kategori=$('#kategori').val();
	

	if (kecamatan=="") {
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> Kecamatan masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#kecamatanrs').focus();
	} else if(lokasi=="") {
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> Lokasi masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#lokasirs').focus();
	
	
	}else if(nama==""){
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> Nama masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#namars').focus();
	}else if(latitude==""){
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> latitude masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#latituders').focus();

	
	}else if(longitude==""){
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> longitude masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#longituders').focus();

	}else if(kategori=="0"){
		UIkit.notification({
			message: '<span uk-icon="icon: close"></span> kategori masih Kosong!',
			status: 'danger',
			pos: 'top-right',
			timeout: 1000,
		});

		$('#kategori').focus();	
	}else{
		$.ajax({
			url:base_url+'savedatars',
			type:"post",
			data:new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			beforeSend:function(){
				$("#simpandata").html("Loading...");
			},
			  success: function(data){
				$("#simpandata").html("Simpan Rs");
				ajaxlist(page_url=false);
				UIkit.notification({
					message: '<span uk-icon="icon: check"></span> Data berhasil tersimpan!',
					status: 'success',
					pos: 'top-right',
					timeout: 1000,
				});	
				$('#formsimpandaneditrs').hide().fadeOut(3000);
				$('#tampilrssemua').show().fadeIn(3000);
		}
		});

	}
	
});

$('body').on('click', '#hapusdata',function (e) {
	e.preventDefault();
	var id= $(this).data('id');
	
	swal({
		title: "Apakah Anda Yakin?",
		text: "akan terhapus permanen!",
		icon: "warning",
		buttons: true,
		dangerMode: true,
	  })
	  .then((willDelete) => {
		if (willDelete) {
				$.ajax({
					type: "POST",
					url: base_url+"hapusrs",
					data: {id:id},
					dataType: "text",
					success: function (data) {
						ajaxlist(page_url=false);
					}
	  });
		  swal("Berhasil! Data rs sudah terhapus!", {
			icon: "success",
		  });
		} else {
		  swal("Data anda masih aman!");
		}
	  });




});
$('body').on('submit', '#submiteditdata',function (e) {
	e.preventDefault();
		$.ajax({
			url:base_url+'editdatars',
			type:"post",
			data:new FormData(this),
			processData:false,
			contentType:false,
			cache:false,
			async:false,
			beforeSend:function(){
				$("#simpandata").html("Loading...");
			},
			  success: function(data){
				ajaxlist(page_url=false);
				UIkit.notification({
					message: '<span uk-icon="icon: check"></span> Data berhasil teredit!',
					status: 'success',
					pos: 'top-right',
					timeout: 1000,
				});	
				$('#formsimpandaneditrs').hide().fadeOut(3000);
				$('#tampilrssemua').show().fadeIn(3000);
				$('#simpandata').text('Simpan Data');
				$('#submiteditdata').attr("id","submitdata");
		}
		});


	
});

$('#kembalikeawal').click(function (e) { 
	e.preventDefault();

	$('#judulrs').val("");

	$('#gbrrs').val("");
	$('#idrs').val("");

	$('#simpandata').text('Simpan Data');
	$('#submiteditdata').attr("id","submitdata");
	$("#uploadPreview").attr("src",base_url+"public/img/no.png");
	$('#formsimpandaneditrs').hide().fadeOut(3000);
	$('#tampilrssemua').show().fadeIn(3000);

});

});



