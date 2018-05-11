function parseGetParams() {
    var $_GET = {};
    var __GET = window.location.search.substring(1).split("&");
    for(var i=0; i<__GET.length; i++) {
        var getVar = __GET[i].split("=");
        $_GET[getVar[0]] = typeof(getVar[1])=="undefined" ? "" : getVar[1];
    }
    return $_GET;
}

function catalogSearch(){
    if (!document.getElementById('catalogSearchRequest').value && !document.getElementById('catalogSearchPhone').value &&
    !document.getElementById('catalogSearchAddress').value) return;

    var getParams = parseGetParams();
    var beginUrl = window.location.origin + '/catalog/?';
    var sectionId = document.getElementById('catalogSearchCategory').value

    if (getParams.SECTION_ID && sectionId == 0) beginUrl += 'SECTION_ID=' + getParams.SECTION_ID + '&';
    if (sectionId != 'all' && sectionId != 0) beginUrl += 'SECTION_ID=' + sectionId + '&';

    var cityId = document.getElementById('catalogSearchCity').value ?
    '&city=' + document.getElementById('catalogSearchCity').value : '';

    var phone = document.getElementById('catalogSearchPhone').value != '' ?
    '&phone=' + document.getElementById('catalogSearchPhone').value : '';

    var address = document.getElementById('catalogSearchAddress').value != '' ?
    '&address=' + document.getElementById('catalogSearchAddress').value : '';

    document.location.href = beginUrl + 'catalog_search=' + document.getElementById('catalogSearchRequest').value +
        cityId + phone + address;
}

function catalogSearchRequestOnKeyPress(e){
    if(e.keyCode === 13){
        catalogSearch();
    }
}