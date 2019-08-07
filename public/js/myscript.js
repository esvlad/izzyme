
var partners_page;

function graphics_ajax(data_type, token, ctx){
  btn_type = $('.graphicks .btn[data-type="'+data_type+'"]');

  if(window.myLine) window.myLine.destroy();

  $.ajax({
     type:'get',
     url:'/partners/statistics/posts',
     data:{
       'type': data_type,
       '_token': token
     },
     success:function(data){
       $('.graphicks .btn').removeClass('active');
       btn_type.addClass('active');

       console.log(data.config_char);
       window.myLine = new Chart(ctx, data.config_char);
     },
     error: function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		 }
  });
};

if(graphics_path == 'main'){
  window.onload = function() {
  	var ctx = document.getElementById('poststatistics').getContext('2d');
    window.myLine = new Chart(ctx, config_char);
  };
}

if(graphics_path == 'posts'){
  partners_page = graphics_path;
  var ctx = document.getElementById('poststatistics').getContext('2d');

  window.onload = function() {
  	graphics_ajax('days', window.Laravel.csrfToken, ctx);
  };
};

if(graphics_path == 'post'){
  window.onload = function() {
  	var ctx = document.getElementById('poststatistics').getContext('2d');
    window.myLine = new Chart(ctx, config_char);
  };
}

function graphics_statistics_ajax(data_type, token, ctx){
  btn_type = $('.graphicks .btn[data-type="'+data_type+'"]');

  if(window.myLine) window.myLine.destroy();

  $.ajax({
     type:'get',
     url:'/partners/statistics/graphics',
     data:'type='+data_type+'&_token = '+token,
     success:function(data){
       $('.graphicks .btn').removeClass('active');
       btn_type.addClass('active');

       console.log(data.config_char);
       window.myLine = new Chart(ctx, data.config_char);
     },
     error: function(xhr, ajaxOptions, thrownError){
			console.log(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
		 }
  });
};

if(graphics_path == 'statistics'){
  partners_page = graphics_path;

  var ctx = document.getElementById('statisticssocialsline').getContext('2d');

  window.onload = function() {
  	graphics_statistics_ajax('views', window.Laravel.csrfToken, ctx);

    var ctx_age = document.getElementById('statisticsAge').getContext('2d');
    window.myBar = new Chart(ctx_age, {
      type: 'bar',
      data: config_char_age,
      options: {
        responsive: true,
        legend: {
          position: 'top',
        },
        title: {
          display: false,
          text: ''
        },
        tooltips: {
          callbacks: {
            label: function(tooltipItem, data) {
              return data['labels'][tooltipItem['index']] + ': ' + data['datasets'][0]['data'][tooltipItem['index']] + '%';
            }
          }
        }
      }
    });

    var ctx_sex = document.getElementById('statisticsSex').getContext('2d');
		window.myPie = new Chart(ctx_sex, config_char_sex);

    var ctx_city = document.getElementById('statisticsCity').getContext('2d');
		window.myDoughnut = new Chart(ctx_city, config_char_city);
  };
};

////////////////////////////////////

$('.graphicks .btn').click(function(e){
  e.preventDefault();
  btn_type = $(this);
  data_type = btn_type.data('type');

  if(btn_type.hasClass('active')) return false;

  if(partners_page == 'posts'){
    graphics_ajax(data_type, window.Laravel.csrfToken, ctx);
  } else {
    graphics_statistics_ajax(data_type, window.Laravel.csrfToken, ctx)
  }
});

////////////////////////
/////// GEO DATA ///////
////////////////////////
