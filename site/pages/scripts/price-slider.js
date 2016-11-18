/**
     MILL SHOP COMPANY, 2016
     CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */
$(document).ready(function()
{
    var minPrice = getMinPriceNumber();
    var maxPrice = getMaxPriceNumber();
    $( "#criteria-slider-price" ).slider({
        range: true,
        min: minPrice,
        max: maxPrice,
        step: 1,
        values: [ minPrice, maxPrice ],
        slide: function( event, ui ) {
            $( "#criteria-min-price" ).text(ui.values[0] + "$");
            $( "#criteria-max-price" ).text(ui.values[1] + "$");
        },
        stop: function( event, ui ) {
            //var nr_total = getMinPriceNumber();
        },
    });
    $("#criteria-min-price").text( $("#criteria-slider-price").slider("values", 0) + "$");
    $("#criteria-max-price").text( $("#criteria-slider-price").slider("values", 1) + "$");
});

function getMinPriceNumber()
{
    var minPrice = 0;
    $.ajax({
        async: false,
        url: 'scripts/getMinPriceForSlider.php',
        dataType: 'JSON',
        success: function(data) {
            minPrice = data;
        },
        error: function() {
            alert("JQuery request failed!");
        }
    });
    return minPrice;
}

function getMaxPriceNumber()
{
    var maxPrice = 0;
    /*$.ajax({
        async: false,
        url: 'scripts/getMaxPriceForSlider.php',
        dataType: 'JSON',
        success: function(data) {
            maxPrice = data;
        },
        error: function() {
            alert("JQuery request failed!");
        }
    });*/
    return maxPrice;
}