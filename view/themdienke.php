<form method="post" action="">
    <label for="makh">Mã khách hàng:</label>
    <input type="text" name="makh" id="makh" readonly> <br>

    <label for="madk">Mã điện kế:</label>
    <input type="text" name="madk" id="madk" required> <br>

    <label for="ngaysx">Ngày sản xuất:</label>
    <input type="date" name="ngaysx" id="ngaysx" required><br><br>

    <label for="ngaylap">Ngày lắp:</label>
    <input type="date" name="ngaylap" id="ngaylap" required><br><br>

    <label for="mota">Mô tả:</label>
    <textarea name="mota" id="mota" rows="4" cols="50" required></textarea><br><br>

    <label for="trangthai">Trạng thái:</label>
    <select name="trangthai" id="trangthai" required>
        <option value="1">Sử dụng</option>
        <option value="0">Chưa sử dụng</option>
    </select><br><br>

    <input type="submit" name="addDienke" value="Thêm điện kế">
</form>

<script>
document.addEventListener('DOMContentLoaded', function() {
    var selectedMakh = localStorage.getItem('selectedMakh');
    if (selectedMakh) {
        document.getElementById('makh').value = selectedMakh;
    } else {
        alert('Thông tin không hợp lệ. Vui lòng thử lại.');
    }
});
</script>
