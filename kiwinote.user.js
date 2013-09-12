// ==UserScript==
// @name Kiwinote
// @namespace kiwinote.ium
// @description Lo script di Greasemonkey per Kiwinote
// @include http://en.wikipedia.org/*
// @include http://it.wikipedia.org/*
// @require http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js
// @resource kiwicss http://www.staytunedlive.com/kiwi/webclient/kiwicss.css
// ==/UserScript==

GM_addStyle(GM_getResourceText("kiwicss"));

if (unsafeWindow.jQuery === undefined) { //if jquery is not loaded

  i=2;
  
} else {  //if jquery is loaded

  $( "<div></div>", {
      "id": "noteList",
  }).appendTo( "body" );
  
  $( "<div></div>", {
      "id": "newNote",
  }).appendTo( "body" );

  $( "<div></div>", {
      "id": "overlay",
      on: {
        click: function(){
          $(this).hide();
          $('#noteList').hide();
          $('#newNote').hide();
          $('#noteListOpen').addClass('disabled').removeClass('enabled');
          $('#newNoteOpen').addClass('disabled').removeClass('enabled');
        }
      }
  }).appendTo( "body" );
  
  $( "<span></span>", {
      "id": "buttonPosition"
  }).appendTo( "#firstHeading" );
    
  $( "<div></div>", {
      "id": "buttonContainer"
  }).appendTo( "#buttonPosition" );
  
  $( "<div></div>", {
    "id": "newNoteOpen",
    "class": "disabled",
    on: {
      click: function() {
        $('#iframeNew').attr("src", "http://www.staytunedlive.com/kiwi/webclient/new.php?url="+currentURL+"&fullscreen=0");
        $('#noteList').hide();
        $('#overlay').show();
        $('#newNote').show();
          $('#noteListOpen').addClass('disabled').removeClass('enabled');
          $('#newNoteOpen').addClass('enabled').removeClass('disabled');
      }
    }
  }).appendTo( "#buttonContainer" );
  
  $( "<img></img>", {
      "src": "http://www.staytunedlive.com/kiwi/webclient/icons/new.png",
  }).appendTo( "#newNoteOpen" );
    
  $( "<div></div>", {
      "id": "noteListOpen",
      "class": "disabled",
      on: {
        click: function() {
          $('#iframeList').attr("src", "http://www.staytunedlive.com/kiwi/webclient/list.php?url="+currentURL+"&fullscreen=0");
          $('#newNote').hide();
          $('#overlay').show();
          $('#noteList').show();
          $('#noteListOpen').addClass('enabled').removeClass('disabled');
          $('#newNoteOpen').addClass('disabled').removeClass('enabled');
        }
      }
  }).appendTo( "#buttonContainer" );
  
  $( "<img></img>", {
      "src": "http://www.staytunedlive.com/kiwi/webclient/icons/list.png",
  }).appendTo( "#noteListOpen" );
  
  var buttonPosition = $("#buttonPosition").position();
  
  $("#buttonContainer").css("left",buttonPosition.left + 12 );
  $("#buttonContainer").css("top",buttonPosition.top + 4 );
  
  $("#noteList").css("left",buttonPosition.left+ 12 );
  $("#noteList").css("top",buttonPosition.top+ 25 );
  
  $("#newNote").css("left",buttonPosition.left+ 12 );
  $("#newNote").css("top",buttonPosition.top+ 25 );
  
  var currentURL = document.URL;
  
  $( "<iframe></iframe>", {
    "src": "http://www.staytunedlive.com/kiwi/webclient/list.php?url="+currentURL+"&fullscreen=0",
    "id": "iframeList",
    "frameborder": "0",
    "height": "461",
    "width": "300",
    "scrolling": "no"
  }).appendTo( "#noteList" );
  
  $( "<iframe></iframe>", {
    "src": "http://www.staytunedlive.com/kiwi/webclient/new.php?url="+currentURL+"&fullscreen=0",
    "id": "iframeNew",
    "frameborder": "0",
    "height": "461",
    "width": "300",
    "scrolling": "no"
  }).appendTo( "#newNote" );
  
}
