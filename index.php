<!--
  designed by olly#9085
  coded by zenternal#0212
-->
<?
include('config.php');
session_start();
?>
<html>
  <head>
    <title>Abstract &#127877;</title>
    <link rel='icon' href='_assets/favicon.png'>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" media="screen" href="_assets/css/core.css?<?echo filemtime('_assets/css/core.css');?>" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css" integrity="sha256-46qynGAkLSFpVbEBog43gvNhfrOj+BmwXdxFgVK/Kvc=" crossorigin="anonymous" />
    <script src="//code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet" />
    <meta property='og:type' content='music.radio_station'>
    <meta property='og:title' content='Abstract Radio'>
    <meta property='og:url' content='https://weareabstract.com/'>
    <meta property='og:image' content='https://abstractradio.kognise.repl.co/assets/favicon.png'>
    <meta property='og:description' content='Abstract Radio: bringing you the latest hits and more! Listen to our 24/7 playlist of curated music or tune in when one of our expert DJs go live.'>
    <meta name='theme-color' content='#ff0000'>
    <meta charset='utf-8'>
  </head>


<body>



		
  <audio src="http://178.62.29.135:8010/radio.mp3?<?php echo time(); ?>" id="stream" preload="none" data-paused="false">
  <source src="http://178.62.29.135:8010/radio.mp3?<?php echo time(); ?>" type="audio/mpeg">Your browser does not support the audio element.</audio>
  </audio>
  <script>stream.volume = 0.1;</script>

  <div class="site-wrapper">
    <div class="bgwrapper"></div>
    <div class="row h-100">
      <div class="col-md-6 offset-md-3 vertical-center text-center">
        <img id="logo" src="_assets/logo.png" />

        <div class="bg-a-2 p-3 player rounded mb-4">
          <div class="row">
            <div class="main_player">
            <i class="fas fa-sync-alt fa-4x fa-spin"></i>
            <? //player code found in _include/player.php ?>
              </div>

            <div class="col text-right pr-4 p-2 controls">
              <i class="fa fa-play" id="toggleRadio"></i></br>
              <i class="fa fa-plus" id="volUp"></i></br>
              <i class="fa fa-minus" id="volDown"></i></br>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col">
            <a href="https://discord.gg/4ShAfuY" target="_blank">
              <div class="bg-a-2 p-3 rounded">
                <img src="_assets/discord.png" class="discord_logo" />
              </div>
            </a>
          </div>

          <div class="col">
            <div class="bg-a-2 p-2 rounded">
              <button type="button" class="btn btn-primary mb-2 mt-1" data-toggle="modal" data-target="#preregister-modal">Pre-Register</button></br>
            <button type="button" class="btn btn-secondary mb-2" disabled>Timetable</button></br>
            <button type="button" class="btn btn-primary mb-2" data-toggle="modal" data-target="#request-modal">Request</button>
            </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
<div id="modals">

  <? include('_include/modals.php');?>

</div>



<script src="_assets/js/main.js?<?echo filemtime('_assets/js/main.js');?>"></script>
</body>
<script>



$(document).ready(function(){

$('.site-wrapper').fadeIn();

function reload() {
  $.ajax({
    url: '_include/bg.php',
    method:'GET',
    success:function(data) {
      $('.bgwrapper').html(data);
    }
  });

  $.ajax({
    url: '_include/player.php',
    method:'GET',
    success:function(data) {
      $('.main_player').html(data);
    }
  });

}
playRadio();
reload();

setInterval(reload, 20000);

});

function request(){
  jQuery.ajax({
      url: "_include/request.php",
      data:{
      username: $("#req-username").val(),
      type: $("#req-type").val(),
      content: $("#req-content").val()
    },
    type: "POST",
    success:function(data){
      $("#request-button").prop("disabled", true);
      toastr.success('Your request has been sent!', 'SUCCESS');
      $('#request-modal').modal('hide');
      $('#req-username').val('');
      $('#req-content').val('');
      $("#request-button").prop("disabled", false);
    },
    error: function(obj,text,error) {
      toastr.error(obj.responseText, 'ERROR');
    }
  });
}


<?
if(!$_SESSION['reg']){echo'
function preRegister(){
  jQuery.ajax({
      url: "_include/prereg.php",
      data:{
      name: $("#name").val(),
      email: $("#email").val(),
      pass: $("#pass").val(),
      passconfirm: $("#passconfirm").val()
    },
    type: "POST",
    success:function(data){
      toastr.success(\'You have successfully pre-registered!\', \'SUCCESS\');
      $("#prereg :input").prop("disabled", true);
      $(\'.reg-button\').html(\'DONE!\');
      $(\'.reg-button\').onclick(\'ne\');
    },
    error: function(obj,text,error) {
      toastr.error(obj.responseText, \'ERROR\');
    }
  });
}
';}
?>
</script>

</html>