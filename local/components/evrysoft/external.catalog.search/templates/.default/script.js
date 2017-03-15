function catalogSearch(){
    document.location.href = window.location.origin + '/catalog/?catalog_search=' + document.getElementById('catalogSearchRequest').value;
}