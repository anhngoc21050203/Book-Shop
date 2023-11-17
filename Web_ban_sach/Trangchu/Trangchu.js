
var listVisible = false;
var maxItems = 8; // Số lượng mục tối đa muốn hiển thị

function showList() {
    listVisible = true;
    var ul = document.getElementById("searchResults");
    ul.style.display = "block";
}

function fillInput(item) {
    var input = document.getElementById('searchInput');
    input.value = item.textContent || item.innerText;
    hideList();
}

function hideList() {
  listVisible = false;
  var ul = document.getElementById("searchResults");
  ul.style.display = "none";
}

function searchFunction() {
    var input, filter, ul, li, i, txtValue;
    input = document.getElementById('searchInput');
    filter = input.value.toUpperCase();
    ul = document.getElementById("searchResults");
    li = ul.getElementsByTagName('a');
    var count = 1;
    var found = false; // Biến để kiểm tra xem có kết quả phù hợp hay không

    for (i = 0; i < li.length; i++) {
      txtValue = li[i].textContent || li[i].innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
          if (count <= 6) {
              li[i].style.display = "block";
              count++;
          } else {
              li[i].style.display = "none";
          }
          found = true; // Nếu có kết quả phù hợp, đặt biến found thành true
      } else {
          li[i].style.display = "none";
      }
  }
    // Hiển thị thông báo nếu không tìm thấy kết quả phù hợp
    var noResults = document.getElementById('noResults');
    if (!found) {
        noResults.style.display = "block";
    } else {
        noResults.style.display = "none";
    }
}
window.onclick = function(event) {
    if (!event.target.matches('#searchInput')) {
        console.log("window click")
        if (listVisible) {
            hideList();
        }
    }
};