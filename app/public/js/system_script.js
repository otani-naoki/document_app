$(function() {
    // モーダルウィンドウを開くとき
    $('.addFolderButton').on(
      'click', function() {

      $('.addFolderModal, .over-lay-folder').addClass('active');
    });
    
    // モーダルウィンドウを閉じるとき
    $('.over-lay-folder').on(
      'click', function() {
      $('.addFolderModal, .over-lay-folder').removeClass('active');
    });
  });


$(function() {

    // モーダルウィンドウを開くとき
    $('.userSystem').on(
      'click', function() {

      $('.useSystemUpdateModal, .over-lay-user').addClass('active');
    });
    
    // モーダルウィンドウを閉じるとき
    $('.over-lay-user').on(
      'click', function() {
      $('.useSystemUpdateModal, .over-lay-user').removeClass('active');
    });
  });


  