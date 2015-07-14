$(document).ready(function(){
	var settings = {
		url:'upload1.php',
		method:'POST',
		allowedTypes:'jpg,png,gif,doc,pdf,zip',
		fileName:'myfile',
		multiple:true,
		onSuccess:function(files,datas,xhr)
	    {
			//alert(datas);
			var obj = JSON.parse(datas);
			//var obj1 = JSON.stringify(obj);
			//alert(obj['design'].length);
			var len = obj['design'].length;
	    	setTimeout(function(){
		    	$('.ajax-file-upload-green').each(function(){
		    		$(this).trigger('click');
		    	});
	    	},1000);
	    	var toappend = "";
	    	for(var i=0;i<files.length;i++)
			
			//alert(datas);
	    		toappend += '<div class="uploaded-img"><button class="close">&times;</button><img src="img/'+obj['image']+'">';
				toappend += '<select class="form-control" name="image_name[]">';
				for(var j=0;j<len;j++){
					var values = obj['design'][j];
					toappend += "<option value="+values+">"+values+"</option>";
				}
				toappend +='</select><br/><textarea placeholder="Image Description" name="description[]" class="form-control" rows="2"></textarea><input type="hidden" name="image[]" value="'+obj['image']+'"></div>';
	    	$('.uploaded-area').append(toappend);	
	        $("#status").html("<font color='green'>Upload is success</font>");
	    },
	    onError: function(files,status,errMsg)
	    {      
	        $("#status").html("<font color='red'>Upload is Failed</font>");
	    }
	}
	$('.fileUpload').uploadFile(settings);
	$('[data-toggle=tooltip]').tooltip();
	$('.ajax-upload-dragdrop').data('toggle','tooltip');
	$('.ajax-upload-dragdrop').data('placement','left');
	$('.ajax-upload-dragdrop').attr('title','Click to add your design pictures');
	var obj = $('.drag-n-drop');
	obj.on('dragenter',function(e){
		e.stopPropagation();
		e.preventDefault();
	});
	obj.on('dragover',function(e){
		e.stopPropagation();
		e.preventDefault();
	});
	obj.on('drop',function(e){
		$(this).css('border','2px dotted #0b85a1');
		e.preventDefault();
		var files = e.originalEvent.dataTransfer.files;
		//function to handle file data
		fileUpload(files,obj);
	});
	$(document).on('dragenter', function (e)
	{
	    e.stopPropagation();
	    e.preventDefault();
	});
	$(document).on('dragover', function (e)
	{
	  e.stopPropagation();
	  e.preventDefault();
	  obj.css('border', '2px dotted #0B85A1');
	});
	$(document).on('drop', function (e)
	{
	    e.stopPropagation();
	    e.preventDefault();
	});
	//read the file content
	function fileUpload(files,obj){
		for(var i =0;i<files.length;i++){
			var fd = new FormData();
			fd.append('userImage',files[i]);
			var status = new createStatusBar(obj); //create status bar
			status.setFileNameSize(files[i].name,files[i].size);
			fileToServer(fd,status);
		}
	}
	function fileToServer(formData,status){
		var jqXHR = $.ajax({
			xhr : function(){
				var xhrobj = $.ajaxSettings.xhr();
				if(xhrobj.upload){
					xhrobj.upload.addEventListener('progress',function(e){
						var percent = 0;
						var position = e.loaded || e.position;
						var total = e.total;
						if(e.lengthComputable){
							percent = Math.ceil(position/total*100);
						}
						//Set progress
						status.setProgress(percent);
					},false);
				}
				return xhrobj;
			},
			url : 'fileUpload.php',
			type:'POST',
			data:formData,
			contentType: false,
			cache : false,
			processData: false
		}).done(function(response){
			
			$('#status').append("File Upload Done<br>");
		});
		status.setAbort(jqXHR);
	}
	function createStatusBar(obj){
		this.statusbar = $('<div class="statusbar"></div>');
		this.filename = $('<div class="filename"></div>').appendTo(this.statusbar);
		this.size = $('<div class="filesize"></div>').appendTo(this.statusbar);
		this.name = $('<input type="hidden" id="image" name="project_image" class="filename"/>').appendTo(this.statusbar);
		this.progressBar = $('<div class="progressBar"></div>').appendTo(this.statusbar);
		this.abort = $("<div class='abort'>Abort</div>").appendTo(this.statusbar);
		obj.after(this.statusbar);	

		this.setFileNameSize = function(name,size){
			var sizeStr = "";
			var sizeKB = size/1024;
			if(parseInt(sizeKB) > 1024){
				var sizeMB = sizeKB/1024;
				sizeStr = sizeMB.toFixed(2) + "MB";
			}
			else{
				sizeStr = sizeKB.toFixed(2)+"KB";
			}
			this.filename.html(name);
			this.name.val(name);	
			this.size.html(sizeStr);
		}
		
		this.setProgress = function(progress){
			var progressBarWidth = progress*this.progressBar.width()/100;
			this.progressBar.find('div').animate({width:progressBarWidth},10).html(progress+"%");
			if(parseInt(progress) >= 100)
				this.abort.hide();
		}

		this.setAbort = function(jqxhr){
			var sb = this.statusbar;
			this.abort.click(function(){
				jqxhr.abort();
				sb.hide();
			})
		}
	}});
    $(document).on('click','.uploaded-img .close',function(){
	$(this).parent().remove();});