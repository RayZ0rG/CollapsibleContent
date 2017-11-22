;(function($, window, document, undefined){
  'use strict';


  var $visibleContents, $hiddenContents, $icons;

  var init = function() {
      $visibleContents = $('.collapsible-content--visible');
      $hiddenContents = $visibleContents.next();
      $icons = $visibleContents.find('.collapsible-content--icon');
      $visibleContents.on('click', clickHandler);
  }

  var clickHandler = function(){
    var index = $visibleContents.index( this ),
        $hiddenContent = $( $hiddenContents[ index ] ),
        isHiddenContentShowing = $hiddenContent.is(':visible');

    if ( isHiddenContentShowing ) {
      // slide up (hide)
      $hiddenContent.slideUp();
    } else {
      // slide down (show)
      $hiddenContent.slideDown();
    }

    changeIcon( index, isHiddenContentShowing );
  }

  function changeIcon( index, isHiddenContentShowing ) {
    var $iconElement = $( $icons[ index ] ),
        showIcon = $iconElement.data( 'showIcon' ),
        hideIcon = $iconElement.data( 'hideIcon' ),
        removeClass, addClass;
    console.log( showIcon );
    console.log( hideIcon );

    if ( isHiddenContentShowing ) {
      // slide up (hide)
      addClass = showIcon;
      removeClass = hideIcon;
    } else {
      // slide down (show)
      addClass = hideIcon;
      removeClass = showIcon;
    }

    $iconElement
      .removeClass( removeClass )
      .addClass( addClass );
  }

  $(document).ready(function(){
    init();
  });

})(jQuery, window, document);
