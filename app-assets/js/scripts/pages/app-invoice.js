/*=========================================================================================
    File Name: app-invoice.js
    Description: app-invoice Javascripts
    ----------------------------------------------------------------------------------------
    Item Name: Frest HTML Admin Template
   Version: 1.0
    Author: PIXINVENT
    Author URL: http://www.themeforest.net/user/pixinvent
==========================================================================================*/
$(document).ready(function() {
  /********Invoice View ********/
  // ---------------------------
  // init date picker
//   if ($(".pickadate").length) {
//     $(".pickadate").pickadate({
//       format: "mm/dd/yyyy"
//     });
//   }

  /********Invoice List ********/
  // ---------------------------

  // init data table
  if ($(".invoice-data-table").length) {
    var dataListView = $(".invoice-data-table").DataTable({
      columnDefs: [
        {
          targets: 0,
          className: "control"
        },
        {
          orderable: true,
          targets: 1,
          checkboxes: { selectRow: true }
        },
        {
          targets: [0, 1],
          orderable: false
        },
      ],
      order: [3, 'desc'],
      dom:
        '<"top d-flex flex-wrap"<"action-filters flex-grow-1"f><"actions action-btns d-flex align-items-center">><"clear">rt<"bottom"p>',
      language: {
        search: "",
        searchPlaceholder: "Search Project"
      },
      select: {
        style: "multi",
        selector: "td:first-child",
        items: "row"
      },
      responsive: {
        details: {
          type: "column",
          target: 0
        }
      }
    });
  }

  // To append actions dropdown inside action-btn div
  var invoiceFilterAction = $(".invoice-filter-action");
  var invoiceOptions = $(".invoice-options");
  $(".action-btns").append(invoiceFilterAction, invoiceOptions);

  // add class in row if checkbox checked
  $(".dt-checkboxes-cell")
    .find("input")
    .on("change", function() {
      var $this = $(this);
      if ($this.is(":checked")) {
        $this.closest("tr").addClass("selected-row-bg");
      } else {
        $this.closest("tr").removeClass("selected-row-bg");
      }
    });
  // Select all checkbox
  $(document).on("change", ".dt-checkboxes-select-all input", function() {
    if ($(this).is(":checked")) {
      $(".dt-checkboxes-cell")
        .find("input")
        .prop("checked", this.checked)
        .closest("tr")
        .addClass("selected-row-bg");
    } else {
      $(".dt-checkboxes-cell")
        .find("input")
        .prop("checked", "")
        .closest("tr")
        .removeClass("selected-row-bg");
    }
  });

  // ********Invoice Edit***********//
  // --------------------------------
  // form repeater jquery
  if ($(".invoice-item-repeater").length) {
    $(".invoice-item-repeater").repeater({
      show: function() {
        $(this).slideDown();
      },
      hide: function(deleteElement) {
        $(this).slideUp(deleteElement);
      }
    });
  }
  // dropdown form's prevent parent action
  $(document).on("click", ".invoice-tax", function(e) {
    e.stopPropagation();
  });
  $(document).on("click", ".invoice-apply-btn", function() {
    var $this = $(this);
    var discount = $this
      .closest(".dropdown-menu")
      .find("#discount")
      .val();
    var tax1 = $this
      .closest(".dropdown-menu")
      .find("#Tax1 option:selected")
      .text();
    var tax2 = $this
      .closest(".dropdown-menu")
      .find("#Tax2 option:selected")
      .text();
    $this
      .parents()
      .eq(4)
      .find(".discount-value")
      .html(discount + "%");
    $this
      .parents()
      .eq(4)
      .find(".tax1")
      .html(tax1);
    $this
      .parents()
      .eq(4)
      .find(".tax2")
      .html(tax2);
  });
  // // on product change also change product description
  $(document).on("change", ".invoice-item-select", function(e) {
    var selectOption = this.options[e.target.selectedIndex].text;
    // switch case for product select change also change product description
    switch (selectOption) {
      case "Frest Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("The most developer friendly & highly customisable HTML5 Admin");
        break;
      case "Stack Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("Ultimate Bootstrap 4 Admin Template for Next Generation Applications.");
        break;
      case "Robust Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val(
            "Robust admin is super flexible, powerful, clean & modern responsive bootstrap admin template with unlimited possibilities"
          );
        break;
      case "Apex Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("Developer friendly and highly customizable Angular 7+ jQuery Free Bootstrap 4 gradient ui admin template. ");
        break;
      case "Modern Admin Template":
        $(e.target)
          .closest(".invoice-item-filed")
          .find(".invoice-item-desc")
          .val("The most complete & feature packed bootstrap 4 admin template of 2019!");
        break;
    }
  });
	  
  	$('.btn-save').on('click', function(e) {
		e.preventDefault();
		var frm = $('#frmAdd'),
			name = $('input[name="name"]', frm),
			domains = $('input[name="domains"]', frm),
			username = $('input[name="username"]', frm),
			password = $('input[name="password"]', frm);
		if(name.val()=='') {
			name.next('div.err-message').show();
			return;
		}
		if(domains.val()=='') {
			domains.next('div.err-message').show();
			return;
		}
		if(username.val()=='') {
			username.next('div.err-message').show();
			return;
		}
		if(password.val()=='') {
			password.next('div.err-message').show();
			return;
		}		
		
		var tmp = page_code.split('_');
		Swal.fire({
			title: 'Are you sure to save?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			confirmButtonClass: 'btn btn-primary',
			cancelButtonClass: 'btn btn-danger ml-1',
			buttonsStyling: false,
		}).then(function (result) {
			if (result.value) {
				if (typeof FormData !== 'undefined') {
					var formData = new FormData(frm[0]);
					$.ajax({
						url : tmp[0] + "/update_process",
						type : 'POST',
						data : formData,
						dataType: 'json',			
						async : false,
						cache : false,
						contentType : false,
						processData : false,
						success : function(json) {    
							if(json.result == 1) {
								Swal.fire({
									title: 'Saved successfully!',
									confirmButtonClass: 'btn btn-primary',
									buttonsStyling: false,									
								}).then(function(result) {
									if(result)
										location.href = base_url + tmp[0] + '/list';
								});	
							} else {
								Swal.fire({
									type: 'error',
									title: 'Oops...',
									text: 'Saving is Failed. Try later!',
									confirmButtonClass: 'btn btn-primary',
									buttonsStyling: false,
								});						
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {  
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								text: textStatus + errorThrown,
								confirmButtonClass: 'btn btn-primary',
								buttonsStyling: false,
							});
						}			
					});
				}
			}
		});
	});

	$('.btn-save-mark').on('click', function(e) {
		e.preventDefault();
		var frm = $('#frmMark'),
			name = "mark",
			domains = $('input[name="domains"]', frm);		
		if(domains.val()=='') {
			domains.next('div.err-message').show();
			return;
		}			
		var tmp = page_code.split('_');
		Swal.fire({
			title: 'Are you sure to save?',
			text: "You won't be able to revert this!",
			type: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
			confirmButtonText: 'Yes',
			confirmButtonClass: 'btn btn-primary',
			cancelButtonClass: 'btn btn-danger ml-1',
			buttonsStyling: false,
		}).then(function (result) {
			if (result.value) {
				if (typeof FormData !== 'undefined') {
					var formData = new FormData(frm[0]);
					$.ajax({
						url : tmp[0] + "/update_mark",
						type : 'POST',
						data : formData,
						dataType: 'json',			
						async : false,
						cache : false,
						contentType : false,
						processData : false,
						success : function(json) {    
							if(json.result == 1) {
								Swal.fire({
									title: 'Saved successfully!',
									confirmButtonClass: 'btn btn-primary',
									buttonsStyling: false,									
								}).then(function(result) {
									if(result)
										location.href = base_url + tmp[0] + '/list';
								});	
							} else {
								Swal.fire({
									type: 'error',
									title: 'Oops...',
									text: 'Saving is Failed. Try later!',
									confirmButtonClass: 'btn btn-primary',
									buttonsStyling: false,
								});						
							}
						},
						error: function(jqXHR, textStatus, errorThrown) {  
							Swal.fire({
								type: 'error',
								title: 'Oops...',
								text: textStatus + errorThrown,
								confirmButtonClass: 'btn btn-primary',
								buttonsStyling: false,
							});
						}			
					});
				}
			}
		});
	});

	$('input, textarea', $('#frmAdd')).on('keydown', function() {
		$(this).next('div.err-message').hide();
	});

	$('.btn-run').on('click', function(e){
		e.preventDefault();
		var id = $('input[name="id"]', $('#frmAdd'));
		if(id.val()=='0'){
			Swal.fire({
				title: 'Please save a project and then run',
				confirmButtonClass: 'btn btn-primary',
				buttonsStyling: false,
			});				
			return;
		}
		runProject(id.val());
	});

	$('a.btn-run-item').click(function(e) {
		var tr = $(this).parents('tr');
		var id = $(this).attr('data-id');
		if(!id) return;
		runProject(id, function() {
			$('td.status', tr).html('<span class="badge badge-light-success badge-pill">SUBMITTED</span>');
		});
	});

	$('a.btn-delete-item').click(function() {
		var id = $(this).attr('data-id');
		if(!id) return;
		deleteProject(id);
	});

	$('a.btn-batch-delete').click(function() {
		var ids = getCheckedIds();
		if(ids=='') return;		
		deleteProject(ids);
	})
});

