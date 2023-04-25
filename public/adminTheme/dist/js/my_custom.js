
     $('.select2').select2();
    $('.multi_select').select2(
      {
        multiple : true,
      }
    );

  // $(document).on('click', '.remove_image', function(){
  //   var name = $(this).attr('id');
  //   $.ajax({
  //     url:"{{ route('dropzone.delete') }}",
  //     data:{name : name},
  //     success:function(data){
  //       load_images();
  //     }
  //   })
  // });

  // Dropzone js code ends 

  // Single image upload code for logo 
  // Code starts 

  $(document).ready( function() {
      $(document).on('change', '.btn-file :file', function() {
    var input = $(this),
      label = input.val().replace(/\\/g, '/').replace(/.*\//, '');
    input.trigger('fileselect', [label]);
    });

    $('.btn-file :file').on('fileselect', function(event, label) {
        
        var input = $(this).parents('.input-group').find(':text'),
            log = label;
        
        if( input.length ) {
            input.val(log);
        } else {
            if( log ) alert(log);
        }
      
    });
    function readURL(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#img-upload').attr('src', e.target.result);
            }
            
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#imgInp").change(function(){
        readURL(this);
    });   
  });

  // Code Ends

// homepage js starts

  $(function () {
    $("#example1").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": true,
      "ordering": true,
      "buttons": false,
      buttons: [
        '', '', '', ''
        // 'copy', 'excel', 'pdf', 'csv'
    ]
      
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

    $("#example3").DataTable({
      "responsive": true, 
      "lengthChange": true, 
      "autoWidth": true,
      "ordering": true,
      "buttons": false,
      buttons: [
        'copy', 'excel', 'pdf', 'csv'
        // 'copy', 'excel', 'pdf', 'csv'
    ]
      
    }).buttons().container().appendTo('#example3_wrapper .col-md-6:eq(0)');

    $('#example2').DataTable({
      "paging": true,
      "lengthChange": true,
      "searching": true,
      "ordering": true,
      "info": true,
      "autoWidth": true,
      "responsive": true,
    });
  });



  



  // $(function () {
  //   $("#example3").DataTable({
  //     "responsive": true, 
  //     "lengthChange": true, 
  //     "autoWidth": true,
  //     "ordering": true,
  //     "buttons": true,
  //     buttons: [
  //       'copy', 'excel', 'pdf', 'csv'
  //       // 'copy', 'excel', 'pdf', 'csv'
  //   ]
      
  //   }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  //   $('#example2').DataTable({
  //     "paging": true,
  //     "lengthChange": true,
  //     "searching": true,
  //     "ordering": true,
  //     "info": true,
  //     "autoWidth": true,
  //     "responsive": true,
  //   });
  // });



  // homepage js ends

  // ckeditor code start
  CKEDITOR.replace( 'ckeditor' );
  //CKEDITOR.replace( 'editor1' );
  // ckeditor code ends 


// sweetAlert function starts
// sweetAlert ends 

// Dropzone.autoDiscover = false;
// let token = $('meta[name="csrf-token"]').attr('content');
// debugger
// // init dropzone on id (form or div)
// $(document).ready(function() {
//   var myDropzone = new Dropzone("#myDropzone", {
//     url: "/admin/properties/upload_store",
//     paramName: "file",
//     autoProcessQueue: false,
//     uploadMultiple: true, // uplaod files in a single request
//     parallelUploads: 100, // use it with uploadMultiple
//     maxFilesize: 1, // MB
//     maxFiles: 5,
//     acceptedFiles: ".jpg, .jpeg, .png, .gif",
//     addRemoveLinks: true,
//     // Language Strings
//     dictFileTooBig: "File is to big ({{filesize}}mb). Max allowed file size is {{maxFilesize}}mb",
//     dictInvalidFileType: "Invalid File Type",
//     dictCancelUpload: "Cancel",
//     dictRemoveFile: "Remove",
//     dictMaxFilesExceeded: "Only {{maxFiles}} files are allowed",
//     dictDefaultMessage: "Drop files here to upload",
//     params: {
//       _token: token
//     }
//   });
// });
// Dropzone.options.myDropzone = {
//   // The setting up of the dropzone
//   init: function() {
//     var myDropzone = this;
//     // First change the button to actually tell Dropzone to process the queue.
//     $("#Form").on("submit", function(e) {
//       // Make sure that the form isn't actually being sent.
//       e.preventDefault();
//       //e.stopPropagation();
//       URL = $("#Form").attr('action');
// 	  	formData = $('#Form').serialize();
//       // debugger
//       $.ajax({
//         type: 'POST',
//         url: URL,
//         data: formData,
//         success: function(result){
//           // debugger
//                 // if(result.status == "success"){
//                 //   // fetch the useid 
//                 //   var userid = result.user_id;
//                 // $("#userid").val(userid); // inseting userid into hidden input field
//                 //   //process the queue
//                myDropzone.processQueue();
//           // }else{
//           //   console.log("error");
//           // }
//         }
//       });
//     });
//     this.on("sending", function(file, xhr, formData) {
//       debugger;
//       formData.append('property_id', 1);
//       alert("sending file");
//     });
//     // on add file
//     // this.on("addedfile", function(file) {
//     //     console.log(file);
//     // });
//     // on error
//     // this.on("error", function(file, response) {
//     //   // console.log(response);
//     // });
//     // // on start
//     // this.on("sendingmultiple", function(file) {
//     //    console.log(file);
//     // });
//     // // on success
//     // this.on("successmultiple", function(file) {
//     //   // submit form
//     //   //$("#form").submit();
//     // });
//   }
// };


var searchInput = 'search_input';

$(document).ready(function () {
  // alert('saad');
    var autocomplete;
    autocomplete = new google.maps.places.Autocomplete((document.getElementById(searchInput)), {
        types: ['geocode'],
        componentRestrictions: {
          country: "US"
        }
    });
	
    google.maps.event.addListener(autocomplete, 'place_changed', function () {
        var near_place = autocomplete.getPlace();
        // alert(near_place.geometry);
        debugger
        document.getElementById('loc_lat').value = near_place.geometry.location.lat();
        document.getElementById('loc_long').value = near_place.geometry.location.lng();
	  });
});

$("#addRow").click(function () {
  var html = '';
  html += '<div id="inputFormRow">';
  html += '<div class="input-group mb-3">';
  html += '<input type="file" name="file[]" class="form-control m-input" placeholder="Enter title" autocomplete="off">';
  html += '<div class="input-group-append">';
  html += '<button id="removeRow" type="button" class="btn btn-danger">Remove</button>';
  html += '</div>';
  html += '</div>';

  $('#newRow').append(html);
});

// remove row
$(document).on('click', '#removeRow', function () {
  $(this).closest('#inputFormRow').remove();
});


// remove row
$(document).on('click', '#removeeditRow', function () {
  $(this).closest('#inputFormRow').remove();

  var image_url = $(this).attr('name');
  var confirmText = "Are you sure you want to delete this?";
  if(confirm(confirmText)) 
  {
    $.ajax(
      {
        url: "/admin/property/delete/image/"+image_url,
        type: 'GET',
        data: {
            "image_url": image_url,
        },
        success: function (){
          $(this).closest('inputFormRow').remove();
        }
      }
    );
  }
});



  