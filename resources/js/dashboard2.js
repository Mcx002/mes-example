$(function () {
    "use strict";
    
    //This is for the perfect scroll
    
});
//sparkline charts
// console.log('asd');
var sparklineLogin = function () {
  for(var i =8; i<=15;i++){
    $('#sparkline'+i).bind('mousemove',function(e){ 
        $('#jqstooltip').hide();
    });
  }
    $("#sparkline8").sparkline([2, 4, 4, 6, 8, 5, 8, 5], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: '#7460ee'
    });
    $("#sparkline9").sparkline([0,2, 4, 8, 6, 3, 5, 1], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: '#36bea6'
    });
    $("#sparkline10").sparkline([2, 4, 4, 6, 8, 5, 8, 5], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: '#f62d51'
    });
    $("#sparkline11").sparkline([0,2, 4, 8, 6, 3, 5, 1], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: 'rgba(255, 255, 255, 0.5)' 
    });
    $("#sparkline12").sparkline([0,2, 4, 8, 6, 3, 5, 1], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: 'rgba(255, 255, 255, 0.5)'
    });
    $("#sparkline13").sparkline([0,2, 4, 8, 6, 3, 5, 1], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: 'rgba(255, 255, 255, 0.5)'
    });
    $("#sparkline14").sparkline([0,2, 4, 8, 6, 3, 5, 1], {
        type: 'bar'
        , width: '100%'
        , height: '30',
        barWidth: '4',
            width:'100%',
            resize: true,
            barSpacing: '6',
            barColor: 'rgba(255, 255, 255, 0.5)'
    });
    $('#sparkline15').sparkline([1, 4, 5, 4, 5, 6, 6, 7, 5, 7, 5, 4, 3], {
        type: 'line',
        width: '100%',
        height: '100',
        lineColor: '#00bfbf',
        fillColor: '#ecfaf8',
        spotColor: undefined,
        minSpotColor: undefined,
        maxSpotColor: undefined,
        highlightSpotColor: undefined,
        highlightLineColor: '#494646',
        spotRadius: 0
        });
        
}
var sparkResize;
$(window).resize(function (e) {
    clearTimeout(sparkResize);
    sparkResize = setTimeout(sparklineLogin, 500);
});
sparklineLogin();