var runProject = function(id, callback) {
	var tmp = page_code.split('_');
	Swal.fire({
		title: 'Are you sure to submit?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes',
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-danger ml-1',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			$("#btn_download").attr("href","javascript:;");
			$("#modal_content").html("<img width='100%' src='"+base_url+"/app-assets/images/loading.gif'>");
			$('#backdrop').modal({backdrop: 'static', keyboard: false});
			
			$.ajax({
				url : tmp[0] + "/update_status",
				type : 'POST',
				data : 'id=' + id,
				dataType: 'json',
				success : function(json) {    
					if(json.result == 1) {
						$("#modal_content").html("Success! Please Download...");
                    	$("#btn_download").attr("href",base_url+"/app-assets/download_files/"+json.result_file);	
					} else {	
						$("#modal_content").html(json.result);
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {
					$("#modal_content").html("Submit is Failed:"+ textStatus + errorThrown);
				}		
			});
		}
	});
};

var deleteProject = function(ids) {	
	var tmp = page_code.split('_');
	Swal.fire({
		title: 'Are you sure to delete?',
		text: "You won't be able to revert this!",
		type: 'warning',
		showCancelButton: true,
		confirmButtonColor: '#3085d6',
		cancelButtonColor: '#d33',
		confirmButtonText: 'Yes',
		confirmButtonClass: 'btn btn-primary',
		cancelButtonClass: 'btn btn-danger ml-1',
		buttonsStyling: false,
	}).then(function (result) {
		if (result.value) {
			$.ajax({
				url : site_url+"/"+tmp[0] + "/delete",
				type : 'POST',
				data : 'ids=' + ids,
				dataType: 'json',
				success : function(json) {    
					if(json.result == 1) {
						Swal.fire({
							title: 'Deleted successfully!',
							confirmButtonClass: 'btn btn-primary',
							buttonsStyling: false,
						}).then(function(result) {
							if(result)
								location.href = site_url + "/"+tmp[0] + '/list';
						});	
					} else {
						Swal.fire({
							type: 'error',
							title: 'Oops...',
							text: 'Deleting is Failed. Try later!',
							confirmButtonClass: 'btn btn-primary',
							buttonsStyling: false,
						});
					}
				},
				error: function(jqXHR, textStatus, errorThrown) {               
					Swal.fire({
						type: 'error',
						title: 'Oops...',
						text: textStatus + errorThrown,
						confirmButtonClass: 'btn btn-primary',
						buttonsStyling: false,
					});
				}		
			});
		}
	})
	
};

var getCheckedIds = function() {
	var ids = '';
	$('input.dt-checkboxes').each(function() {
		var td = $(this).parent('td');		
		if($(this).is(':checked')) {
			var id = td.attr('data-id');
			if(ids!='') ids += ',';
			ids += id;
		}
	});
	return ids;
}
