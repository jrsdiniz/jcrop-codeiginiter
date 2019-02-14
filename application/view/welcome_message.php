<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/css/jquery.Jcrop.min.css" />
	<meta charset="utf-8">
	<title>Welcome to CodeIgniter</title>

	<style type="text/css">

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		margin: 40px;
		font: 13px/20px normal Helvetica, Arial, sans-serif;
		color: #4F5155;
	}

	a {
		color: #003399;
		background-color: transparent;
		font-weight: normal;
	}

	h1 {
		color: #444;
		background-color: transparent;
		border-bottom: 1px solid #D0D0D0;
		font-size: 19px;
		font-weight: normal;
		margin: 0 0 14px 0;
		padding: 14px 15px 10px 15px;
	}

	code {
		font-family: Consolas, Monaco, Courier New, Courier, monospace;
		font-size: 12px;
		background-color: #f9f9f9;
		border: 1px solid #D0D0D0;
		color: #002166;
		display: block;
		margin: 14px 0 14px 0;
		padding: 12px 10px 12px 10px;
	}

	#body {
		margin: 0 15px 0 15px;
	}

	p.footer {
		text-align: right;
		font-size: 11px;
		border-top: 1px solid #D0D0D0;
		line-height: 32px;
		padding: 0 10px 0 10px;
		margin: 20px 0 0 0;
	}

	#container {
		margin: 10px;
		border: 1px solid #D0D0D0;
		box-shadow: 0 0 8px #D0D0D0;
	}
	</style>
</head>
<body>

<div id="container">
	<h1>Welcome to CodeIgniter!</h1>

	<div id="body">
		<?= form_open_multipart('welcome/salvar', ['id' => 'artigo', 'class' => 'form-horizontal']) ?>
            <div class="form-group">
                <label class="col-sm-2 control-label">Imagem</label>
                <div class="col-sm-9">
                    <input type='file' name='imagem' id='image' />
                    
                    <!--Image Preview-->
                    <div style='overflow: scroll;' class='row'>
                        <div class='col s12'>
                            <img src="" class="crop" id="dp_preview" />
                            <input type="hidden" id="x" name="x" />
                            <input type="hidden" id="y" name="y" />
                            <input type="hidden" name="x2" id="x2" />
                            <input type="hidden" name="y2" id="y2" />
                            <input type="hidden" id="w" name="w" />
                            <input type="hidden" id="h" name="h" />
                        </div>
                    </div>
                </div>
            </div>
              <div class='right row'>
                <button style='margin-right: 24px;' type='submit' name='btn_add_brnd' class='btn btn-large waves-effect indigo'>Add</button>
            </div>
            
        <?= form_close() ?>
	</div>

	<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. <?php echo  (ENVIRONMENT === 'development') ?  'CodeIgniter Version <strong>' . CI_VERSION . '</strong>' : '' ?></p>
</div>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"  crossorigin="anonymous"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-jcrop/0.9.12/js/jquery.Jcrop.min.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
    
                reader.onload = function(e) {
                    $('.jcrop-holder').replaceWith('');
                    $('#dp_preview').replaceWith('<img class="crop" id="dp_preview" src="' + e.target.result + '" />');
    
                    $('.crop').Jcrop({
                        onSelect: updateCoords,
                        onChange: updateCoords,
                        bgOpacity: '.5',
                        bgColor: 'black',
                        //addClass: 'jcrop-dark',
                        maxSize: [960, 640]
                    });
                }
    
                reader.readAsDataURL(input.files[0]);
            }
        }
 
        $('#image').change(function() {
            readURL(this);
        });
       
        function updateCoords(c) {
            $('#x').val(c.x);
            $('#y').val(c.y);
            $('#x2').val(c.x2);
            $('#y2').val(c.y2);
            $('#w').val(c.w);
            $('#h').val(c.h);
            // console.log(c);
        };
    });
</script>
</body>
</html>