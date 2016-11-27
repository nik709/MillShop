/**
     MILL SHOP COMPANY, 2016
     CREATED BY NIKITA GRECHUKHIN, NIKOLAY KOMAROV AND VAGIK SIMONYAN
 */

var criteriaAndSorting = null;

function setSubcategory(id, category, isChecked) {
    if(isChecked) {
        if (criteriaAndSorting != null && criteriaAndSorting != "") {
            criteriaAndSorting += "&" + id + "=" + category;
        }
        else {
            criteriaAndSorting = id + "=" + category;
        }
    }
    else {
        if (criteriaAndSorting.indexOf(id) != -1) {
            var string = id + "=" + category;
            var preIndex = criteriaAndSorting.indexOf(string);
            var startIndex = preIndex - 1;
            if(startIndex != -1) {
                var oldCategory = criteriaAndSorting.substring(startIndex);
                if (oldCategory.indexOf("&") != -1) {
                    string = "&" + string;
                }
            }
            criteriaAndSorting = criteriaAndSorting.replace(string, "");
        }
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function setSize(id, size, isChecked) {
    if(isChecked) {
        if (criteriaAndSorting != null && criteriaAndSorting != "") {
            criteriaAndSorting += "&" + id + "=" + size;
        }
        else {
            criteriaAndSorting = id + "=" + size;
        }
    }
    else {
        if (criteriaAndSorting.indexOf(id) != -1) {
            var string = id + "=" + size;
            var preIndex = criteriaAndSorting.indexOf(string);
            var startIndex = preIndex - 1; // Номер символа в строке, с которого начинается значение Color-i
            if(startIndex != -1) {
                var oldSize = criteriaAndSorting.substring(startIndex);
                if (oldSize.indexOf("&") != -1) {
                    string = "&" + string;
                }
            }
            criteriaAndSorting = criteriaAndSorting.replace(string, "");
        }
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function setColor(id, color, isChecked) {
    if(isChecked) {
        if (criteriaAndSorting != null && criteriaAndSorting != "") {
            criteriaAndSorting += "&" + id + "=" + color;
        }
        else {
            criteriaAndSorting = id + "=" + color;
        }
    }
    else {
        if (criteriaAndSorting.indexOf(id) != -1) {
            var string = id + "=" + color;
            var preIndex = criteriaAndSorting.indexOf(string);
            var startIndex = preIndex - 1; // Номер символа в строке, с которого начинается значение Color-i
            if(startIndex != -1) {
                var oldColor = criteriaAndSorting.substring(startIndex);
                if (oldColor.indexOf("&") != -1) {
                    string = "&" + string;
                }
            }
            criteriaAndSorting = criteriaAndSorting.replace(string, "");
        }
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function setSortOption(sortOption) {
    if(criteriaAndSorting != null) {
        if(criteriaAndSorting.indexOf("sortOption") != -1) {
            var preString = "sortOption=";
            var preIndex = criteriaAndSorting.indexOf(preString);
            var searchStartIndex = preIndex + criteriaAndSorting.substring(preIndex).indexOf("=") + 1; // Номер символа в строке, с которого начинается значение сортировки
            var oldSortOption = criteriaAndSorting.substring(searchStartIndex);
            preIndex = criteriaAndSorting.indexOf(oldSortOption);
            if(oldSortOption.indexOf("&") != -1) {
                var searchEndIndex = preIndex + oldSortOption.indexOf("&");
                oldSortOption = criteriaAndSorting.substring(searchStartIndex, searchEndIndex);
            }
            criteriaAndSorting = criteriaAndSorting.replace(oldSortOption, sortOption);
        }
        else {
            criteriaAndSorting += "&sortOption=" + sortOption;
        }
    }
    else {
        criteriaAndSorting = "sortOption=" + sortOption;
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function setMinPrice(minPrice) {
    if(criteriaAndSorting != null) {
        if(criteriaAndSorting.indexOf("minPrice") != -1) {
            var preString = "minPrice=";
            var preIndex = criteriaAndSorting.indexOf(preString);
            var searchStartIndex = preIndex + criteriaAndSorting.substring(preIndex).indexOf("=") + 1;
            var oldMinPrice = criteriaAndSorting.substring(searchStartIndex);
            preIndex = criteriaAndSorting.indexOf(oldMinPrice);
            if(oldMinPrice.indexOf("&") != -1) {
                var searchEndIndex = preIndex + oldMinPrice.indexOf("&");
                oldMinPrice = criteriaAndSorting.substring(searchStartIndex, searchEndIndex);
            }
            criteriaAndSorting = criteriaAndSorting.replace(oldMinPrice, minPrice);
        }
        else {
            criteriaAndSorting += "&minPrice=" + minPrice;
        }
    }
    else {
        criteriaAndSorting = "minPrice=" + minPrice;
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function setMaxPrice(maxPrice) {
    if(criteriaAndSorting != null) {
        if(criteriaAndSorting.indexOf("maxPrice") != -1) {
            var preString = "maxPrice=";
            var preIndex = criteriaAndSorting.indexOf(preString);
            var searchStartIndex = preIndex + criteriaAndSorting.substring(preIndex).indexOf("=") + 1;
            var oldMaxPrice = criteriaAndSorting.substring(searchStartIndex);
            preIndex = criteriaAndSorting.indexOf(oldMaxPrice);
            if(oldMaxPrice.indexOf("&") != -1) {
                var searchEndIndex = preIndex + oldMaxPrice.indexOf("&");
                oldMaxPrice = criteriaAndSorting.substring(searchStartIndex, searchEndIndex);
            }
            criteriaAndSorting = criteriaAndSorting.replace(oldMaxPrice, maxPrice);
        }
        else {
            criteriaAndSorting += "&maxPrice=" + maxPrice;
        }
    }
    else {
        criteriaAndSorting = "maxPrice=" + maxPrice;
    }
    //document.getElementById("page-title").innerHTML = criteriaAndSorting;
    process(criteriaAndSorting);
}

function process(str) {
    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    }
    else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            document.getElementById("results-of-query").innerHTML = this.responseText;
        }
    };
    xmlhttp.open("GET", "LoadingItemsOnPageAJAX.php?" + str, true);
    xmlhttp.send();
}