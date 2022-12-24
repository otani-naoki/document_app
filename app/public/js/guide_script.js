
$(function() {
  
    // モーダルウィンドウを開くとき
    $('.userGuide_upload').on(
      'click', function() {
      $('.useGuideUpdateModal, .over-lay').addClass('active');
    });
    
    // モーダルウィンドウを閉じるとき
    $('.over-lay').on(
      'click', function() {
      $('.useGuideUpdateModal, .over-lay').removeClass('active');
    });
  });