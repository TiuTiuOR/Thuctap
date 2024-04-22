
var selectedRadio = null; // khai báo 1 biến chọn radio

function showDienKe(makh) {
    var dienke_row = document.getElementById('dienke_row_' + makh);
    var button = document.getElementById('button_' + makh);

    if (dienke_row.style.display !== 'none') {
        // Kiểm tra xem radio button có được chọn không
        if (selectedRadio && selectedRadio.closest('tr').id === 'dienke_row_' + makh) {
            selectedRadio.checked = false; // Hủy chọn radio button
            selectedRadio = null;
            localStorage.removeItem('selected_id_madk'); // Xóa dữ liệu đã lưu
        }
        dienke_row.style.display = 'none';
        button.innerHTML = 'Xem';
    } else {
        // Tìm và đóng form điện kế đang được hiển thị (nếu có)
        // selector CSS được sử dụng để chọn ra phần tử <tr> có id bắt đầu bằng "dienke_row_" và không ẩn (style="display: none;")
        var currentShownCustomer = document.querySelector('tr[id^="dienke_row_"]:not([style="display: none;"])'); // chọn tất cả các phần tử <tr> có id bắt đầu bằng "dienke_row_" & loại bỏ những phần tử có thuộc tính style là display: none;
        if (currentShownCustomer) {
            if (selectedRadio && selectedRadio.closest('tr').id === currentShownCustomer.id) {
                selectedRadio.checked = false; // Hủy chọn radio button
                selectedRadio = null;
                localStorage.removeItem('selected_id_madk'); // Xóa dữ liệu đã lưu
            }
            currentShownCustomer.style.display = 'none';
            var currentMakh = currentShownCustomer.id.split('_')[2];
            var currentButton = document.getElementById('button_' + currentMakh);
            currentButton.innerHTML = 'Xem';
        }
        // Hiển thị form điện kế của khách hàng mới
        dienke_row.style.display = 'table-row';
        button.innerHTML = 'Đóng';

        // Xóa mã điện kế đã lưu trong localStorage khi chọn khách hàng mới
        selectedRadio.checked = false; // Hủy chọn radio button
        selectedRadio = null;
        localStorage.removeItem('selected_id_madk');
    }
}


window.onload = function () {
    var radios = document.getElementsByName('selected_id');
    for (var i = 0; i < radios.length; i++) {
        radios[i].addEventListener('click', function () {
            // Kiểm tra trạng thái của radio button
            if (this === selectedRadio && selectedRadio.checked) {
                // Nếu radio button đã được chọn và được click lần thứ hai, hủy chọn nó
                selectedRadio.checked = false;
                selectedRadio = null;
                localStorage.removeItem('selected_id_madk');
            } else {
                // Nếu không, lưu radio button được chọn
                selectedRadio = this;
                var madk = this.closest('tr').querySelector('td:first-child').innerText;
                localStorage.setItem('selected_id_madk', madk);
            }
        });
    }
};
function kiemTraChon() {
    if (!selectedRadio) {
        alert('Vui lòng chọn một điện kế để lập hóa đơn.');
        return false;
    }
    lapHoaDon();
    return true;
}
function lapHoaDon() {
    var selectedMadk = localStorage.getItem('selected_id_madk');
    var xhr = new XMLHttpRequest();
    var form = document.getElementById('hoadon'); // Lấy thẻ form
    var url = form.getAttribute('action'); // Lấy URL từ action của form
    xhr.open('POST', url, true); // Sử dụng URL từ action của form
    xhr.setRequestHeader('Content-Type', 'application/json');
    xhr.onreadystatechange = function () {
        if (xhr.readyState === 4 && xhr.status === 200) {
            console.log(xhr.responseText);
        }
    };
    var data = JSON.stringify({
        selected_madk: selectedMadk
    });
    xhr.send(data);
}